<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Administrator</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!--css-->
        <link rel="stylesheet" href="{{asset('/css/index.css')}}"/>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body>
        <x-app-layout>
            <x-slot name="title">
                <h2>
                    {{ __('Administrator') }}
                </h2>
            </x-slot>
            <div class="container">
                <div class="explanation">
                    <p>
                        他のユーザーが行っている”共有メニュー”を追加したり、
                        あなたの”オリジナルメニュー”を作ったりすることができます。
                    </p>
                </div>
                
                <!--メニューを追加-->
                <div class="addMenu">
                    <h2 class="container_title">共有メニュー</h2>
                    <p class="explanation">…他のユーザーが行っている”共有メニュー”を追加できます。</p>
                    <div class="selectCategory">
                        <P>カテゴリーを選択しメニューを絞り込もう</P>
                        <form action="/menus/admin" method="GET">
                            @foreach($categories as $category)
                            <input type="radio" name="category" value="{{$category->id}}">
                            <label>{{$category->name}}<br></label>
                            @endforeach
                            <button class="narrowDawn">
                                <input type="submit" value="絞り込む"/>
                            </button>
                        </form>
                    </div>
                    <div class="searchForMenuInTheCategory">
                        <p>そのカテゴリーの中でメニューを選択しよう</p>
                        <div class="searchForMenu">
                            <form action="/menus/admin" method="GET">
                                <!--@csrf-->
                                <div class="searchFor">
                                    <input type="text" name="keyword" value="{{ $keyword }}">
                                    <input type="submit" value="検索">
                                </div>
                            </form>
                            <div class="sharedContents_a">
                                <form action="/menus/add" method="POST">
                                @csrf
                                    @foreach ($sharedMenus as $sharedMenu)
                                    <div class="sharedMenu_list_a">
                                        <input type="radio" name="sharedMenu" value="{{$sharedMenu->id}}"/>
                                        <label>{{$sharedMenu->name}}{{$sharedMenu->category->name}}</label>
                                        
                                    </div>
                                    @endforeach
                                    <button class="addMenuButton">
                                        <input type="submit" value="追加"/>
                                    </button>
                                </form>
                                <p class="nothing">メニューなし</p>
                                <button class="more_btn">もっと見る</button>
                                <button class="close_btn">閉じる</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--メニューを作成-->
                <div class="createMenu">
                    <h2 class="container_title">オリジナルメニュー</h2>
                    <p>…自分で”オリジナルメニュー”を作成できます。</p>
                    <form class="createForm" action="/menus" method="POST">
                        @csrf
                        <div class="createName">
                            <h2>メニュー名はなに？</h2>
                            <dev class="name">
                                <input type="text" name="menu[name]" placeholder="newMenu" value="{{old('menu.name')}}"/><br>
                                <p class="name_error" style="color:red">{{$errors->first('menu.name')}}</p>
                            </dev>
                        </div>
                        <div class="defineCategory">
                            <h2>カテゴリーはどれ？</h2>
                            @foreach($categories as $category)
                            <input type="radio" name="menu[category_id]" value="{{$category->id}}">
                            <label>{{$category->name}}<br></label>
                            @endforeach
                        </div>
                        <div class="defineStepup">
                            <h2>ステップアップの間隔は何kgごとにしますか？</h2>
                            <div class="plus_weight">
                                <input type="number" name="menu[plus_weight]" step="0.1" value="{{old('menu.plus_weight')}}"/>kg<br>
                                <p class="plusWeight_error" style="color:red">{{$errors->first('menu.plus_weight')}}</p>
                            </div>
                        </div>
                        <div class="shareOrNot">
                            <h2>共有メニューにしますか？</h2>
                            <input type="radio" name="menu[sharing]" value="1">
                            <label>yes</label>
                            <input type="radio" name="menu[sharing]" value="0">
                            <label>no</label>
                        </div>
                        <button class="createMenuButton">
                            <input type="submit" value="作成"/>
                        </button>
                    </form>
                </div>
                <form action="/">
                    <button class="backTo">戻る</button>
                </form>
            </div>
        </x-app-layout>
        <script src="{{ asset('/js/index.js')  }}"></script>
    </body>
</html>