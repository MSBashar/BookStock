<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = DB::table('books')
            ->leftJoin('categories', 'books.category_id', '=', 'categories.id')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->leftJoin('users', 'books.user_id', '=', 'users.id') // The user who added the book
            ->select([
                'books.id',
                'books.title',
                'books.isbn',
                'categories.name as category_name',
                'authors.name as author_name',
                'books.cover_image',
                'books.description',
                'books.status',
                'books.active',
                'books.published_at',
                'users.name as user_name', // Name of the user who added the book
            ])
            // Add a condition to only fetch active books
            // ->where('books.active', 1)

            // Order the results for better presentation, e.g., by title
            ->orderBy('books.title', 'asc')
            ->get();

        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentTime = Carbon::now(env('APP_TIMEZONE', 'UTC'));

        $categories = DB::table('categories')
            ->select([
                'categories.id',
                'categories.name'
            ])
            ->where('categories.active', 1)
            ->orderBy('categories.name', 'asc')
            ->get();

        $authors = DB::table('authors')
            ->select([
                'authors.id',
                'authors.name'
            ])
            ->where('authors.active', 1)
            ->orderBy('authors.name', 'asc')
            ->get();

        // Start with EAN prefix 978
        $prefix = '978';
        // Generate 9 random digits
        $body = rand(100000000, 999999999);
        $rawIsbn = $prefix . $body;
        // Calculate Check Digit
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += ($i % 2 === 0) ? $rawIsbn[$i] : $rawIsbn[$i] * 3;
        }
        $checkDigit = (10 - ($sum % 10)) % 10;
        $isbn13number = $rawIsbn . $checkDigit;
        $isbn13 = substr($isbn13number, 0, 3) . '-' . substr($isbn13number, 3, 1) . '-' . substr($isbn13number, 4, 4) . '-' . substr($isbn13number, 8, 4) . '-' . substr($isbn13number, 12, 1);

        return view('books.create', compact('categories', 'authors', 'currentTime', 'isbn13'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['updated_by'] = Auth::id();
        $validated['updated_at'] = now();
        $validated['user_id'] = Auth::id();
        $validated['created_at'] = now();

        $localTime = Carbon::createFromFormat('Y-m-d', $validated['published_at'], env('APP_TIMEZONE', 'UTC'));
        $validated['published_at'] = $localTime->setTimezone('UTC');

        $cover_imageFileName = $validated['isbn'] . '_cover_image' . '.' . $validated['cover_image']->getClientOriginalExtension();
        $cover_imageFilePath = $validated['cover_image']
            ->storeAs('cover_image', $cover_imageFileName, 'public');

        $destinationPath = public_path('/uploads');
        $validated['cover_image']->move($destinationPath, $cover_imageFileName);

        // Speed optimization: I use database transactions for data consistency.
        // This is a best practice for complex database operations.
        try {
            DB::beginTransaction();

            $newBookId = DB::table('books')->insertGetId([
                'title' => $validated['title'],
                'isbn' => $validated['isbn'],
                'category_id' => $validated['category_id'] ?? null,
                'author_id' => $validated['author_id'] ?? null,
                'cover_image' => $cover_imageFilePath ?? null,
                'description' => $validated['description'] ?? null,
                'status' => $validated['status'],
                'active' => $validated['active'] ?? 1,
                'published_at' => $validated['published_at'] ?? null,
                'user_id' => $validated['user_id'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
                'updated_by' => $validated['updated_by'] ?? null,
            ]);

            DB::commit();

            return redirect()->route('books.create')->with('success', "Book ({$validated['title']}) added successfully!");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Book creation failed: ' . $e->getMessage()); // Log the error
            return back()->withInput()->withErrors(['error' => 'Failed to create the book. Please try again.']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $category = DB::table('categories')
            ->select([
                'categories.id',
                'categories.name'
            ])
            ->where('categories.id', $book->category_id)
            ->get();

        $author = DB::table('authors')
            ->select([
                'authors.id',
                'authors.name'
            ])
            ->where('authors.id', $book->author_id)
            ->get();

            $localTime = Carbon::createFromFormat('Y-m-d', $book->published_at, env('APP_TIMEZONE', 'UTC'));

        return view('books.show', compact('book', 'category', 'author', 'localTime'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = DB::table('categories')
            ->select([
                'categories.id',
                'categories.name'
            ])
            ->where('categories.active', 1)
            ->orderBy('categories.name', 'asc')
            ->get();

        $authors = DB::table('authors')
            ->select([
                'authors.id',
                'authors.name'
            ])
            ->where('authors.active', 1)
            ->orderBy('authors.name', 'asc')
            ->get();

            $localTime = Carbon::createFromFormat('Y-m-d', $book->published_at, env('APP_TIMEZONE', 'UTC'));

        return view('books.edit', compact('book', 'categories', 'authors', 'localTime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $validated = $request->validated();

        $validated['updated_by'] = Auth::id();
        $validated['updated_at'] = now();

        $localTime = Carbon::createFromFormat('Y-m-d', $validated['published_at'], env('APP_TIMEZONE', 'UTC'));
        $validated['published_at'] = $localTime->setTimezone('UTC');

        $cover_imageFileName = $validated['isbn'] . '_cover_image' . '.' . $validated['cover_image']->getClientOriginalExtension();
        $cover_imageFilePath = $validated['cover_image']
            ->storeAs('cover_image', $cover_imageFileName, 'public');

        $destinationPath = public_path('/uploads');
        $validated['cover_image']->move($destinationPath, $cover_imageFileName);

        $validated['cover_image'] = $cover_imageFilePath ?? null;

        // Best practice: I use a database transaction for multiple related database operations
        try {
            DB::transaction(function () use ($validated, $book) {
                DB::table('books')
                  ->where('id', $book->id)
                  ->update($validated);
            });

            return redirect()->route('books.index')->with('success', 'Book updated successfully!');

        } catch (\Exception $e) {
            // Handle the exception (log it, return an error, etc.)
            Log::error($e->getMessage());
            return back()->withInput()->withErrors(['error' => 'An error occurred while updating the book.']);
        }

        return redirect()->route('books.index')->with('success', "Book ({$validated['title']}) updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        DB::table('books')->where('id', $book->id)->delete();

        return redirect()->route('books.index')->with('success', "Book ({$book->title}) deleted successfully");
    }
}
