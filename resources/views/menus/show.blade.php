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
        
        <div class="advice">
            <p>
                {{$advice ?? ''}}
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
        
        <div class="stepUp">
            <p>
                ステップアップの間隔
            </p>
            <P>
                {{$menu->plus_weight}}
            </P>
        </div>    
        <div class="newWeight">
            <p>
                次の重さ
            </p>
            <p>
                {{$newWeight ?? 'データなし'}}
            </p>
        </div>
        <div class="sharingOrNot">
            {{$sharing}}
        </div>
        
        <div class="training">
            <form action="/menus/{{$menu->id}}/workout" method="post">
                @csrf
                <div class="weight">
                    <input type="number" name="result[weight]" step="0.1" value="{{ old('result.weight') }}">kg
                    <p class="weight_error" style="color:red">{{$errors->first('result.weight')}}</p>
                </div>
                <div class="repetition">
                    <input type="number" name="result[reps]" value="{{ old('result.reps') }}">reps
                    <p class="reps_error" style="color:red">{{$errors->first('result.reps')}}</p>
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
            <form  action="/menus/{{$menu->id}}/reset" id="form_{{$menu->id}}" method="post">
                @csrf
                @method('delete')
                <button type="button" onclick="resetResults({{$menu->id}})">reset</button>
            </form>
        </div>
        <div class="delete">
            <form action="/menus/{{$menu->id}}" id="form_{{$menu->id}}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deleteMenu({{$menu->id}})">delete</button>
            </form>
        </div>
        
        
        <script>
                function deleteMenu(id) {
                    'use strict'//最新の方法で動作させるときに書くコード
                    
                    
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                        //${}はjavascriptの変数の書き方
                        //deleteメソットを持つformにsubmitすることで
                    }
                }
                
                function resetResults(id) {
                    'use strict'
                    if (confirm('本当にリセットしますか？')) {
                        document.getElementById(`form_${id}`).submit();
                    }
                }
        </script>
    </body>
</html>