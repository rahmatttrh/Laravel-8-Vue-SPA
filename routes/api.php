<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Notes\{NoteController, SubjectController};



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::post('create-post', 'Posts\PostController@store');
Route::post('/create-note', [NoteController::class, 'store']);
Route::get('/notes', [NoteController::class, 'index']);
Route::get('/notes/{note:slug}', [NoteController::class, 'show'])->name('note.show');
Route::patch('/notes/{note:slug}/edit', [NoteController::class, 'update']);
Route::delete('/notes/{note:slug}/delete', [NoteController::class, 'destroy']);


Route::get('/subjects', [SubjectController::class, 'index']);
