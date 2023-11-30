<x-app-layout class="">
    <x-slot name="title">
        <h2>
            {{ __('Admin Friend') }}
        </h2>
    </x-slot>
    
    <div class="container">
        <div>フレンドを探す</div>
        
        <div>検索ボックス</div>
        <div class="searchFor">
            <form action="/friends/adminFriend" method="GET">
                @csrf
                <input type="text" name="keyword" value="{{ $keyword }}">
                <input type="submit" value="検索">
            </form>
        </div>
        
        <div>
            <form>
                @csrf
                @foreach ($users as $user)
                id:{{$user->id}},&nbsp;name:{{$user->name}}
                <button>
                    <input type="submit" value="フレンドリクエスト">
                </button>
                @endforeach
            </form>
        </div>
        
    </div>
    
</x-app-layout>