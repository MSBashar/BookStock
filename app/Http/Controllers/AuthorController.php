<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Define the active books count subquery
        $activeBooksCountSubquery = DB::table('books')
            ->select(DB::raw('count(*)'))
            ->whereColumn('books.author_id', 'authors.id')
            ->where('books.active', 1); // Assuming 'active' column indicates an active book

        // Fetch authors with the active books count
        $authors = DB::table('authors')
            ->select([
                'authors.id',
                'authors.name',
                'authors.email',
                'authors.bio',
                'authors.active',
                DB::raw("({$activeBooksCountSubquery->toSql()}) as active_books_count")
            ])
            ->mergeBindings($activeBooksCountSubquery) // Bind parameters for the subquery
            ->get();

        // The $authors variable now holds all authors with an 'active_books_count' property
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::table('authors')->insert([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'bio' => $validated['bio'],
            'active' => $validated['active'],
            'user_id' => Auth::id(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('authors.create')->with('success', "Author ({$validated['name']}) created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, Author $author): RedirectResponse
    {
        $validated = $request->validated();

        $result = DB::table('authors')->where('id', $author->id) // Identify which record to update
        ->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'bio' => $validated['bio'],
            'active' => $validated['active'],
            'updated_by' => Auth::id(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('authors.index')->with('success', "Author ({$validated['name']}) updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        DB::table('authors')->where('id', $author->id)->delete();

        return redirect()->route('authors.index')->with('success', "Author ({$author->name}) deleted successfully");
    }
}
