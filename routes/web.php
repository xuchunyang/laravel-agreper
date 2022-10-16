<?php

use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\UpdateSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController as HomeForumController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
use App\Models\Comment;
use App\Models\Thread as Thread;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 登陆
Route::get('/login', [LoginController::class, 'show'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])
    ->middleware('guest')
    ->name('login.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// 注册
Route::get('/register', [RegisterController::class, 'create'])
    ->middleware(['guest', 'can:register'])
    ->name('register');
Route::post('/register', [RegisterController::class, 'store'])
    ->middleware(['guest', 'can:register'])
    ->name('register.store');

// 论坛
Route::get('/', [HomeForumController::class, 'index'])->name('home');
Route::get('/forum/{forum}', [HomeForumController::class, 'show'])->name('forum.show');

// 话题
Route::get('/forum/{forum}/thread/{thread}', [ThreadController::class, 'show'])
    ->name('thread.show');
Route::get('/forum/{forum}/thread', [ThreadController::class, 'create'])
    ->can('create', Thread::class)
    ->name('thread.create');
Route::post('/forum/{forum}/thread', [ThreadController::class, 'store'])
    ->can('create', Thread::class)
    ->name('thread.store');
Route::middleware('can:update,thread')->group(function () {
    Route::get('/forum/{forum}/thread/{thread}/edit', [ThreadController::class, 'edit'])
        ->name('thread.edit');
    Route::post('/forum/{forum}/thread/{thread}/edit', [ThreadController::class, 'update'])
        ->name('thread.update');
    Route::get('/forum/{forum}/thread/{thread}/confirm_delete', [ThreadController::class, 'confirmDelete'])
        ->name('thread.confirm-delete');
    Route::delete('/forum/{forum}/thread/{thread}', [ThreadController::class, 'destroy'])
        ->name('thread.delete');
});

// 评论
Route::get('/forum/{forum}/thread/{thread}/comment/{comment}', [CommentController::class, 'show'])
    ->can('create', Comment::class)
    ->name('comment.show');
Route::post('/forum/{forum}/thread/{thread}/comment', [CommentController::class, 'store'])
    ->can('create', Comment::class)
    ->name('comment.store');
Route::get('/forum/{forum}/thread/{thread}/comment/{comment}/edit', [CommentController::class, 'edit'])
    ->can('update', 'comment')
    ->name('comment.edit');
Route::patch('/forum/{forum}/thread/{thread}/comment/{comment}/edit', [CommentController::class, 'update'])
    ->can('update', 'comment')
    ->name('comment.update');
Route::get('/forum/{forum}/thread/{thread}/comment/{comment}/delete', [CommentController::class, 'destroy'])
    ->can('delete', 'comment')
    ->name('comment.delete');

// Profile
Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
Route::middleware(['auth', 'can:edit,user'])->group(function () {
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/user/{user}/edit', [UserController::class, 'update'])->name('user.update');
});

// Admin
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })
        ->name('admin.index');

    Route::post('/admin/query', QueryController::class)
        ->name('admin.query');

    Route::patch('/admin/setting/{setting}', UpdateSettingController::class)
        ->name('admin.update-setting');

    Route::post('/admin/forum', [AdminForumController::class, 'store'])
        ->name('admin.forum.store');

    Route::patch('/admin/forum', [AdminForumController::class, 'update'])
        ->name('admin.forum.update');

    Route::patch('/admin/forum/{forum}/name', [AdminForumController::class, 'updateName'])
        ->name('admin.forum.name');

    Route::patch('/admin/forum/{forum}/description', [AdminForumController::class, 'updateDescription'])
        ->name('admin.forum.description');

    Route::delete('/admin/forum/{forum}', [AdminForumController::class, 'destroy'])
        ->name('admin.forum.delete');

    Route::post('/admin/user', [AdminUserController::class, 'store'])
        ->name('admin.user.store');
});
