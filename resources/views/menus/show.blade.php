<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ShowMenu</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!--css-->
        <link rel="stylesheet" href="{{asset('/css/index.css')}}"/>
        
    </head>
    <body>
    <x-app-layout>
        <x-slot name="title">
            <h2>
                {{ $menu->name }}
            </h2>
        </x-slot>
        
        <div>
            <div class="container">
                <div class="menuInfo">
                    <div class="category">
                        <p>
                            部位：{{$menu->category->name}}
                        </p>
                    </div>
                    <div class="stepUp">
                        <p>
                            ステップアップの間隔: {{$menu->plus_weight}}
                        </p>
                    </div>
                    <!--ほかにも必要なことあれば-->
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
                
                <div>
                    @if ($menu->user_id == $user_id)
                        <div class="edit">
                            <a href="/menus/{{$menu->id}}/edit">edit</a>
                        </div>
                        @if ($menu->sharing == 0)
                            <div class="delete">
                                <form action="/menus/{{$menu->id}}" id="form_{{$menu->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteMenu({{$menu->id}})">delete</button>
                                </form>
                            </div>
                        @else
                        @endif
                    @else
                        <div class="remove">
                            <form action="/menus/{{$menu->id}}/remove" id="form_{{$menu->id}}" method="post">
                                @csrf
                                <button type="button" onclick="removeMenu({{$menu->id}})">remove</button>
                            </form>
                        </div>
                    @endif
                    <div class="reset">
                        <form action="/menus/{{$menu->id}}/reset" id="form_{{$menu->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="button" onclick="resetResults({{$menu->id}})">reset</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div>
                <!--bubbleChart-->
                <div class="chart">
                    <canvas id="bubbleChart"></canvas>
                </div>
                <!--latestResult-->
                <div class="latestResult">
                    <p>
                        LatestResult
                    </p>
                    @foreach ($latestResults as $latestResult)
                        <p>{{$latestResult->updated_at}}&nbsp;&nbsp;&nbsp;{{$latestResult->weight}}&nbsp;{{$latestResult->reps}}<br></P>
                    @endforeach
                </div>
            </div>
        </div>
        
    </x-app-layout>
        
        
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
            
            function removeMenu(id) {
                'use strict'
                if (confirm('このメニューをインデックスから取り除きますが、よろしいですか？\nあなたのトレーニングデータは削除されます')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
            
            // bubbleChart
            var ctx = document.getElementById("bubbleChart").getContext("2d");
            var data = @json($bubbleResults);
            
            var chartData = {
                datasets: [{
                    label: 'あなた',
                    data: data.map(result => ({
                        x: result.weight,
                        y: result.reps,
                        r: 10
                        //もしこれがうまくいかなかったら数値の個数に応じてrの値を定める
                    })),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            };
            
            var bubbleChart = new Chart(ctx, {
                type: 'bubble',
                data: chartData,
                options: {
                    scales: {
                        x: {
                            type: 'linear',
                            position: 'bottom',
                            ticks: {
                                stepSize: 0.5
                            }
                        },
                        y: {
                            type: 'linear',
                            position: 'left',
                            ticks: {
                                stepSize: 1.0
                            }
                        }
                    }
                }
            });
        </script>
        
        
    </body>
</html>