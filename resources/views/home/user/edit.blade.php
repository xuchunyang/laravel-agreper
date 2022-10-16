<x-layout>
    <x-slot:title>
        编辑个人信息
    </x-slot:title>

    <p><a href="{{ route('user.show', ['user' => $user]) }}">查看你的个人信息</a></p>

    <form action="{{ route('user.update', ['user' => $user]) }}" method="post">
        @csrf
        @method('PATCH')
        <table>
            <tbody>
            <tr>
                <td>ID</td>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <td><label for="name">用户名</label></td>
                <td>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}">
                    @error('name')<span class="validation-error">{{ $message }}</span>@enderror
                </td>
            </tr>
            <tr>
                <td><label for="about">个人介绍</label></td>
                <td>
                    <textarea id="about" name="about">{{ old('about', $user->about) }}</textarea>
                    @error('about')<span class="validation-error">{{ $message }}</span>@enderror
                </td>
            </tr>
            </tbody>
        </table>
        <input type="submit" value="更新">
    </form>
</x-layout>
