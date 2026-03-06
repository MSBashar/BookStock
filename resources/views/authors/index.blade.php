@extends('layouts.app')

@section('title')
    {{ __('Authors') }}
@endsection

@php
    // Retrieve the first role name assigned to the authenticated user
    $role = auth()->user()->getRoleNames()->first();
@endphp

@section('header')
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Authors') }}
    </h2>
@endsection

@section('sub_header')
     @if($role)
        <p class="text-gray-600 dark:text-gray-400">{{ __("Manage book authors as an") }}
        <span class="text-[#9333ea]">{{ ucfirst($role) }}</span>!</p>
    @else
        <p class="text-red-600">{{ __("You're logged in but no role has been assigned.") }}</p>
    @endif
@endsection

@hasanyrole(['admin', 'editor'])
@section('button')
    <a href="{{ route('authors.create') }}"
        class="flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md"
        >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        <span class="hidden sm:inline">{{ __('Add Author') }}</span>
    </a>
@endsection
@endhasanyrole


@section('content')
    <div class="overflow-x-auto">
        @if(session()->has('success'))
            <div>
                <ul class="mb-4">
                    <li class="bg-green-100 p-1 text-sm text-green-600 mb-1 text-center">* {{ session()->get('success') }}</li>
                </ul>
            </div>
        @endif

        @if ($errors->any())
            <div>
                <ul class="mb-4">
                    @foreach ($errors->all() as $error)
                        <li class="bg-red-100 p-1 text-sm text-red-600 text-center mb-1">* {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="w-full">
          <thead class="bg-gray-50 border-b">
            <tr>
              <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('Sl.') }}</th>
              <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
              <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('Email') }}</th>
              <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('Books Count') }}</th>
              <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
              <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @isset($authors)
            @php
                $sl = 1;
            @endphp
                @foreach ($authors as $author)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-right">#{{ __($sl) }}</td>
                        @php
                            $sl++;
                        @endphp
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ __($author->name) }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ __($author->email) }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 text-center">{{ __($author->active_books_count) }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-center">
                            @if($author->active === 1)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">{{ __('Active') }}</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ __('Inactive') }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex items-center justify-center space-x-2 gap-1">
                                <a href="{{ route('authors.show', $author->id) }}" class="text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                                    <svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#454545" stroke="#454545">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M917.251764 802.39026L786.571232 671.643176c-2.964148-2.993841-10.321788 0.260067-18.916281 6.447406l-10.6781-10.6781c54.596637-70.942966 51.407234-171.245844-8.531013-239.190875v-36.821988l0.130034 0.456653c0-70.649111-67.455613-136.867871-103.689891-172.419217l-8.270946-8.204393C529.76441 104.382037 485.22847 95.460924 448.830371 95.460924l-12.371606-0.063481H150.778377c-16.995473 0-47.336266 12.89174-47.336267 38.675221v756.025661c0 21.3562 17.31902 38.741773 38.675221 38.741773h567.587758c21.3562 0 38.741773-17.385573 38.741773-38.741773V753.360488c37.278641 37.308333 108.900443 108.934231 108.900443 108.934231 12.958293 12.89174 72.926232-46.882685 59.904459-59.904459z" fill="#27323A"></path>
                                            <path d="M707.231382 652.173997c-54.856704 54.890492-144.259299 54.957045-199.149791 0-54.887421-54.953973-54.887421-144.352473 0-199.242965 26.566753-26.566753 61.924584-41.151999 99.559537-41.151999 37.698434 0 73.022477 14.585246 99.58923 41.151999 54.891516 54.953973 54.891516 144.288992 0.001024 199.242965z" fill="#FFFFFF"></path>
                                            <path d="M603.214872 244.570368l8.657974 8.527941c15.171933 14.848385 36.464652 35.944518 54.53418 59.447806-35.521654-13.28184-75.11018-15.8221-110.333882-17.252468-1.10682-23.442878-5.600653-71.299278-21.486234-112.841378 18.683859 14.651799 41.14688 34.57456 68.627962 62.118099z" fill="#6ddcf8"></path>
                                            <path d="M150.648343 881.633865V142.800262c0.130033-0.066553 0.650167-0.263139 0.650168-0.263138h285.03022l12.371607 0.066552c6.25082 0 14.518694 0.130033 26.436719 4.100661l5.990753 6.25082c32.36092 31.970819 44.015806 111.604524 44.015806 157.377318 0 8.400979 6.64092 15.368519 15.10538 15.692066l6.510887 0.263139c48.899739 1.887021 109.844465 4.230694 146.863039 37.764986l3.383941 3.383941c2.377462 7.487673 3.940935 14.911866 4.201002 22.269506-72.045691-41.412066-165.287856-32.100853-226.853057 29.497112-73.642952 73.642952-73.642952 193.058697 0 266.70165 61.597965 61.594893 154.84013 70.972659 226.886845 29.49404v166.23495H150.648343z" fill="#f2e1bb"></path>
                                        </g>
                                    </svg>
                                </a>
                                @hasanyrole(['admin', 'editor'])
                                    <a href="{{ route('authors.edit', $author->id) }}" class="text-indigo-600 hover:text-indigo-800 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>
                                    @hasanyrole(['admin'])
                                        <!-- Add delete functionality as needed -->
                                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="inline-block"  onsubmit="return confirm('{{ __('Are you sure you want to delete (:name)? This action cannot be undone.', ['name' => $author->name]) }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2。09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endhasanyrole
                                @endhasanyrole
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endisset

          </tbody>
        </table>
    </div>
@endsection
