<x-layout>
    <x-slot:title>
        {{ $thread->title }}
    </x-slot:title>

    <p class="small">
        <i><a href="">{{ $thread->user->name }}</a> - 20 minutes ago</i>
        <a href="{{ route('thread.edit', ['forum' => $forum, 'thread' => $thread]) }}"> edit</a>
        <a href="{{ route('thread.confirm-delete', ['forum' => $forum, 'thread' => $thread]) }}"> delete</a>
    </p>

    <p>{{ $thread->content }}</p>

    <form action="{{ route('comment.store', ['forum' => $forum, 'thread' => $thread]) }}" method="post">
        @csrf
        <p><textarea name="content"></textarea></p>
        @error('content')
        <p class="validation-error">{{ $message }}</p>
        @enderror
        <p><input type="submit" value="发表评论"></p>
    </form>

    @foreach($comments as $comment)
        <div class="comment"
             style="margin-left: {{ $comment->depth * 20 }}px">
            <span class="small">
                <i><a href="">{{ $comment->user->name }}</a> - {{ $comment->created_at->diffForHumans() }}</i>
                |
                <a href="{{ route('comment.edit', ['forum' => $forum, 'thread' => $thread, 'comment' => $comment->id]) }}">edit</a>
                <a href="{{ route('comment.delete', ['forum' => $forum, 'thread' => $thread, 'comment' => $comment->id]) }}">delete</a>
            </span>
            <div>
                <p>{{ $comment['content'] }}</p>
                <small>
                    <a href="{{ route('comment.show', ['forum' => $forum, 'thread' => $thread, 'comment' => $comment['id']]) }}">回复</a>
                </small>
            </div>
        </div>
    @endforeach

</x-layout>
