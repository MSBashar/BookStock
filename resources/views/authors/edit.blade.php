@extends('layouts.app')

@section('title')
    {{ __('Edit Author') }}
@endsection

@php
    // Retrieve the first role name assigned to the authenticated user
    $role = auth()->user()->getRoleNames()->first();
@endphp

@section('header')
    <div class="flex items-center space-x-4">
        <a href="{{ route('authors.index') }}" class="text-gray-500 hover:text-gray-700 lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
        </a>
        <h2 class="!ml-0 text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Author') }}
        </h2>
    </div>
@endsection

@section('sub_header')
    @if($role)
        <p class="text-gray-600 dark:text-gray-400">{{ __("You are editing the author as an") }}
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

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="bg-red-100 p-1 text-sm text-red-600 text-center">* {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('authors.update', $author) }}" class="space-y-6">
        @csrf
        @method('put')
        <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __("Author's Name") }} <span class="text-red-500">*</span></label>
        <input
            type="text"
            id="name"
            name="name"
            required
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
            value="{{ old('name', $author->name) }}" placeholder="{{ __("Enter author's name") }}"
        />
        @error('name')
            <p class="bg-red-100 rounded-md text-red-600 mt-1 p-1 text-sm">* {{ $errors->first('name') }}</p>
        @enderror
        </div>

        <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Email') }}</label>
        <input
            type="email"
            id="email"
            name="email"
            rows="4"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none"
            value="{{ old('email', $author->email) }}" placeholder="{{ __("Enter author's email") }}" />
        @error('email')
            <p class="bg-red-100 rounded-md text-red-600 mt-1 p-1 text-sm">* {{ $errors->first('email') }}</p>
        @enderror
        </div>

        <div>
        <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Bio') }}</label>
        <textarea
            id="bio"
            name="bio"
            rows="4"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none"
            placeholder="{{ __("Enter author's bio") }}"
        >{{ old('bio', $author->bio) }}</textarea>
        @error('bio')
            <p class="bg-red-100 rounded-md text-red-600 mt-1 p-1 text-sm">* {{ $errors->first('bio') }}</p>
        @enderror
        </div>

        <div>
        <label for="active" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Status') }}</label>
        <select id="active" name="active"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
            <option value="1" {{ old('active', $author->active) == 1?'selected':'' }}>{{ __('Active') }}</option>
            <option value="0" {{ old('active', $author->active) == 0?'selected':'' }}>{{ __('Inactive') }}</option>
        </select>
        </div>

        <div class="flex items-center justify-end space-x-4 pt-4">
        <a
            href="{{ route('authors.index') }}"
            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-600 hover:text-gray-800 hover:border-gray-400 transition-all duration-200"
        >
            {{ __('Cancel') }}
        </a>
        <button type="submit"
            class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md">
            {{ __('Update Author') }}
        </button>
        </div>
    </form>
@endsection
