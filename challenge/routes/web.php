<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/discussion/show/{id}', [DiscussionController::class, 'show'])->name('discussion.show');


Route::middleware('auth')->group(function () {
    Route::get('/discussion/create', [DiscussionController::class, 'create'])->name('discussion.create');
    Route::post('/discussion/store', [DiscussionController::class, 'store'])->name('discussion.store');

    Route::get('/comment/create/{id}', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/comment/store/{id}', [CommentController::class, 'store'])->name('comment.store');

    Route::middleware('checkRole')->group(function () {
        Route::get('/discussion/pending', [DiscussionController::class, 'pending'])->name('discussion.pending');
        Route::post('/discussion/approve/{id}', [DiscussionController::class, 'approve'])->name('discussion.approve');
    });

    Route::middleware('checkModifyPermission')->group(function () {
        Route::get('/discussion/edit/{id}', [DiscussionController::class, 'edit'])->name('discussion.edit');
        Route::post('/discussion/update/{id}', [DiscussionController::class, 'update'])->name('discussion.update');
        Route::delete('/discussion/delete{id}', [DiscussionController::class, 'delete'])->name('discussion.delete');
    });

    Route::middleware('checkCommentPermission')->group(function () {
        Route::get('/comment/edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
        Route::post('/comment/update/{id}', [CommentController::class, 'update'])->name('comment.update');
        Route::delete('/comment/delete{id}', [CommentController::class, 'delete'])->name('comment.delete');
    });

    Route::middleware('userDiscussionsPermission')->group(function () {
        Route::get('/discussions/user/{id}', [DiscussionController::class, 'userDiscussions'])->name('discussions.user');
    });
});