<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // Assign role to a user
        $user = User::where('email', 'admin@example.com')->first();
        $user->assignRole('admin');
        $user = User::where('email', 'editor@example.com')->first();
        $user->assignRole('editor');
        $user = User::where('email', 'guest@example.com')->first();
        $user->assignRole('viewer');

        // Create categories
        Category::create([
            'name' => 'Fiction',
            'user_id' => 2, // Assuming the editor user has ID 2
            'description' => 'Novels and stories',
            'active' => 1
        ]);
        Category::create([
            'name' => 'Non-Fiction',
            'user_id' => 2, // Assuming the editor user has ID 2
            'description' => 'Informative and factual books',
            'active' => 1
        ]);
        Category::create([
            'name' => 'Science Fiction',
            'user_id' => 2, // Assuming the editor user has ID 2
            'description' => 'Science fiction books',
            'active' => 1
        ]);
        Category::create([
            'name' => 'Mystery',
            'user_id' => 2, // Assuming the editor user has ID 2
            'description' => 'Mystery books',
            'active' => 1
        ]);
        Category::create([
            'name' => 'Science',
            'user_id' => 2, // Assuming the editor user has ID 2
            'description' => 'Scientific books and journals',
            'active' => 1
        ]);
        Category::create([
            'name' => 'History',
            'user_id' => 2, // Assuming the editor user has ID 2
            'description' => 'Historical books and documents',
            'active' => 1
        ]);

        // Create authors
        Author::create([
            'name' => 'J.K. Rowling',
            'email' => 'j.k.rowling@example.com',
            'bio' => 'J.K. Rowling is a renowned author of fantasy novels.',
            'user_id' => 2, // Assuming the editor user has ID 2
            'active' => 1
        ]);
        Author::create([
            'name' => 'Stephen King',
            'email' => 'stephen.king@example.com',
            'bio' => 'Stephen King is a renowned author of horror and suspense novels.',
            'user_id' => 2, // Assuming the editor user has ID 2
            'active' => 1
        ]);
        Author::create([
            'name' => 'George Orwell',
            'email' => 'george.orwell@example.com',
            'bio' => 'George Orwell is a renowned author of political fiction.',
            'user_id' => 2, // Assuming the editor user has ID 2
            'active' => 1
        ]);

        // Create Books
        Book::create([
            'title' => 'Harry Potter and the Philosopher\'s Stone',
            'author_id' => 1, // Assuming J.K. Rowling has ID 1
            'category_id' => 1, // Assuming Fiction has ID 1
            'description' => 'The first book in the Harry Potter series.',
            'isbn' => '978-0747532699',
            'published_at' => '1997-06-26',
            'cover_image' => 'cover_image/Harry_Potter_and_the_Philosophers_Stone.jpg',
            'status' => 'Available', // -- Available, Borrowed, Reserved.
            // 'pages' => 223,
            // 'price' => 10.99,
            'user_id' => 2, // Assuming the editor user has ID 2
            'active' => 1
        ]);
        Book::create([
            'title' => 'The Shining',
            'author_id' => 2, // Assuming Stephen King has ID 2
            'category_id' => 1, // Assuming Fiction has ID 1
            'description' => 'A horror novel about a haunted hotel.',
            'isbn' => '978-0385121675',
            'published_at' => '1977-01-28',
            'cover_image' => 'cover_image/The_Shining_1977.jpg',
            'status' => 'Available',
            // 'pages' => 223,
            // 'price' => 10.99,
            'user_id' => 2, // Assuming the editor user has ID 2
            'active' => 1
        ]);
        Book::create([
            'title' => '1984',
            'author_id' => 3, // Assuming George Orwell has ID 3
            'category_id' => 3, // Assuming Science has ID 3
            'description' => 'A dystopian social science fiction novel.',
            'isbn' => '978-0451524935',
            'published_at' => '1948-06-08',
            'cover_image' => 'cover_image/1984_1948.jpg',
            'status' => 'Borrowed',
            // 'pages' => 223,
            // 'price' => 10.99,
            'user_id' => 2, // Assuming the editor user has ID 2
            'active' => 1
        ]);


    }

}
