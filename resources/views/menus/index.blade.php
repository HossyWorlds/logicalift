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
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('TrainingMenus') }}
                </h2>
            </x-slot>
            
            <div class="searchForMenu"></div>
                <form action="/" method="GET">
                    @csrf
                    <input type="text" name="keyword" value="{{ $keyword }}">
                    <input type="submit" value="検索">
                </form>
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
        </x-app-layout>
    </body>
</html>
