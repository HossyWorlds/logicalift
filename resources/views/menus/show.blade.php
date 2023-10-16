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
        <div class="toTrainingMenus">
            <a href="/">TrainingMenusへ</a>
        </div>
        
        <div class="menuName">
            <h1 class="name">{{ $menu->name }}</h1>
        </div>
        <div class="category">
            <h4>部位：{{$menu->category->name}}<h4>
        </div>
        
        <div class="training">
            <form action="/menus/{{$menu->id}}/workout" method="post">
                @csrf
                <div class="weight">
                    <input type="number" name="result[weight]">kg
                </div>
                <div class="repetition">
                    <input type="number" name="result[reps]">reps
                </div>
                <input type="submit" value="goToWorkout"/>
            </form>
                
        </div>
        
        <div class="edit">
            <a href="/menus/{{$menu->id}}/edit">edit</a>
        </div>
        <div class="reset">
            <a href="">reset</a>
        </div>
        <div class="delete">
            <form action="/menus/{{$menu->id}}" id="form_{{$menu->id}}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{$menu->id}})">delete</button>
            </form>
        </div>
        
        <div>{{$menu->id}}</div>
        
        <script>
                function deletePost(id) {
                    'use strict'//最新の方法で動作させるときに書くコード
                    
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                        //${}はjavascriptの変数の書き方
                        //deleteメソットを持つformにsubmitすることで
                    }
                }
        </script>
    </body>
</html>