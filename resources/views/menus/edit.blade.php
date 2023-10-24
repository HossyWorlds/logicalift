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
                <p class="name_error" style="color:red">{{$errors->first('menu.name')}}</p>
            </div>
            <div class='category'>
                <h2>menuCategory?</h2>
                <select name="menu[category_id]">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$menu->category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="plusWeight">
                <h2>plusWeight?</h2>
                <input type="number" name="menu[plus_weight]" step="0.1" value="{{$menu->plus_weight}}"/>kg<br>
                <p class="plusWeight_error" style="color:red">{{$errors->first('menu.plus_weight')}}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </div>
</body>