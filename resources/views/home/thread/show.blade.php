<x-layout>
    <x-slot:title>
        {{ $thread->title }}
    </x-slot:title>

    <x-slot:pageNav>
        <x-page-nav :forum="$forum" :thread="$thread"/>
    </x-slot:pageNav>

    <p class="small">
        <i>
            <a href="{{ route('user.show', ['user' => $thread->user]) }}">{{ $thread->user->name }}</a>
            -
            {{ $thread->created_at->diffForHumans() }}
        </i>
        @can('update', $thread)
            <a href="{{ route('thread.edit', ['forum' => $forum, 'thread' => $thread]) }}">编辑</a>
            <a href="{{ route('thread.confirm-delete', ['forum' => $forum, 'thread' => $thread]) }}">删除</a>
        @endcan
    </p>

    <x-markdown class="markdown">
        {!! $thread->content !!}
    </x-markdown>

    @can('create', \App\Models\Comment::class)
        <form action="{{ route('comment.store', ['forum' => $forum, 'thread' => $thread]) }}" method="post">
            @csrf
            <p><textarea name="content"></textarea></p>
            @error('content')
            <p class="validation-error">{{ $message }}</p>
            @enderror
            <p><input type="submit" value="发表评论"></p>
        </form>
    @endcan
    @guest
        <p><small><i>发表评论，请先<a href="{{ route('login') }}">登陆！</a></i></small></p>
    @endguest

    @foreach($comments as $comment)
        <div class="comment"
             style="margin-left: {{ $comment->depth * 20 }}px">
            <x-comment-status-line :comment="$comment" :forum="$forum" :thread="$thread"/>
            <div>
                <x-markdown class="markdown">
                    {!! $comment->content !!}
                </x-markdown>
                @can('create', \App\Models\Comment::class)
                    <a href="{{ route('comment.show', ['forum' => $forum, 'thread' => $thread, 'comment' => $comment['id']]) }}">
                        <small>回复</small>
                    </a>
                @endcan
                @guest
                    <a href="{{ route('login') }}">回复</a>
                @endguest
            </div>
        </div>
    @endforeach

</x-layout>
