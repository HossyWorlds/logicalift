<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TrainingMenus</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!--css-->
        <link rel="stylesheet" href="{{asset('/assets/css/app.css')}}"/>
        
    </head>
    <body>
    <x-app-layout>
        <x-slot name="header">
            <h2>
                {{ __('TrainingMenus') }}
            </h2>
        </x-slot>
        
        <div class="mainContents">
            
            <!--検索-->
            <div class="searchFor">
                <form action="/" method="GET">
                    @csrf
                    <input type="text" name="keyword" value="{{ $keyword }}">
                    <input type="submit" value="検索">
                </form>
            </div>
            
            <!--menus-->
            <div class="menusList">
                <!--オリジナルメニュー-->
                <div class="">
                    <p class="font-semibold text-xl leading-tight">オリジナルメニュー</p>
                    @foreach ($menus as $menu)
                    <a href="/menus/{{$menu->id}}">
                        {{$menu->name}}
                    </a>
                    <a href="/categories/{{$menu->category->id}}">{{$menu->category->name}}<br>
                    </a>
                    @endforeach
                    <p class="more-btn">もっと見る</p>
                    <p>閉じる</p>
                </div>
                <!--共有メニュー-->
                <div class="sharedMenus">
                    <p class="font-semibold text-xl leading-tight">共有メニュー</p>
                    @foreach ($sharedMenus as $sharedMenu)
                    <a href="/menus/{{$sharedMenu->id}}">
                        {{$sharedMenu->name}}
                    </a>
                    <a href="/categories/{{$sharedMenu->category->id}}">{{$sharedMenu->category->name}}<br>
                    </a>
                    @endforeach
                    <p>もっと見る</p>
                    <p>閉じる</p>
                </div>
                
            </div>
            
            <!--メニュー追加-->
            <div class="text-white">
                <a href='/menus/admin'>メニューを追加する</a>
            </div>
            
        </div>
        
    </x-app-layout>
    <!--jQuery-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
    </body>
</html>
