<x-layout>
    <x-slot:title>
        个人信息
    </x-slot:title>

    @can('edit', $user)
        <a href="{{ route('user.edit', ['user' => Auth::user()]) }}">编辑个人信息</a>
    @endcan

    <table>
        <tbody>
        <tr>
            <td>ID</td>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <td>用户名</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>个人介绍</td>
            <td>{{ $user->about }}</td>
        </tr>
        </tbody>
    </table>
</x-layout>
