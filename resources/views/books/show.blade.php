@extends('layouts.app')

@section('title')
    {{ __("Book: {$book->title}") }}
@endsection

@section('header')
    <div class="flex items-center space-x-4">
        <a href="{{ route('books.index') }}" class="text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h2 class="!ml-0 text-[1.4rem] font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Book: {$book->title}") }}
        </h2>
    </div>
@endsection

@section('content')

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Book Cover') }}</label>
        <div class="flex flex-col lg:flex-row items-start space-x-6">
            <!-- Image Area -->
            <div class="flex-shrink-0 mb-6">
                <div
                id="imagePreview"
                class="w-[15rem] h-[21rem] rounded-lg bg-gray-100 border-2 border-gray-200 flex items-center justify-center overflow-hidden"
                style="background-image: url({{ asset('storage/'.$book->cover_image) }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-gray-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg> --}}
                </div>
            </div>

            <div class="flax-1 space-y-3">
                <div>
                    <p class="block text-base font-medium text-gray-700 mb-2">
                        <strong>{{ __('Book Title') }}:</strong><br>
                        {{ __($book->title) }}
                    </p>
                </div>
                <div>
                    <p class="block text-sm font-medium text-gray-700 mb-2">
                        <strong>{{ __('ISBN') }}:</strong><br>
                        {{ __($book->isbn) }}
                    </p>
                </div>
                <div>
                    <p class="block text-sm font-medium text-gray-700 mb-2">
                        <strong>{{ __('Author') }}:</strong><br>
                        {{ __($author[0]->name) }}
                    </p>
                </div>
                <div>
                    <p class="block text-sm font-medium text-gray-700 mb-2">
                        <strong>{{ __('Category') }}:</strong><br>
                        {{ __($category[0]->name) }}
                    </p>
                </div>
                <div>
                    <p class="block text-sm font-medium text-gray-700 mb-2">
                        <strong>{{ __('Published Date') }}:</strong><br>
                        {{ __($localTime->format('Y-m-d')) }}
                    </p>
                </div>
                <div>
                    <p class="block text-sm font-medium text-gray-700 mb-2">
                        <strong>{{ __('Status') }}:</strong><br>
                        {{ __($book->status .' and '. ($book->active == 1 ? 'Active' : 'Inactive')) }}
                    </p>
                </div>
            </div>

            <div class="flax-1 space-y-3">
                <div>
                    <p class="block text-sm font-medium text-gray-700 mb-2">
                        <strong>{{ __('Description') }}:</strong><br>
                        {{ __($book->description) }}
                    </p>
                </div>
            </div>






        </div>
    </div>

@endsection
