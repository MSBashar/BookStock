<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


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
});


// Routes for create and store which have different permissions
Route::middleware(['auth', 'permission:create'])->group(function () {
    Route::resource('categories', CategoryController::class)->only(['create', 'store']);
    Route::resource('authors', AuthorController::class)->only(['create', 'store']);
    Route::resource('books', BookController::class)->only(['create', 'store']);
});

// Routes for edit and update which have different permissions
Route::middleware(['auth', 'permission:edit'])->group(function () {
    Route::resource('categories', CategoryController::class)->only(['edit', 'update']);
    Route::resource('authors', AuthorController::class)->only(['edit', 'update']);
    Route::resource('books', BookController::class)->only(['edit', 'update']);
});

// Routes for destroy which have different permissions
Route::middleware(['auth', 'permission:delete'])->group(function () {
    Route::resource('categories', CategoryController::class)->only(['destroy']);
    Route::resource('authors', AuthorController::class)->only(['destroy']);
    Route::resource('books', BookController::class)->only(['destroy']);
});

// Routes for index and show which have different permissions
Route::middleware(['auth', 'permission:view'])->group(function () {
    Route::resource('categories', CategoryController::class)->only(['index', 'show']);
    Route::resource('authors', AuthorController::class)->only(['index', 'show']);
    Route::resource('books', BookController::class)->only(['index', 'show']);
});


require __DIR__.'/auth.php';


// Generated Routes
// The Route::resource('books', BookController::class); declaration generates the following routes:

// HTTP Verb 	URI Pattern	        Action	    Route Name

// GET          /books              index       books.index
// GET          /books/create	    create	    books.create
// POST         /books              store	    books.store
// GET          /books/{book}	    show	    books.show
// GET          /books/{book}/edit	edit	    books.edit
// PUT/PATCH	/books/{book}	    update	    books.update
// DELETE       /books/{book}	    destroy	    books.destroy
