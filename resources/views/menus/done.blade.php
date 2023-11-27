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
        <x-slot name="title">
            <h2>
                {{ __('WellDone!!') }}
            </h2>
        </x-slot>
        <div class="container">
            <h1 class="wellDone">Well&nbsp;Done</h1>
            
            <button class="backTo">
                <a href="/menus/{{$menu->id}}">continue</a>
            </button>
        </div>
        
        
    </x-app-layout>
    
    <style>
        .wellDone {
            font-family: 'Arial', sans-serif; /* 好みのフォントに変更 */
            color: white; /* テキストの色 */
            text-align: center; /* テキストを中央揃え */
            margin: 20px 0; /* 上下の余白を追加 */
            font-size:x-large;
        
            /* テキストの影を追加 */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        
            /* ホバーエフェクト */
            transition: color 0.3s ease-in-out;
        }
        
        /* マウスが上にあるときのホバーエフェクト */
        .wellDone:hover {
            color: #e74c3c; /* ホバー時のテキストの色 */
        }
    </style>
    
    </body>
</html>
