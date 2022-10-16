@props([
    /** @var \App\Models\Comment */
    'comment',
    /** @var \App\Models\Forum */
    'forum',
    /** @var \App\Models\Thread */
    'thread'
])

<p {{ $attributes->class(['small']) }}>
    <i><a href="{{ route('user.show', ['user' => $comment->user]) }}">
            {{ $comment->user->name }}
        </a>
        - {{ $comment->created_at->diffForHumans() }}
        @if($comment->updated_at->gt($comment->created_at))
            (修改于 {{ $comment->updated_at->diffForHumans() }})
        @endif
    </i>
    @can('update', $comment)
        |
        <a href="{{ route('comment.edit', ['forum' => $forum, 'thread' => $thread, 'comment' => $comment->id]) }}">
            编辑
        </a>
    @endcan
    @can('delete', $comment)
        @if(! \App\Models\Comment::query()->where('parent_id', $comment->id)->exists())
            <a href="{{ route('comment.delete', ['forum' => $forum, 'thread' => $thread, 'comment' => $comment->id]) }}">
                删除
            </a>
        @endif
    @endcan
</p>
