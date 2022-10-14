<?php

use App\Http\Controllers\Admin\ForumController as AdminForumController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\Admin\UpdateSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForumController as HomeForumController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeForumController::class, 'index']);

Route::get('/forum/{forum}', [HomeForumController::class, 'show'])->name('forum.show');

Route::get('/forum/{forum}/thread', [ThreadController::class, 'create'])->name('thread.create');
Route::post('/forum/{forum}/thread', [ThreadController::class, 'store'])->name('thread.store');
Route::get('/forum/{forum}/thread/{thread}', [ThreadController::class, 'show'])->name('thread.show');
Route::get('/forum/{forum}/thread/{thread}/edit', [ThreadController::class, 'edit'])->name('thread.edit');
Route::post('/forum/{forum}/thread/{thread}/edit', [ThreadController::class, 'update'])->name('thread.update');
Route::get('/forum/{forum}/thread/{thread}/confirm_delete', [ThreadController::class, 'confirmDelete'])->name('thread.confirm-delete');
Route::delete('/forum/{forum}/thread/{thread}', [ThreadController::class, 'destroy'])->name('thread.delete');

Route::post('/forum/{forum}/thread/{thread}/comment', [CommentController::class, 'store'])
    ->name('comment.store');

Route::get('/forum/{forum}/thread/{thread}/comment/{comment}', [CommentController::class, 'show'])
    ->name('comment.show');

Route::get('/forum/{forum}/thread/{thread}/comment/{comment}/edit', [CommentController::class, 'edit'])
    ->name('comment.edit');

Route::patch('/forum/{forum}/thread/{thread}/comment/{comment}/edit', [CommentController::class, 'update'])
    ->name('comment.update');

Route::get('/forum/{forum}/thread/{thread}/comment/{comment}/delete', [CommentController::class, 'destroy'])
    ->name('comment.delete');

Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::patch('/user/{user}/edit', [UserController::class, 'update'])->name('user.update');

Route::get('/admin', fn() => view('admin.index'))
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
