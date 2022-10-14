<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class UpdateSettingController extends Controller
{
    public function __invoke(Request $request, Setting $setting)
    {
        $validated = $request->validateWithBag('setting', [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'registration_enabled' => ['required', 'boolean'],
        ]);
        $setting->update($validated);
        return back()->with('success', '网站设置更新成功！');
    }
}
