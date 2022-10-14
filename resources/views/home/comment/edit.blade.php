<x-layout>
    <x-slot:title>
        编辑评论
    </x-slot:title>

    <form action="{{ route('comment.update', ['forum' => $forum, 'thread' => $thread, 'comment' => $comment]) }}"
          method="post">
        @csrf
        @method('PATCH')
        <p><textarea name="content">{{ old('content', $comment->content) }}</textarea></p>
        @error('content')
        <p class="validation-error">{{ $message }}</p>
        @enderror
        <p><input type="submit" value="保存评论"></p>
    </form>

</x-layout>
