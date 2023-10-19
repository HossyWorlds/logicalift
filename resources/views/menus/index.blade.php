<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TrainingMenus</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <h1>TrainingMenus</h1>
        <div class="searchForMenu"></div>
        <div class="menus">
            @foreach ($menus as $menu)
            <a href="/menus/{{$menu->id}}">
                {{$menu->name}}
            </a>
            <a href="/categories/{{$menu->category->id}}">{{$menu->category->name}}<br>
            </a>
            @endforeach
        </div>
        <div class="createMenu">
            <a href='/menus/create'>メニューを増やす</a>
        </div>
    </body>
</html>
