<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\Rule;
// use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Define the active books count subquery
        $activeBooksCountSubquery = DB::table('books')
            ->select(DB::raw('count(*)'))
            ->whereColumn('books.category_id', 'categories.id')
            ->where('books.active', 1); // Assuming 'active' column indicates an active book

        // Fetch categories with the active books count
        $categories = DB::table('categories')
            ->select([
                'categories.id',
                'categories.name',
                'categories.description',
                'categories.active',
                DB::raw("({$activeBooksCountSubquery->toSql()}) as active_books_count")
            ])
            ->mergeBindings($activeBooksCountSubquery) // Bind parameters for the subquery
            ->get();

        // The $categories variable now holds all categories with an 'active_books_count' property
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::table('categories')->insert([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'active' => $validated['active'],
            'user_id' => Auth::id(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('categories.create')->with('success', "Category ({$validated['name']}) created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $validated = $request->validated();

        DB::table('categories')->where('id', $category->id) // Identify which record to update
        ->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'active' => $validated['active'],
            'updated_by' => Auth::id(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('categories.index')->with('success', "Category ({$validated['name']}) updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        DB::table('categories')->where('id', $category->id)->delete();

        return redirect()->route('categories.index')->with('success', "Category ({$category->name}) deleted successfully");
    }
}
