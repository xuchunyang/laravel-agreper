<x-layout title="登陆">
    <form action="{{ route('login.authenticate') }}" method="post" class="login">
        @csrf
        <table>
            <tbody>
            <tr>
                <td>用户名</td>
                <td>
                    <input type="text" name="name" value="{{ old('name') }}">
                </td>
            </tr>
            @error('name')
            <tr>
                <td></td>
                <td><span class="validation-error">{{ $message }}</span></td>
            </tr>
            @enderror
            <tr>
                <td>密码</td>
                <td>
                    <input type="password" name="password">
                </td>
            </tr>
            @error('password')
            <tr>
                <td></td>
                <td><span class="validation-error">{{ $message }}</span></td>
            </tr>
            @enderror
            </tbody>
        </table>
        <p>
            <input type="submit" value="登陆">
        </p>
    </form>
</x-layout>
