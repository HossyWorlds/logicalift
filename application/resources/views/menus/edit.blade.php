<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edit</title>

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
                    {{ __('Editor') }}
                </h2>
            </x-slot>
            <div class="container">
                <form action="/menus/{{ $menu->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class='name'>
                        <h2>メニュー名はなに？</h2>
                        <input type='text' name='menu[name]' value="{{ $menu->name }}">
                        <p class="name_error" style="color:red">{{$errors->first('menu.name')}}</p>
                    </div>
                    <div class='category'>
                        <h2>カテゴリーはどれ？</h2>
                        <p>現在：{{$menu->category->name}}</p>
                        <select name="menu[category_id]">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="plus_weight">
                        <h2>plusWeight?</h2>
                        <input type="number" name="menu[plus_weight]" step="0.1" value="{{$menu->plus_weight}}"/>kg<br>
                        <p class="plusWeight_error" style="color:red">{{$errors->first('menu.plus_weight')}}</p>
                    </div>
                    <div class="shareOrNot">
                    
                    <button class="storeButton">
                        <input type="submit" value="保存"/>
                    </button>
                    
                </form>
                
                <form action="/menus/{{ $menu->id }}">
                    <button class="backTo">戻る</button>
                </form>
                
            </div>
        </x-app-layout>
    </body>
</html>