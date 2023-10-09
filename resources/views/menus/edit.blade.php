<!-- body内だけを表示しています。 -->
<body>
    <h1 class="title">編集画面</h1>
    <div class="content">
        <form action="/menus/{{ $menu->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class='name'>
                <h2>nameName?</h2>
                <input type='text' name='menu[name]' value="{{ $menu->name }}">
            </div>
            <div class='category'>
                <h2>menuCategory?</h2>
                <select name="menu[category_id]">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
            </div>
            <input type="submit" value="保存">
            <div class="footer">
                <a href="/">戻る</a>
            </div>
        </form>
    </div>
</body>