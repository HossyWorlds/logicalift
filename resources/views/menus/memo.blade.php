<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Memo</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!--css-->
        <link rel="stylesheet" href="{{asset('/css/index.css')}}"/>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body>
        
        <div>
            <div class="container">
                <div class="wrapper">
                    @foreach ($results as $result)
                    <div class="memoBox">
                        <p class="memoDay">{{$result->created_at}}</p>
                        <p class="memoText">{{$result->memo}}</p>       
                    </div>
                    @endforeach
                </div>
                <!--showへ-->
                <form action="/menus/{{$menu->id}}">
                    <button class="backToShow">戻る</button>
                </form>
            </div>
        </div>
    </body>
</html>

<style>

.container {
    max-width: 600px;
    margin: 0 auto;
}

.memoBox {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.memoDay {
    font-weight: bold;
    margin-bottom: 5px;
}

.memoText {
    margin-bottom: 0;
}


.backToShow {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
</style>