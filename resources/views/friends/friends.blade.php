<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Friends</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!--css-->
        <link rel="stylesheet" href="{{asset('/css/dashboard.css')}}"/>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-app-layout>
            <x-slot name="title">
                <h2>
                    {{ __('Friends') }}
                </h2>
            </x-slot>
            
            <div class="container">
                
                <p class="homeHeader">...フレンド機能ですが、ただいま作成中です。</p>
                
                <h1>Your Friends</h1>
                
                <ul>
                    @foreach($friends as $friend)
                        <li>{{ $friend->user->name }} ({{ $friend->status }})</li>
                    @endforeach
                </ul>
                <a class="theLink" href="/friends/adminFriend">フレンドを作る</a>
                
                <h1>Friend Requests</h1>
            
                <ul>
                    @foreach($friendRequests as $request)
                    <li>
                        {{ $request->user->name }} wants to be your friend!
                        <form method="post" action="{{ route('friends.accept', $request->id) }}" style="display: inline;">
                            @csrf
                            <button type="submit">Accept</button>
                        </form>
                        <form method="post" action="{{ route('friends.reject', $request->id) }}" style="display: inline;">
                            @csrf
                            <button type="submit">Reject</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
                
                <form action="/dashboard">
                    <button class="backTo">戻る</button>
                </form>
            </div>
        </x-app-layout>
    </body>
</html>