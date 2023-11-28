<x-app-layout class="">
    <x-slot name="title">
        <h2>
            {{ __('Home') }}
        </h2>
    </x-slot>
    
    <div class="container">
        
        <div>
            <h1>フレンド</h1>
            <a class="theLink" href="/friends">フレンド一覧へ</a>
        </div>
        
        <div>
            <h1>自分とフレンドの実績</h1>
            <p>…共有メニューそれぞれに対し、バブルチャートが展開され、自分とフレンドの実績を比較できる</p>
        </div>
        
        
    </div>
    
</x-app-layout>
