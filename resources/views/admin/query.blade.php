<x-admin-layout>
    <x-slot:title>
        SQL 查询结果 | 管理面板
    </x-slot:title>

    <h1>SQL 查询结果</h1>
    <p>
        <a href="/admin">管理面板</a>
        <a href="/">首页</a>
    </p>

    <p>SQL 表达式 <code>{{ $sql }}</code> 的执行结果是：</p>

    @if($results === [])
        <p>没有结果！</p>
    @else
        <table>
            <thead>
            <tr>
                @foreach(get_object_vars($results[0]) as $key => $value)
                    <th>{{ $key }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    @foreach(get_object_vars($result) as $value)
                        <td>{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</x-admin-layout>
