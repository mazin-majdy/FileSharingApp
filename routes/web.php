<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/upload', [FileController::class, 'showUploadForm'])->name('upload.form');
    Route::post('/upload', [FileController::class, 'upload'])->name('upload');

    // File Management Routes
    Route::get('/files', [FileController::class, 'index'])->name('files');
    Route::delete('/files/{file}', [FileController::class, 'delete'])->name('files.delete');

    // Download Routes
});

require __DIR__ . '/auth.php';
Route::get('/download/{token}', [FileController::class, 'download'])->name('download');

Route::get('/files/{file}/download', [FileController::class, 'generateDownloadLink'])->name('files.download');
