<x-layout>
    <x-slot:title>
        删除主题
    </x-slot:title>

    <x-slot:pageNav>
        <x-page-nav :forum="$forum" :thread="$thread"/>
    </x-slot:pageNav>

    <p>你确认要删除主题 【{{ $thread->title }}】吗？</p>

    <form method="get" action="{{ route('thread.show', ['forum' => $forum, 'thread' => $thread]) }}">
        <input type="submit" value="No">
    </form>

    <form method="post" action="{{ route('thread.delete', ['forum' => $forum, 'thread' => $thread]) }}">
        @csrf
        @method('DELETE')
        <input type="submit" value="Yes">
    </form>

</x-layout>
