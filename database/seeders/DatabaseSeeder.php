<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Forum;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use function Termwind\ask;
use function Termwind\render;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Setting::create([
            'name' => 'Agreper',
            'registration_enabled' => true,
        ]);
        Log::channel('stderr')->info('Setting Created');

        Forum::create([
            'name' => '闲聊灌水',
        ]);
        Log::channel('stderr')->info('Form Created');

        User::create([
            'name' => ask('管理员用户名: '),
            'password' => Hash::make(ask('管理员密码: ')),
        ]);
        Log::channel('stderr')->info('Admin Created');
    }
}
