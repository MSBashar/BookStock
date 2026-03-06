@extends('layouts.app')

@section('title')
    {{ __('Create Book') }}
@endsection

@php
    // Retrieve the first role name assigned to the authenticated user
    $role = auth()->user()->getRoleNames()->first();
@endphp

@section('header')
    <div class="flex items-center space-x-4">
        <a href="{{ route('categories.index') }}" class="text-gray-500 hover:text-gray-700 lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h2 class="!ml-0 text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Book') }}
        </h2>
    </div>
@endsection

@section('sub_header')
    @if($role)
        <p class="text-gray-600 dark:text-gray-400">{{ __("Add a new book to the collection as an") }}
        <span class="text-[#9333ea]">{{ ucfirst($role) }}</span>!</p>
    @else
        <p class="text-red-600">{{ __("You're logged in but no role has been assigned.") }}</p>
    @endif
@endsection

@section('content')

    @if(session()->has('success'))
        <div>
            <ul>
                <li class="bg-green-100 p-1 text-sm text-green-600 text-center">* {{ session()->get('success') }}</li>
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('books.store') }}" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        <!-- Book Cover Upload -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Book Cover') }}</label>
            <div class="flex items-start space-x-6">
            <!-- Preview Area -->
            <div class="flex-shrink-0">
                <div
                id="imagePreview"
                class="w-32 h-44 rounded-lg bg-gray-100 border-2 border-gray-200 flex items-center justify-center overflow-hidden"
                >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                </div>
            </div>

            <!-- Upload Area -->
            <div class="flex-1">
                <div
                id="uploadZone"
                class="upload-zone rounded-lg p-6 text-center cursor-pointer"
                onclick="document.getElementById('cover_image').click()"
                >
                <input
                    type="file"
                    id="cover_image"
                    name="cover_image"
                    accept="image/*"
                    class="hidden"
                    onchange="previewImage(event)"
                />
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400 mx-auto mb-3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>
                <p class="text-sm text-gray-600 mb-1">
                    <span class="font-medium text-indigo-600">{{ __('Click to upload') }}</span> {{ __('or drag and drop') }}
                </p>
                <p class="text-xs text-gray-500">{{ __('PNG, JPG, GIF up to 2MB') }}</p>
                </div>
                <p class="text-xs text-gray-500 mt-2">{{ __('Recommended: 300x400px ratio') }}</p>
                @error('cover_image')
                    <p class="bg-red-100 rounded-md text-red-600 mt-1 p-1 text-sm">* {{ $errors->first('cover_image') }}</p>
                @enderror
            </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Book Title') }} <span class="text-red-500">*</span></label>
            <input
                type="text"
                id="title"
                name="title"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                placeholder="{{ __('Enter book title') }}"
            />
            @error('title')
                <p class="bg-red-100 rounded-md text-red-600 mt-1 p-1 text-sm">* {{ $errors->first('title') }}</p>
            @enderror
            </div>

            <div>
            <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">{{ __('ISBN') }} <span class="text-red-500">*</span></label>
            <input
                type="text"
                id="isbn"
                name="isbn"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                placeholder="{{ __('978-0-7475-3269-9') }}"
                value="{{ $isbn13 }}"
            />
            @error('isbn')
                <p class="bg-red-100 rounded-md text-red-600 mt-1 p-1 text-sm">* {{ $errors->first('isbn') }}</p>
            @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="author_id" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Author') }} <span class="text-red-500">*</span></label>
                <select
                    id="author_id"
                    name="author_id"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    <option value="">{{ __('Select an author') }}</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
                @error('author_id')
                    <p class="bg-red-100 rounded-md text-red-600 mt-1 p-1 text-sm">* {{ $errors->first('author_id') }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Category') }} <span class="text-red-500">*</span></label>
                <select
                    id="category_id"
                    name="category_id"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                    <option value="">{{ __('Select a category') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="bg-red-100 rounded-md text-red-600 mt-1 p-1 text-sm">* {{ $errors->first('category_id') }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Description') }}</label>
            <textarea
            id="description"
            name="description"
            rows="4"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none"
            placeholder="{{ __('Enter book description') }}"
            ></textarea>
            @error('description')
                <p class="bg-red-100 rounded-md text-red-600 mt-1 p-1 text-sm">* {{ $errors->first('description') }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Published Date') }}</label>
                <input
                    type="date"
                    id="published_at"
                    name="published_at"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                    value="{{ $currentTime->format('Y-m-d') }}"
                />
                @error('published_at')
                    <p class="bg-red-100 rounded-md text-red-600 mt-1 p-1 text-sm">* {{ $errors->first('published_at') }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Status') }}</label>
                <select
                id="status"
                name="status"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                >
                <option value="Available">{{ __('Available') }}</option>
                <option value="Borrowed">{{ __('Borrowed') }}</option>
                <option value="Reserved">{{ __('Reserved') }}</option>
                </select>
                @error('status')
                    <p class="bg-red-100 rounded-md text-red-600 mt-1 p-1 text-sm">* {{ $errors->first('status') }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="active" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Active') }}</label>
            <select
            id="active"
            name="active"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                <option value="1">{{ __('Active') }}</option>
                <option value="0">{{ __('Inactive') }}</option>
            </select>
        </div>

        <div class="flex items-center justify-end space-x-4 pt-4">
            <a
            href="{{ route('books.index') }}"
            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-600 hover:text-gray-800 hover:border-gray-400 transition-all duration-200"
            >
            {{ __('Cancel') }}
            </a>
            <button
            type="submit"
            class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md"
            >
            {{ __('Create Book') }}
            </button>
        </div>
    </form>

    <script>
      // Dropdown functionality
      function toggleDropdown() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('show');
      }

      // Close dropdown when clicking outside
      document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('userDropdown');
        const button = document.getElementById('userMenuButton');
        if (!dropdown.contains(event.target) && !button.contains(event.target)) {
          dropdown.classList.remove('show');
        }
      });

      // Image preview functionality
      function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" class="w-full h-full object-cover" />';
          }
          reader.readAsDataURL(file);
        }
      }

      // Drag and drop functionality
      const uploadZone = document.getElementById('uploadZone');

      uploadZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadZone.classList.add('dragover');
      });

      uploadZone.addEventListener('dragleave', () => {
        uploadZone.classList.remove('dragover');
      });

      uploadZone.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadZone.classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
          document.getElementById('cover_image').files = e.dataTransfer.files;
          const event = { target: { files: [file] } };
          previewImage(event);
        }
      });
    </script>
@endsection
