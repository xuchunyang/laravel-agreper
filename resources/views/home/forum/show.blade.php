<x-layout>
    <x-slot:title>
        {{ $forum->name }}
    </x-slot:title>

    <x-slot:pageNav>
        <x-page-nav :forum="$forum"/>
    </x-slot:pageNav>

    @if($forum->description)
        <x-markdown class="markdown">
            {!! $forum->description !!}
        </x-markdown>
    @endif

    @can('create', \App\Models\Thread::class)
        <p><a href="{{ route('thread.create', ['forum' => $forum]) }}">新建话题</a></p>
    @endcan

    <table>
        <tbody>
        <tr>
            <th>话题</th>
            <th>作者</th>
            <th>创建于</th>
            <th>最近更新</th>
            <th>评论</th>
        </tr>

        @foreach($threads as $thread)
            <tr>
                <th>
                    <a href="{{ route('thread.show', ['forum' => $forum, 'thread' => $thread]) }}">
                        {{ $thread->title }}
                    </a>
                </th>
                <td><a href="{{ route('user.show', ['user' => $thread->user]) }}">{{ $thread->user->name }}</a></td>
                <td>{{ $thread->created_at->shortRelativeToNowDiffForHumans() }}</td>
                <td>{{ $thread->updated_at->shortRelativeToNowDiffForHumans() }}</td>
                <td>{{ $thread->comments->count() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
