<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Forum;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    public function store(Request $request, Forum $forum, Thread $thread)
    {
        $validated = $request->validate([
            'content' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ]);
        $validated['user_id'] = User::first()->id;
        $thread->comments()->create($validated);

        return back()->with('success', '评论发表成功！');
    }

    public function show(Request $request, Forum $forum, Thread $thread, Comment $comment)
    {
        return view('home.comment.reply', [
            'forum' => $forum,
            'thread' => $thread,
            'comment' => $comment,
        ]);
    }

    public function edit(Forum $forum, Thread $thread, Comment $comment)
    {
        return view('home.comment.edit', [
            'forum' => $forum,
            'thread' => $thread,
            'comment' => $comment,
        ]);
    }

    public function update(Request $request, Forum $forum, Thread $thread, Comment $comment)
    {
        $validated = $request->validate([
            'content' => ['required', 'string'],
        ]);
        $comment->update($validated);
        return redirect(route('comment.show', [
            'forum' => $forum,
            'thread' => $thread,
            'comment' => $comment
        ]))->with('success', '评论编辑成功！');
    }

    public function destroy(Forum $forum, Thread $thread, Comment $comment)
    {
        $comment->delete();
        return back()->with('success', '评论删除成功！');
    }
}
