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
                        <form class="originalMenu_list" action="/menus/{{$menu->id}}">
                            <button class="originalMenusButton">
                                {{$menu->name}}{{$menu->category->name}}<br>
                            </button>
                        </form>
                        @endforeach
                    </div>
                    <button class="more_btn1">もっと見る</button>
                    <button class="close_btn1">閉じる</button>
                </div>
                <!--テスト-->
                <div class="originalContents">
                    <p class="menuType">オリジナルメニュー</p>
                    <div>
                        <p>胸</p>
                        @foreach ($menus->where('category_id', 1) as $menu)
                        <form class="originalMenu_list" action="/menus/{{$menu->id}}">
                            <button class="originalMenusButton">
                                {{$menu->name}}<br>
                            </button>
                        </form>
                        @endforeach
                    </div>
                    <div>
                        <p>背中</p>
                        @foreach ($menus->where('category_id', 2) as $menu)
                        <form class="originalMenu_list" action="/menus/{{$menu->id}}">
                            <button class="originalMenusButton">
                                {{$menu->name}}<br>
                            </button>
                        </form>
                        @endforeach
                    </div>
                    <div>
                        <p>肩</p>
                        @foreach ($menus->where('category_id', 3) as $menu)
                        <form class="originalMenu_list" action="/menus/{{$menu->id}}">
                            <button class="originalMenusButton">
                                {{$menu->name}}<br>
                            </button>
                        </form>
                        @endforeach
                    </div>
                    <div>
                        <p>腕</p>
                        @foreach ($menus->where('category_id', 4) as $menu)
                        <form class="originalMenu_list" action="/menus/{{$menu->id}}">
                            <button class="originalMenusButton">
                                {{$menu->name}}<br>
                            </button>
                        </form>
                        @endforeach
                    </div>
                    <div>
                        <p>脚</p>
                        @foreach ($menus->where('category_id', 5) as $menu)
                        <form class="originalMenu_list" action="/menus/{{$menu->id}}">
                            <button class="originalMenusButton">
                                {{$menu->name}}<br>
                            </button>
                        </form>
                        @endforeach
                    </div>
                    <div>
                        <p>腹</p>
                        @foreach ($menus->where('category_id', 6) as $menu)
                        <form class="originalMenu_list" action="/menus/{{$menu->id}}">
                            <button class="originalMenusButton">
                                {{$menu->name}}<br>
                            </button>
                        </form>
                        @endforeach
                    </div>
                </div>
                <!--共有メニュー-->
                <div class="sharedContents">
                    <p class="menuType">共有メニュー</p>
                    <div class="sharedMenu">
                        @foreach ($sharedMenus as $sharedMenu)
                        <form class="sharedMenu_list" action="/menus/{{$sharedMenu->id}}">
                            <button class="sharedMenusButton">
                                {{$sharedMenu->name}}
                            </button>
                        </form>
                        @endforeach
                    </div>
                    <button class="more_btn2">もっと見る</button>
                    <button class="close_btn2">閉じる</button>
                </div>
            </div>
            
            <!--メニュー追加-->
            <div class="createButton">
                <a href='/menus/admin'>メニューを追加する</a>
            </div>
            
        </div>
        
    </x-app-layout>
    
    <script src="{{ asset('/js/index.js')  }}"></script>
    </body>
</html>
