<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Menu;
use App\Models\User;
use App\Models\Category;
use App\Models\Result;
use App\Models\Friend;

use App\Http\Requests\MenuRequest;
use App\Http\Requests\ResultRequest;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $friends = Friend::where('user_id', Auth::id())->orWhere('friend_id', Auth::id())->get();
        
        $friendRequests = Friend::where('friend_id', Auth::id())->where('status', 'pending')->get();
        
        return view('dashboard')->with([
            'friends'=>$friends,
            'friendRequests'=>$friendRequests
            ]);
    }
    
    public function index(Request $request)
    {
        //
        $keyword = $request->input('keyword');
        
        //大前提としてメニューに表示できるのは
        //自分のオリジナルメニューと共有メニュー。
        $user_id = Auth::id();
        $menusQuery = Menu::query()->orderBy('category_id')->where('user_id', $user_id);
        //dd($menus);
        
        $sharedMenusQuery = User::find($user_id)->sharingMenus()
        ->orderBy('category_id')->where('sharing', 1);
        //dd($sharedMenusQuery);
        
        if (!empty($keyword)) {
            $menusQuery->where('name', 'LIKE', "%{$keyword}%");
            $sharedMenusQuery->where('name', 'LIKE', "%{$keyword}%");
        }
        
        $menus = $menusQuery->get();
        $sharedMenus = $sharedMenusQuery->get();
        //dd($sharedMenus);
        
        return view('menus.index')->with([
            'menus' => $menus,
            'sharedMenus' => $sharedMenus,
            'categories' => Category::all(),
            'keyword' => $keyword,
            ]);
    }
    
    public function admin(Request $request)
    {
        $loginUserId = Auth::id();
        $category_idInput = $request->category;
        $keyword = $request->input('keyword');
        
        $sharedMenusQuery = Menu::query()->where('sharing',1)
        ->where('user_id', '!=', $loginUserId)
        ->whereNotIn('id', function($query) use ($loginUserId) {
            $query->select('menu_id')
            ->from('menu_user')
            ->where('user_id', $loginUserId);
        });
        
        if (!empty($keyword)) {
             $sharedMenusQuery->where('name', 'LIKE', "%{$keyword}%");
        }
        
        if (!empty($category_idInput)) {
            $sharedMenusQuery->where('category_id', $category_idInput);
        }
        
        $sharedMenus = $sharedMenusQuery->get();
        
        return view('menus.admin')->with([
            'sharedMenus' => $sharedMenus,
            'categories' => Category::all(),
            'keyword' => $keyword,
            ]);
    }
    
    public function add(Request $request){
        
        $loginUserId = Auth::id();
        
        //バリデーション
        $request->validate([
            'sharedMenu' => 'required',
        ]);
        
        // バリデーションが通過した場合の処理
        $selectedSharedMenuId = $request->sharedMenu;
        $selectedSharedMenu = Menu::find($selectedSharedMenuId);
        $selectedSharedMenu->sharedWithUsers()->attach($loginUserId);
        
        return redirect('/menus/admin');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function create()
    //{
    //    //
    //    return view('menus.create')->with([
    //        'categories'=>Category::all(),
    //        ]);
    //}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request, Menu $menu)
    {
        //menusテーブルの更新
        $user_id = Auth::id();
        $menu->user_id = $user_id;
        $input = $request['menu'];
        $menu->fill($input)->save();
        
        //menu_usersテーブルの更新
        $menu->sharedWithUsers()->attach($user_id);
        
        return redirect('/menus/' . $menu->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //変数定義
        $user_id = Auth::id();
        //userとmenuが一致するresultsテーブル
        $results = Result::where([
            ['user_id', $user_id],
            ['menu_id', $menu->id],
            ]);
        //直近三回のデータを新しい順に取得
        $latestResults = $results->orderBy('created_at', 'desc')->take(3)->get();
        
        //ここからの話は直近三回のデータが前提
        // weightが最大のレコードを取得
        $maxWeightResult
        = $latestResults
        ->sortByDesc('weight')
        ->first();
        
        $maxWeightResults = $latestResults
        ->sortByDesc('weight');
        
        //その中でrepsが最大のレコードを取得
        if ($maxWeightResult){
            $maxResult = $latestResults
            ->where('weight', $maxWeightResult->weight)
            ->sortByDesc('reps')
            ->first();
        } else {
            $maxResult = null;
        }
        
        //RM換算
        //前提
        $plusWeight = $menu->plus_weight;
        $minReps = 6;
        // 1RM = $maxResult->weight * (1+$maxResult->reps/40)
        if ($maxResult) {
            $weight = $maxResult->weight;
            $reps = $maxResult->reps;
            $oneRM = $weight * ( 1 + $reps/40 );
            $newWeight = $weight + $plusWeight;
            $newReps = ($oneRM/( $newWeight ) - 1) * 40;
            if ( $newReps >= $minReps ){
                $newIntReps = (int) $newReps;
                $advice = "あなたは{$newWeight}kgを{$newIntReps}回やる能力があります！
                次の{$newWeight}kgに挑戦しましょう！";
            } else {
                $needReps = 40*(($newWeight/$weight)*(($minReps/40)+1)-1)-$reps;
                if ($needReps>(int)$needReps){
                    $needIntReps = (int)$needReps + 1;
                    } else {
                        $needIntReps = (int)$needReps;
                    }
                $advice = "次の{$newWeight}kgに行くためには、現在の{$weight}kgを、
                前回の{$reps}回に加えてもう{$needIntReps}回やる必要があります！";
            }
        } else {
            $weight = null;
            $reps = null;
            $oneRM = null;
            $newReps = null;
            $newWeight = null;
            $advice = null;
        }
        
        $myMenu = Menu::findOrFail($menu->id);
        if ($myMenu->sharing == 0){
            $sharing = "オリジナルトレーニング";
        } else {
            $sharing = "共有トレーニング";
        }
        
        //バブルチャート
        $bubbleResults = Result::where('user_id', Auth::id())
        ->where('menu_id', $menu->id) //MenuとResult関連付け
        ->orderBy('created_at', 'desc')
        ->get();
        
        //viewを返す
        return view('menus.show')->with([
            'user_id' => $user_id,
            'menu' => $myMenu,
            'latestResults' => $latestResults,
            'maxResult' => $maxResult,
            'newWeight' => $newWeight,
            'advice' => $advice,
            'sharing' => $sharing,
            'bubbleResults' => $bubbleResults,
        ]);
    }
    
    public function done(ResultRequest $request, Menu $menu, Result $result)
    {
        $user_id = Auth::id();
        
        $result->user_id = $user_id;
        $result->menu_id = $menu->id;
        $input = $request['result'];
        $result->fill($input)->save();
        
        //return redirect('/menus/' . $menu->id);
        return view('menus.done')->with([
            'menu' => Menu::findOrFail($menu->id),
            ]);
    }
    
    public function memo(Menu $menu)
    {
        $user_id = Auth::id();
        $menu_id = $menu->id;
        $results = Result::where('user_id', $user_id)->where('menu_id', $menu_id)
        ->orderBy('created_at', 'desc')->get();
        
        return view('menus.memo')->with([
            'menu' => Menu::findOrFail($menu->id),
            'results' => $results,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('menus.edit')->with([
            'menu'=>Menu::findOrFail($id),
            'categories'=>Category::all(),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        //
        $input_menu = $request['menu'];
        $menu->fill($input_menu)->save();
        return redirect('/menus/' . $menu->id);
    }
    
    public function reset(Menu $menu, Result $result)
    {
        $result->where('user_id', '=', Auth::id())
        ->where('menu_id', '=', $menu->id)->delete();
        return redirect('/menus/' . $menu->id);
    }
    
    public function remove(Menu $menu)
    {
        $menu->sharedWithUsers()->detach(Auth::id());
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Menu $menu)
    {
        //
        $menu->delete();
        return redirect('/');
    }
}
