<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>appExplanation</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!--css-->
        <link rel="stylesheet" href="{{asset('/css/appExplanation.css')}}"/>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-app-layout>
            <x-slot name="title">
                <h2>
                    {{ __('appExplanation') }}
                </h2>
            </x-slot>
            
            <div class="container">
                
                <div class="container-appExplanation">
                    
                    <div class="appExplanation_details">
                        <h1>アプリの説明kwsk</h1>
                        <p>筋トレには漸進性の原則というものがあり、毎度トレーニングの負荷を高めていく必要があります。</p>
                        <p>しかし、今自分が何キロを何回やれるのかは「感覚」で判断するのが通常です。</p>
                        <P>そこで！私はユーザーのトレーニングデータに基づき、重量やレップ数をアドバイスしてくれるツールを作成しました！</P>
                        <p>これがあれば時間や脳のリソースの節約になります。</p>
                    </div>
                    
                    <div class="app_evidence">
                        <h1>アドバイスの根拠は？</h1>
                        <p>RM換算表と呼ばれる指標があります。Max重量早見表とも言います。</p>
                        <p>RMとはRepetition Maximumの略で、ある「重さ」で「何回」持ち上げられるかを示してくれる表になります。</p>
                        <p>例えば、ベンチプレス「40kg」を「11回」持ち上げられると、それは「51kg」を「1回」持ち上げられる能力に等しいことがひと目でわかります。</p>
                        <p>また、そこから派生して「42.5kg」を「8回」やれる能力が備わっていることもわかります。</p>
                        <p>「8回」できればステップアップには十分です。これで次回のトレーニングの重さを「42.5kg」に設定するタイミングがわかりました。</p>
                        <p>こんなことをアプリではやりたかったのです。</p>
                        <p>ただ単にRM換算を行ってくれるだけのツールは存在します。</p>
                        <p>しかし、ユーザーの過去の実績をデータベース化し、それを考慮したうえで適切なタイミングをアドバイスしてくれるようなツールはありませんでした。</p>
                        <P>それを実現するのが、この『logicalift』です！！</P>
                    </div>
                    
                    <div class="howToCalculate">
                        <h1>RM換算のからくり</h1>
                        <p>以下の計算式で決まります。</p>
                        <h2># 1RMの計算方法</h2>
                        <p>1RM = weight(重量) × ( 1 + reps(回数)/40 )</p>
                        <h2># 1RMが分かったところで次のweight(=newWeight)に更新したときに、持ち上げられるreps(=newReps)の計算方法 </h2>
                        <p>newReps = ( 1RM/(newWeight) -1 ) × 40</p>
                        
                        <P>以上のような計算をコンピュータの中で行い、ユーザーにアドバイス致します！</P>
                    </div>
                    
                    <div class="backToDashboard">
                        <a class="theLink" href="/dashboard">戻る</a>
                    </div>
                    
                </div>
                
            </div>
            
        </x-app-layout>
    </body>
</html>