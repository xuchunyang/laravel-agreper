<x-layout>
    <x-slot:title>
        {{ $thread->title }}
    </x-slot:title>

    <p>{{ $comment->content }}</p>

    <form action="{{ route('comment.store', ['forum' => $forum, 'thread' => $thread]) }}"
          method="post">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
        @error('parent_id')
        <p class="validation-error">{{ $message }}</p>
        @enderror
        <p><textarea name="content">{{ old('content') }}</textarea></p>
        @error('content')
        <p class="validation-error">{{ $message }}</p>
        @enderror
        <p><input type="submit" value="发表评论"></p>
    </form>

</x-layout>
