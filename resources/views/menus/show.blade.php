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
        
        <div class="simulation">
            <p>
                maxWeightResult
            </p>
            <p>
                {{$maxWeightResult->weight ?? 'データなし'}}&nbsp;{{$maxWeightResult->reps ?? ''}}
            </p>
            <p>
                maxWeightResults = 最近の記録(3件)の中で、weightの記録が良い順(repsの記録は考慮しない)に並べています。
            </p>
            <p>
                @foreach ($maxWeightResults as $maxWeightResult)
                {{$maxWeightResult->weight}}&nbsp;{{$maxWeightResult->reps}}
                @endforeach
            </p>
        </div>
        
        <div class="yourBest">
            <p>
                最近のあなたのベスト
            </p>
            <p>
                {{$maxResult->weight ?? 'データなし'}}&nbsp;{{$maxResult->reps ?? ''}}
            </p>
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
        
        <div class='latestResult'>
            <p>
                latestResult
            </p>
            @foreach ($latestResults as $latestResult)
                <p>{{$latestResult->updated_at}}&nbsp;&nbsp;&nbsp;{{$latestResult->weight}}&nbsp;{{$latestResult->reps}}<br></P>
            @endforeach
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