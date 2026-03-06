@extends('layouts.app')

@section('title')
    {{ __('My Dashboard') }}
@endsection

@php
    // Retrieve the first role name assigned to the authenticated user
    $role = auth()->user()->getRoleNames()->first();
@endphp

@section('header')
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('My Dashboard') }}
    </h2>
@endsection

@section('sub_header')
    <p class="text-gray-600 dark:text-gray-400 ">{{ __('Welcome back') }}, {{ __(Auth::user()->name) }}</p>

    @if($role)
        <p class="text-gray-600 dark:text-gray-400 text-xs">{{ __("You're logged in as") }}
        <span class="text-[#9333ea]">{{ ucfirst($role) }}</span>!</p>
    @else
        <p class="text-red-600 text-xs">{{ __("You're logged in but no role has been assigned.") }}</p>
    @endif
@endsection

@section('content')
    <div class="flex flex-col md:flex-row md:items-center">
        <div class="flex-shrink-0">
          <div
            class="w-24 h-24 rounded-full bg-gradient-to-r from-indigo-100 to-purple-100 flex items-center justify-center text-3xl font-bold text-indigo-600"
          >
            @php
                preg_match_all('/\b\w/u', Auth::user()->name, $matches);
                $acronym = implode('', $matches[0]);
                $acronym = substr(mb_strtoupper($acronym), 0, 2);
            @endphp
            {{ __($acronym) }}
          </div>
        </div>
        <div class="mt-4 md:mt-0 md:ml-6 flex-1">
          <h3 class="text-xl font-bold text-gray-800">{{ Auth::user()->name }}</h3>
        </div>
    </div>

    <div class="mt-8">
        <div class="p-4 border rounded-lg">
          <p class="text-gray-500 text-sm">{{ __('Email') }}</p>
          <p class="font-medium">{{ Auth::user()->email }}</p>
        </div>
    </div>
@endsection
