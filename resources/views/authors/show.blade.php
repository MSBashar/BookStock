@extends('layouts.app')

@section('title')
    {{ __("Author: {$author->name}") }}
@endsection

@section('header')
    <div class="flex items-center space-x-4">
        <a href="{{ route('authors.index') }}" class="text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h2 class="!ml-0 text-[1.4rem] font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Author: {$author->name}") }}
        </h2>
    </div>
@endsection

@section('content')

    <div class="space-y-6">
        <div>
            <p class="block text-sm font-medium text-gray-700 mb-2">
                {{ __("Author's Name") }}: 
                <strong>{{ __($author->name) }}</strong>
            </p>
        </div>
        <div>
            <p class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Email') }}: 
                <strong>{{ __($author->email) }}</strong>
            </p>
        </div>
        <div>
            <p class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Bio') }}: 
                <strong>{{ __($author->bio) }}</strong>
            </p>
        </div>
        <div>
            <p class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Status') }}: 
                <strong>{{ __($author->active == 1 ? 'Active' : 'Inactive') }}</strong>
            </p>
        </div>
    </div>

@endsection
