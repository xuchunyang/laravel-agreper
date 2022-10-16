<x-layout>
    <x-slot:title>
        新建主题
    </x-slot:title>

    <x-slot:pageNav>
        <x-page-nav :forum="$forum"/>
    </x-slot:pageNav>

    <form action="{{ route('thread.store', ['forum' => $forum]) }}" method="post">
        @csrf
        <table class="form">
            <tbody>
            <tr>
                <td><label for="title">标题</label></td>
                <td>
                    <input type="text" id="title" name="title" value="{{ old('title') }}">
                    @error('title')
                    <span class="validation-error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="content">内容</label></td>
                <td>
                    <textarea id="content" name="content">{{ old('content') }}</textarea>
                    @error('content')
                    <span class="validation-error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            </tbody>
        </table>
        <p><input type="submit" value="创建话题"></p>
    </form>

</x-layout>
