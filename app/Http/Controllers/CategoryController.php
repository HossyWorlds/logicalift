<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\User;
use App\Models\Result;

use App\Http\Requests\MenuRequest;
use App\Http\Requests\ResultRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category, Request $request)
    {
        //
        $keyword = $request->input('keyword');
        
        //大前提としてメニューに表示できるのは
        //自分のオリジナルメニューと共有メニュー。
        $user_id = Auth::id();
        //$menusQuery = Menu::query()->where('user_id', $user_id);
        //dd($menus);
        $menusQuery = Menu::query()
        ->where('user_id', $user_id)
        ->where('category_id', $category->id);
        
        //$sharedMenusQuery = User::find($user_id)->sharingMenus()
        //->where('sharing', 1);
        //dd($sharedMenusQuery);
        $sharedMenusQuery = User::find($user_id)
        ->sharingMenus()
        ->where('sharing', 1)
        ->where('category_id', $category->id);
        
        
        if (!empty($keyword)) {
            $menusQuery->where('name', 'LIKE', "%{$keyword}%");
            $sharedMenusQuery->where('name', 'LIKE', "%{$keyword}%");
        }
        
        $menus = $menusQuery->get();
        $sharedMenus = $sharedMenusQuery->get();
        //dd($sharedMenus);
        
        return view('categories.index')->with([
            'menus' => $menus,
            'sharedMenus' => $sharedMenus,
            'keyword' => $keyword,
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
