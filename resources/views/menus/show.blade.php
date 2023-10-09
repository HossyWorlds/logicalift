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
        <h1 class="name">
            {{ $menu->name }}
        </h1>
        
        <div class="category">
            <a href="">{{$menu->category->name}}</a>
        </div>
        <div class="edit">
            <a href="/menus/{{$menu->id}}/edit">edit</a>
        </div>
        <div class="delete">
            <form action="/menus/{{$menu->id}}" id="form_{{$menu->id}}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{$menu->id}})">delete</button>
            </form>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
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