<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('home.user.show', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        return view('home.user.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'about' => [
                'nullable',
                'string',
            ],
        ]);
        $user->update($validated);
        return back()->with('success', '你的信息更新成功！');
    }
}
