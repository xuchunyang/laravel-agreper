<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function create(Forum $forum)
    {
        return view('home.thread.create', [
            'forum' => $forum,
        ]);
    }

    public function store(Request $request, Forum $forum)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);
        $validated['forum_id'] = $forum->id;
        $validated['user_id'] = Auth::user()->id;

        $thread = Thread::create($validated);
        return redirect(route('thread.show', [
            'forum' => $forum,
            'thread' => $thread,
        ]))->with('success', '主题创建成功！');
    }

    public function show(Forum $forum, Thread $thread)
    {
        return view('home.thread.show', [
            'forum' => $forum,
            'thread' => $thread,
            'comments' => $thread->commentsFlatTree(),
        ]);
    }

    public function edit(Forum $forum, Thread $thread)
    {
        return view('home.thread.edit', [
            'forum' => $forum,
            'thread' => $thread,
        ]);
    }

    public function update(Request $request, Forum $forum, Thread $thread)
    {
        $this->authorize('update', $thread);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);
        $thread->update($validated);
        return redirect(route('thread.show', ['forum' => $forum, 'thread' => $thread]))
            ->with('success', '主题编辑成功！');
    }

    public function confirmDelete(Forum $forum, Thread $thread)
    {
        return view('home.thread.confirm-delete', [
            'forum' => $forum,
            'thread' => $thread,
        ]);
    }

    public function destroy(Forum $forum, Thread $thread)
    {
        $thread->delete();
        return redirect(route('forum.show', ['forum' => $forum]))
            ->with('success', '主题删除成功！');
    }
}
