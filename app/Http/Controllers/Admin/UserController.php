<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validateWithBag('user', [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', Password::min(4)],
        ]);
        User::create($validated);
        return back()->with('success', '成功添加用户！');
    }
}
