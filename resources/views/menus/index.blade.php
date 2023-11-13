<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TrainingMenus</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!--css-->
        <link rel="stylesheet" href="/css/index.css" >
        
        <!--jQuery-->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="/assets/js/index.js"></script>
        
    <body>
    <x-app-layout>
        <x-slot name="header">
            <h2>
                {{ __('TrainingMenus') }}
            </h2>
        </x-slot>
        
        <div class="text-white">
            
            <!--検索-->
            <div class="searchFor">
                <form action="/" method="GET">
                    @csrf
                    <input type="text" name="keyword" value="{{ $keyword }}">
                    <input type="submit" value="検索">
                </form>
            </div>
            
            <!--menus-->
            <div class="">
                <!--オリジナルメニュー-->
                <div class="">
                    <p class="font-semibold text-xl leading-tight">オリジナルメニュー</p>
                    <div class="menusList">
                        @foreach ($menus as $menu)
                        <a href="/menus/{{$menu->id}}">
                            {{$menu->name}}
                        </a>
                        <a href="/categories/{{$menu->category->id}}">{{$menu->category->name}}<br>
                        </a>
                        @endforeach
                    </div>
                    <button class="more-btn">もっと見る</button>
                    <button class="less-btn">閉じる</button>
                </div>
                <!--共有メニュー-->
                <div class="sharedMenus">
                    <p class="font-semibold text-xl leading-tight">共有メニュー</p>
                    <div class="menusList">
                        @foreach ($sharedMenus as $sharedMenu)
                        <a href="/menus/{{$sharedMenu->id}}">
                            {{$sharedMenu->name}}
                        </a>
                        <a href="/categories/{{$sharedMenu->category->id}}">{{$sharedMenu->category->name}}<br>
                        </a>
                        @endforeach
                    </div>
                    
                    <button class="more-btn">もっと見る</button>
                    <button class="less-btn">閉じる</button>
                </div>
                
            </div>
            
            <!--メニュー追加-->
            <div class="text-white">
                <a href='/menus/admin'>メニューを追加する</a>
            </div>
            
        </div>
        
    </x-app-layout>
    
    <script>
        const init = 5;
        //追加表示数
        const more = 3;
        //初期表示数以降のリスト内容を非表示に
        $(".menusList:nth-child(n+" + (init+1) + ")").hide();
        //メニュー数がinit以下だったらmore-btnが要らないの
        $(".menusList").filter(function(){
            return $(this).find(".menuList").length <= init;
        }).find(".more-btn").hide();
        
        //more-btnクリックで指定数表示
        $(".more-btn").on("click",function{
            let this_list = $(this).closest(".moreList");
            this_list.find("menusList:hidden").slice(0,more).slideToggle();
            
            if(this_list.find("menusList:hidden").length == 0){
            $(this).fadeOut();
        })
    </script>
        
    </head>
    
    </body>
</html>
