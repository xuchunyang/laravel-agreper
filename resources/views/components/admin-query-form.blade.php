<form action="{{ route('admin.query') }}" method="post">
    @csrf
    @if($errors->query->any())
        <div class="error">
            <p>查询出错了！错误提示：</p>
            <ul>
                @foreach($errors->query->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <label>
        SQL:<input
            type="text"
            name="sql"
            placeholder="SELECT * from users"
            value="{{ $errors->query->any() ? old('sql') : ''}}">
    </label>
    <input type="submit">
</form>
