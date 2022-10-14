<x-layout>
    @if($setting->description)
        <p>{{ $setting->description }}</p>
    @endif

    <table>
        <tbody>
        <tr>
            <th>论坛</th>
            <th>最新话题</th>
        </tr>
        @foreach($forums as $forum)
            <tr>
                <td>
                    <p><a href="{{ route('forum.show', ['forum' => $forum]) }}"><b>{{ $forum->name }}</b></a></p>
                    <p></p>
                    <p>
                        {{ $forum->description }}
                    </p>
                    <p></p>
                </td>
                <td>
                    @php
                        $thread = $forum->threads()->latest()->first();
                    @endphp
                    @if(!$thread)
                        <p>暂时没有话题！</p>
                    @else
                        <p>
                            <a href="{{ route('thread.show', ['forum' => $forum, 'thread' => $thread]) }}">
                                <b>{{ $thread->title }}</b>
                            </a>
                        </p>
                        <p>{{ $thread->updated_at->shortRelativeToNowDiffForHumans() }}</p>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
