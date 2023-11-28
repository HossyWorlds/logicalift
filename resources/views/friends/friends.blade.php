<x-app-layout class="">
    <x-slot name="title">
        <h2>
            {{ __('Friends') }}
        </h2>
    </x-slot>
    
    <div class="container">
        <h1>Your Friends</h1>
        
        <ul>
            @foreach($friends as $friend)
                <li>{{ $friend->user->name }} ({{ $friend->status }})</li>
            @endforeach
        </ul>
        <a class="theLink" href="/friends/adminFriend">フレンドを作る</a>
        
        <h1>Friend Requests</h1>
    
        <ul>
            @foreach($friendRequests as $request)
            <li>
                {{ $request->user->name }} wants to be your friend!
                <form method="post" action="{{ route('friends.accept', $request->id) }}" style="display: inline;">
                    @csrf
                    <button type="submit">Accept</button>
                </form>
                <form method="post" action="{{ route('friends.reject', $request->id) }}" style="display: inline;">
                    @csrf
                    <button type="submit">Reject</button>
                </form>
            </li>
            @endforeach
        </ul>
    </div>
    
</x-app-layout>