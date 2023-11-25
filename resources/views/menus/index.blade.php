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
        
        <x-slot name="title">
            <h2>
                {{ __('TrainingMenus') }}
            </h2>
            
        </x-slot>
        
        <div>
            <!--検索-->
            <div class="container">
                <div class="searchFor">
                    <form action="/" method="GET">
                        @csrf
                        <input type="text" name="keyword" value="{{ $keyword }}">
                        <input type="submit" value="検索">
                    </form>
                </div>
            </div>
            <!--menus-->
            <div class="container">
                <!--オリジナルメニュー-->
                <div class="originalContents">
                    <p class="menuType">オリジナルメニュー</p>
                    @for ($i = 1; $i < 7; $i++)
                    <div class="originalMenu">
                        <p class="category_name">{{\App\Models\Category::find($i)->name}}</p>
                        @foreach ($menus->where('category_id', $i) as $menu)
                        <form class="originalMenu_list{{$i}}" action="/menus/{{$menu->id}}">
                            <button class="originalMenusButton">
                                {{$menu->name}}<br>
                            </button>
                        </form>
                        @endforeach
                    </div>
                    <p class="nothing{{$i}}">メニューなし</p>
                    <button class="more_btn{{$i}}">もっと見る</button>
                    <button class="close_btn{{$i}}">閉じる</button>
                    @endfor
                </div>    
                <!--共有メニュー-->
                <div class="sharedContents">
                    <p class="menuType">共有メニュー</p>
                    @for ($i = 1; $i < 7; $i++)
                    <div class="sharedMenu">
                        <p class="category_name">{{\App\Models\Category::find($i)->name}}</p>
                        @foreach ($sharedMenus->where('category_id', $i) as $sharedMenu)
                        <form class="sharedMenu_list{{$i}}" action="/menus/{{$sharedMenu->id}}">
                            <button class="sharedMenusButton">
                                {{$sharedMenu->name}}<br>
                            </button>
                        </form>
                        @endforeach
                    </div>
                    <p class="nothing{{$i}}">メニューなし</p>
                    <button class="more_btn{{$i}}">もっと見る</button>
                    <button class="close_btn{{$i}}">閉じる</button>
                    @endfor
                </div>
            </div>
            
            <!--メニュー追加-->
            <form action="/menus/admin">
                <button class="goToAdminButton">メニューを追加する</button>
            </form>
            
        </div>
        
    </x-app-layout>
    
    <script src="{{ asset('/js/index.js')  }}"></script>
    </body>
</html>
