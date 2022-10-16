<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validateWithBag('newForum', [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);
        Forum::create($validated);
        return back()->with('success', '成功添加论坛！');
    }

    public function updateName(Request $request, Forum $forum)
    {
        $validated = $request->validateWithBag('forumName' . $forum->id, [
            'name' => ['required', 'string', 'max:255'],
        ]);
        $forum->update($validated);
        return back()->with('success', '成功更新论坛名称！');
    }

    public function updateDescription(Request $request, Forum $forum)
    {
        $validated = $request->validateWithBag('forumDescription' . $forum->id, [
            'description' => ['nullable', 'string'],
        ]);
        $forum->update($validated);
        return back()->with('success', '成功更新论坛描述！');
    }

    public function destroy(Forum $forum)
    {
        $forum->delete();
        return back()->with('success', '成功删除论坛！');
    }
}
