<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CreateMenus</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <h1>createNewMenu</h1>
        
        <form action="/menus" method="POST">
            @csrf
            <div class="name">
                <h2>menuName?</h2>
                <input type="text" name="menu[name]" placeholder="newMenu" value="{{old('menu.name')}}"/><br>
                <p class="name_error" style="color:red">{{$errors->first('menu.name')}}</p>
            </div>
            <div class="category">
                <h2>menuCategory?</h2>
                <select name="menu[category_id]">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="plusWeight">
                <h2>plusWeight?</h2>
                <input type="number" name="menu[plus_weight]" step="0.1" value="{{old('menu.plus_weight')}}"/>kg<br>
                <p class="plusWeight_error" style="color:red">{{$errors->first('menu.plus_weight')}}</p>
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>
