@props(['forum' => null, 'thread' => null])
<div class="page-nav">
    <span>
        <a href="/">首页</a>
    </span>
    @if($forum)
        <span>
            <a href="{{ route('forum.show', ['forum' => $forum]) }}">{{ $forum->name }}</a>
        </span>
    @endif
    @if($thread)
        <span>
            <a href="{{ route('thread.show', ['forum' => $forum, 'thread' => $thread]) }}">{{ $thread->title }}</a>
        </span>
    @endif
</div>
