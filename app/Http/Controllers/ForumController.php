<?php

namespace App\Http\Controllers;

use App\Models\Forum;

class ForumController extends Controller
{
    public function index()
    {
        return view('home.forum.index', [
            'forums' => Forum::all(),
        ]);
    }

    public function show(Forum $forum)
    {
        return view('home.forum.show', [
            'forum' => $forum,
            'threads' => $forum->threads()->latest()->get(),
        ]);
    }
}
