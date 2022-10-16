<x-layout>
    <x-slot:title>
        {{ $user->name }}
    </x-slot:title>

    @if($user->about)
        <x-markdown class="markdown">
            {!! $user->about !!}
        </x-markdown>
    @else
        @if(Auth::id() === $user->id)
            <p>你没有填写个人介绍！</p>
        @else
            <p>这位用户没有填写个人介绍！</p>
        @endif
    @endif

    @can('edit', $user)
        <a href="{{ route('user.edit', ['user' => Auth::user()]) }}">编辑个人信息</a>
    @endcan
</x-layout>
