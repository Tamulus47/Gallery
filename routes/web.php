<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;

Route::resource('/albums', AlbumController::class);
Route::post('albums/{album}/upload', [AlbumController::class, 'upload'])->name('albums.upload');
Route::post('/albums/album', [AlbumController::class, 'album'])->name('albums.album');
Route::post('/albums/destroy', [AlbumController::class, 'destroy'])->name('albums.destroy');
Route::get('/albums/move/{id}', [AlbumController::class, 'move'])->name('albums.move');
Route::post('albums/transfer/{id}', [AlbumController::class, 'transfer'])->name('albums.transfer');