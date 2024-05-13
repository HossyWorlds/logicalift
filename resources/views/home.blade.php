<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!--css-->
        <link rel="stylesheet" href="{{asset('/css/home.css')}}"/>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-app-layout>
            <x-slot name="title">
                <h2>
                    {{ __('Home') }}
                </h2>
            </x-slot>
            
            <div class="container">
                
                <div>
                    <p>筋トレをする際、自分の過去のトレーニングデータに基づき、重量やレップ数についてアドバイスしてくれるアプリケーション。</p>
                    <a class="theLink" href="/appExplanation">もっと詳しく</a>
                </div>
                
            </div>
            
        </x-app-layout>
    </body>
</html>