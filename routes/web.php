<?php

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
    return redirect()->route("login");
    // return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/word-viewer/{uuid}', [App\Http\Controllers\FileReaderController::class, 'word'])->name('word_viewer');

// Documents
Route::get('/documents', [App\Http\Controllers\DocumentController::class, 'index'])->name('documents');
Route::get('/documents/create', [App\Http\Controllers\DocumentController::class, 'create'])->name('document_create');
Route::post('/documents/store', [App\Http\Controllers\DocumentController::class, 'store'])->name('document_store');
Route::post('/documents/{document}/delete', [App\Http\Controllers\DocumentController::class, 'destroy'])->name('document_delete');

// Sharings
Route::get('/sharings', [App\Http\Controllers\SharingController::class, 'index'])->name('sharings');
Route::get('/sharings/create', [App\Http\Controllers\SharingController::class, 'create'])->name('share_create');
Route::post('/sharings/create/review', [App\Http\Controllers\SharingController::class, 'review'])->name('share_review');
Route::post('/sharings/store', [App\Http\Controllers\SharingController::class, 'store'])->name('share_store');
Route::get('/sharings/{sharing}/info', [App\Http\Controllers\SharingController::class, 'show'])->name('view_share');
Route::post('/sharings/{sharing}/delete', [App\Http\Controllers\SharingController::class, 'destroy'])->name('delete_share');

// shared
Route::get('/shared/{uuid}', [App\Http\Controllers\FileReaderController::class, 'shared'])->name('shared');
