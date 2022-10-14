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

    @foreach($thread->comments as $comment)
        <div class="comment">
            <span class="small">
                <i><a href="">{{ $comment->user->name }}</a> - {{ $comment->created_at->shortRelativeToNowDiffForHumans() }}</i>
                |
                <a href="{{ route('comment.edit', ['forum' => $forum, 'thread' => $thread, 'comment' => $comment]) }}">edit</a>
                <a href="{{ route('comment.delete', ['forum' => $forum, 'thread' => $thread, 'comment' => $comment]) }}">delete</a>
            </span>
            <div>
                <p>{{ $comment->content }}</p>
                <a href="{{ route('comment.show', ['forum' => $forum, 'thread' => $thread, 'comment' => $comment]) }}">回复</a>
            </div>
        </div>
    @endforeach

</x-layout>
