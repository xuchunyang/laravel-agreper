<x-layout title="注册">
    <form action="{{ route('register.store') }}" method="post" class="login">
        @csrf
        <table>
            <tbody>
            <tr>
                <td><label for="name">用户名</label></td>
                <td>
                    <input id="name" type="text" name="name" value="{{ old('name') }}">
                </td>
            </tr>
            @error('name')
            <tr>
                <td></td>
                <td><span class="validation-error">{{ $message }}</span></td>
            </tr>
            @enderror
            <tr>
                <td><label for="password">密码</label></td>
                <td>
                    <input id="password" type="password" name="password">
                </td>
            </tr>
            @error('password')
            <tr>
                <td></td>
                <td><span class="validation-error">{{ $message }}</span></td>
            </tr>
            @enderror
            <tr>
                <td><label for="password_confirmation">确认密码</label></td>
                <td>
                    <input id="password_confirmation" type="password" name="password_confirmation">
                </td>
            </tr>
            </tbody>
        </table>
        <p>
            <input type="submit" value="注册">
        </p>
    </form>
</x-layout>
