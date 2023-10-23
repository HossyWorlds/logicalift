<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Menu;
use App\Models\User;
use App\Models\Category;
use App\Models\Result;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('menus.index')->with([
            'menus' => Menu::all(),
            'categories' => Category::all(),
            
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('menus.create')->with([
            'categories'=>Category::all(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Menu $menu)
    {
        //
        $input = $request['menu'];
        $menu->fill($input)->save();
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
                次の40kgに挑戦しましょう！";
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
        
        //viewを返す
        return view('menus.show')->with([
            'menu' => Menu::findOrFail($menu->id),
            'latestResults' => $latestResults,
            'maxResult' => $maxResult,
            //ここから下は実験
            'maxWeightResult' => $maxWeightResult,
            'maxWeightResults' => $maxWeightResults,
            //実験
            'weight' => $weight,
            'reps' => $reps,
            'oneRM' => $oneRM,
            'newReps' => $newReps,
            'newWeight' => $newWeight,
            'advice' => $advice,
        ]);
    }
    
    public function workout(Request $request, Menu $menu, Result $result)
    {
        $user_id = Auth::id();
        
        $result->user_id = $user_id;
        $result->menu_id = $menu->id;
        $input = $request['result'];
        $result->fill($input)->save();
        
        //return redirect('/menus/' . $menu->id);
        return view('menus.workout')->with([
            'menu' => Menu::findOrFail($menu->id),
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
    public function update(Request $request, Menu $menu)
    {
        //
        $input_menu = $request['menu'];
        $menu->fill($input_menu)->save();
        return redirect('/menus/' . $menu->id);
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
