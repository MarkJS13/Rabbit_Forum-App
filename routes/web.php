<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', 'Auth\AuthenticatedSessionController@destroy')
->middleware('auth')
->name('logout');

Route::get('question/myquestions', [QuestionsController::class, 'myquestions'])->name('question.myquestions');
Route::resource('question', QuestionsController::class);

Route::resource('comment', CommentsController::class);
Route::post('comment/{id}', [CommentsController::class, 'store'])->name('comment.store');
Route::delete('comment/{commentId}/{questionId}', [CommentsController::class, 'destroy'])->name('comment.destroy');

Route::resource('reply', ReplyController::class);
Route::post('reply/{commentId}/{questionId}', [ReplyController::class, 'store'])->name('reply.store');
Route::delete('reply/{replyId}', [ReplyController::class, 'destroy'])->name('reply.destroy');

Route::get('/question/{question}/like', [LikesController::class, 'likeQuestion'])->name('question.like');
Route::get('/question/{question}/dislike', [LikesController::class, 'dislikeQuestion'])->name('question.dislike');

Route::get('/comment/{comment}/like', [LikesController::class, 'likeComment'])->name('comment.like');
Route::get('/comment/{comment}/dislike', [LikesController::class, 'dislikeComment'])->name('comment.dislike');

Route::get('/replies/{replies}/like', [LikesController::class, 'likeReply'])->name('reply.like');
Route::get('/replies/{replies}/dislike', [LikesController::class, 'dislikeReply'])->name('reply.dislike');

Route::fallback(function () {
    return view('fallback');
});

require __DIR__.'/auth.php';
