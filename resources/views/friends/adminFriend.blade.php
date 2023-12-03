<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AdminFriend</title>

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
                    {{ __('Admin Friend') }}
                </h2>
            </x-slot>
            
            <div class="container">
                <div>フレンドを探す</div>
                
                <div>検索ボックス</div>
                <div class="searchFor">
                    <form action="/friends/adminFriend" method="GET">
                        @csrf
                        <input type="text" name="keyword" value="{{ $keyword }}">
                        <input type="submit" value="検索">
                    </form>
                </div>
                
                <div>
                    <form>
                        @csrf
                        @foreach ($users as $user)
                        id:{{$user->id}},&nbsp;name:{{$user->name}}
                        <button>
                            <input type="submit" value="フレンドリクエスト">
                        </button>
                        @endforeach
                    </form>
                </div>
                <form action="/friends">
                    <button class="backTo">戻る</button>
                </form>
            </div>
        </x-app-layout>
    </body>
</html>