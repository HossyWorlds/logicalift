<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AddMenus</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <h1>addMenu</h1>
        
        <div class="addMenu">
            <h2>共有メニュー</h2>
            <p>…ほかのユーザーが行っているメニューを追加できます。</p>
            <div class="selectCategory">
                <P>カテゴリー選択</P>
                <form action="/menus/admin" method="GET">
                    @foreach($categories as $category)
                    <input type="radio" name="category" value="{{$category->id}}">
                    <label>{{$category->name}}<br></label>
                    @endforeach
                    <input type="submit" value="絞り込み"/>
                </form>
            </div>
            <div class="searchForMenuInTheCategory">
                <p>そのカテゴリーの中でメニューを選択する</p>
                <div class="searchForMenu">
                    <form action="/menus/admin" method="GET">
                        <!--@csrf-->
                        <input type="text" name="keyword" value="{{ $keyword }}">
                        <input type="submit" value="検索">
                    </form>
                    <form action="/menus/add" method="POST">
                        @csrf
                        @foreach ($sharedMenus as $sharedMenu)
                        <input type="radio" name="sharedMenu" value="{{$sharedMenu->id}}"/>
                        <label>{{$sharedMenu->name}}{{$sharedMenu->category->name}}<br></label>
                        @endforeach
                        <input type="submit" value="add"/>
                    </form>
                </div>
                
            </div>
        </div>
        <div class="createMenu">
            <h2>オリジナルメニュー</h2>
            <p>…自分でメニュー作成できます。</p>
            <form action="/menus" method="POST">
                @csrf
                <div class="name">
                    <h2>menuName?</h2>
                    <input type="text" name="menu[name]" placeholder="newMenu" value="{{old('menu.name')}}"/><br>
                    <p class="name_error" style="color:red">{{$errors->first('menu.name')}}</p>
                </div>
                <div class="category">
                    <h2>menuCategory?</h2>
                    @foreach($categories as $category)
                    <input type="radio" name="menu[category_id]" value="{{$category->id}}">
                    <label>{{$category->name}}<br></label>
                    @endforeach
                </div>
                <div class="plusWeight">
                    <h2>plusWeight?…ステップアップの間隔は何kgごとにしますか？</h2>
                    <input type="number" name="menu[plus_weight]" step="0.1" value="{{old('menu.plus_weight')}}"/>kg<br>
                    <p class="plusWeight_error" style="color:red">{{$errors->first('menu.plus_weight')}}</p>
                </div>
                <div class="shareOrNot">
                    <h2>共有メニューにしますか？</h2>
                    <input type="radio" name="menu[sharing]" value="1">
                    <label>yes</label>
                    <input type="radio" name="menu[sharing]" value="0">
                    <label>no</label>
                </div>
                <input type="submit" value="create"/>
            </form>
        </div>
            
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>