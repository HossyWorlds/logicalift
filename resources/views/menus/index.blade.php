<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TrainingMenus</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!--css-->
        <link rel="stylesheet" href="{{asset('/css/index.css')}}"/>
        
        
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body>
    <x-app-layout>
        
        <x-slot name="header">
            <h2>
                {{ __('TrainingMenus') }}
            </h2>
        </x-slot>
        
        <div>
            
            <!--検索-->
            <div class="searchFor">
                <form action="/" method="GET">
                    @csrf
                    <input type="text" name="keyword" value="{{ $keyword }}">
                    <input type="submit" value="検索">
                </form>
            </div>
            
            <!--menus-->
            <div class="container">
                <!--オリジナルメニュー-->
                <div class="originalContents">
                    <p class="menuType">オリジナルメニュー</p>
                    <div class="originalMenu">
                        @foreach ($menus as $menu)
                        <li class="originalMenu-list">
                            <a href="/menus/{{$menu->id}}">
                                {{$menu->name}}
                            </a>
                            <a href="/categories/{{$menu->category->id}}">
                                {{$menu->category->name}}<br>
                            </a>
                        </li>
                        @endforeach
                    </div>
                    <button class="more-btn1">もっと見る</button>
                    <button class="close-btn1">閉じる</button>
                </div>
                <!--共有メニュー-->
                <div class="sharedContents">
                    <p class="menuType">共有メニュー</p>
                    <div class="sharedMenu">
                        @foreach ($sharedMenus as $sharedMenu)
                        <li class="sharedMenu-list">
                            <button class="sharedMenus" href="/menus/{{$sharedMenu->id}}">
                                {{$sharedMenu->name}}
                            </button>
                        </li>
                        @endforeach
                    </div>
                    <button class="more-btn2">もっと見る</button>
                    <button class="close-btn2">閉じる</button>
                </div>
            </div>
            
            <!--メニュー追加-->
            <div class="text-white">
                <a href='/menus/admin'>メニューを追加する</a>
            </div>
            
        </div>
        
    </x-app-layout>
    
    <script src="{{ asset('/js/index.js')  }}"></script>
    </body>
</html>
