<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validateWithBag('user', [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', Password::min(4)],
        ]);
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        return back()->with('success', '成功添加用户！');
    }

    public function role(Request $request, User $user)
    {
        $validated = $request->validateWithBag('setRole' . $user->id, [
            'role' => ['required', Rule::in(User::$roles)],
        ]);
        $user->update($validated);
        return back()->with('success', '用户角色设置成功！');
    }
}
