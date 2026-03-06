<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | {{ __(config('app.name', 'Laravel')) }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
          tailwind.config = {
            theme: {
              extend: {
                colors: {
                  indigo: {
                    50: "#eef2ff",
                    100: "#e0e7ff",
                    500: "#6366f1",
                    600: "#4f46e5",
                    700: "#4338ca",
                  },
                  purple: {
                    50: "#faf5ff",
                    500: "#a855f7",
                    600: "#9333ea",
                    700: "#7e22ce",
                  },
                },
                animation: {
                  fadeIn: "fadeIn 0.5s ease-in forwards",
                  slideIn: "slideIn 0.3s ease-out forwards",
                },
                keyframes: {
                  fadeIn: {
                    from: { opacity: 0, transform: "translateY(10px)" },
                    to: { opacity: 1, transform: "translateY(0)" },
                  },
                  slideIn: {
                    from: { opacity: 0, transform: "translateX(-10px)" },
                    to: { opacity: 1, transform: "translateX(0)" },
                  },
                },
              },
            },
          };
        </script>
        <style>
          @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");
          body {
            font-family: "Inter", sans-serif;
          }
          .glass {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
          }
          .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
          }
          @media (min-width: 768px) {
            .dashboard-grid {
              grid-template-columns: 1fr 1fr;
            }
          }
          @media (min-width: 1024px) {
            .dashboard-grid {
              grid-template-columns: 1fr 1fr 1fr;
            }
          }
          .progress-bar {
            height: 0.5rem;
            border-radius: 9999px;
            background-color: #e5e7eb;
            overflow: hidden;
          }
          .progress-fill {
            height: 100%;
            border-radius: 9999px;
            background: linear-gradient(to right, #4f46e5, #7e22ce);
            transition: width 0.5s ease;
          }
          .sidebar-link {
            transition: all 0.2s ease;
          }
          .sidebar-link:hover,
          .sidebar-link.active {
            background-color: #f3f4f6;
            border-left: 4px solid #4f46e5;
          }
          .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
          }
          .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
          }

          .upload-zone {
            border: 2px dashed #d1d5db;
            transition: all 0.2s ease;
          }
          .upload-zone:hover,
          .upload-zone.dragover {
            border-color: #4f46e5;
            background-color: #eef2ff;
          }
          .div_show {
            display: block;
          }
          .div_hide {
            display: none;
          }
          .div_position_absolute {
            position: unset;
          }
          .div_position_unset {
            position: unset;
          }

          @media (max-width: 400px) {
            /* Styles for small devices (large phones, ~400px and up) */
          }

          @media (max-width: 576px) {
            /* Styles for small devices (large phones, ~576px and up) */
            .div_position_absolute {
              position: absolute;
            }
          }

          @media (max-width: 768px) {
            /* Styles for medium devices (tablets, ~768px and up) */
            .div_position_unset {
              position: absolute;
            }
          }

          @media (max-width: 992px) {
            /* Styles for large devices (laptops, ~992px and up) */
          }

          @media (max-width: 1200px) {
            /* Styles for extra large devices (desktops, ~1200px and up) */
          }

        </style>

    </head>
    <body class="bg-gray-50 min-h-screen">
        <!-- Dashboard Container -->
        <div class="flex flex-row lg:flex-row min-h-screen">
            <!-- Sidebar -->
            <div id="sidebar" class="z-40 w-full md:w-auto lg:w-auto bg-[#ffffff00] md:flex hidden flex flex-row  transition-all duration-200">
                <aside class="w-[17rem] min-h-screen bg-white shadow-lg lg:h-screen lg:sticky lg:top-0 flex-shrink-0">
                    <div class="p-6 border-b">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 w-10 h-10 rounded-xl flex items-center justify-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-5 h-5 text-white"
                        >
                            <path
                            fill-rule="evenodd"
                            d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                            clip-rule="evenodd"
                            />
                        </svg>
                        </div>
                        <div>
                        <h1
                            class="font-bold text-lg bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent"
                        >
                            {{ __('Interactive Cares') }}
                        </h1>
                        <p class="text-xs text-gray-500">{{ __('Dashboard') }}</p>
                        </div>
                    </div>
                    </div>

                    <div class="p-4">
                    <nav class="space-y-1">
                        <a
                        href="{{ route('dashboard') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg sidebar-link
                        @if (request()->routeIs('dashboard'))
                            active
                        @endif
                        "
                        >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 text-indigo-600"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                            />
                        </svg>
                        <span class="font-medium">{{ __('My Profile') }}</span>
                        </a>

                        <!-- Book Management Section -->
                        <div class="pt-4 pb-2">
                        <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Book Management</p>
                        </div>

                        <a
                        href="{{ route('categories.index') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg sidebar-link"
                        >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 text-gray-500"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z"
                            />
                        </svg>
                        <span class="font-medium">{{ __('Categories') }}</span>
                        </a>
                        <a
                        href="{{ route('authors.index') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg sidebar-link"
                        >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 text-gray-500"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                            />
                        </svg>
                        <span class="font-medium">{{ __('Authors') }}</span>
                        </a>
                        <a
                        href="{{ route('books.index') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg sidebar-link"
                        >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 text-gray-500"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"
                            />
                        </svg>
                        <span class="font-medium">{{ __('Books')}}</span>
                        </a>

                        <a
                        href="{{ route('profile.edit') }}"
                        class="flex items-center space-x-3 p-3 rounded-lg sidebar-link"
                        >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 text-gray-500"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                            />
                        </svg>
                        <span class="font-medium">{{ __('Edit Profile') }}</span>
                        </a>
                        <!-- <a
                        href="./change-password.html"
                        class="flex items-center space-x-3 p-3 rounded-lg sidebar-link"
                        >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 text-gray-500"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"
                            />
                        </svg>
                        <span class="font-medium">Change Password</span>
                        </a> -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="flex items-center space-x-3 p-3 rounded-lg sidebar-link">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-5 h-5 text-gray-500"
                                        >
                                            <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"
                                            />
                                        </svg>
                                <span class="font-medium">{{ __('Log Out') }}</span>
                            </a>
                        </form>
                    </nav>
                    </div>
                </aside>
                <div id="close-sidebar" class="w-full min-h-screen bg-[#00000047]"></div>
            </div>
            <!-- Main Content -->
            <main class="w-[80%] flex-1 p-6 lg:p-8 !pr-[1.5rem] overflow-hidden">
                <!-- Header -->
                <div class="max-w-full md:max-w-[97%] lg:max-w-[100%] flex flex-col md:self-start md:gap-y-3 md:flex-row lg:flex-row justify-between mb-8">
                  <div>
                    <div class="flex items-center justify-between">
                        @yield('header')
                        <button id="menu-btn" class="menu-btn md:hidden focus:outline-none flex items-center space-x-1 px-2 py-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md">
                            <!-- Burger menu icon (e.g., Heroicons) -->
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-4 6h4"></path></svg>
                        </button>
                    </div>
                    @yield('sub_header')
                  </div>
                  <div class="flex self-start md:justify-between md:w-[96%] lg:w-auto md:space-x-2 space-x-4 mt-4 md:mt-0 md:ml-[0.7rem]">
                      <div class="md:text-[11px] lg:text-[0.9rem]">
                        @yield('button')
                      </div>
                      <!-- User Dropdown -->
                      <div class="relative md:!ml-0">
                        <button id="userMenuButton" class="flex items-center space-x-3 p-2 pt-0 rounded-lg hover:bg-gray-50 transition-colors" onclick="toggleDropdown()">
                          <div class="w-9 h-9 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-medium text-sm">
                            @php
                                preg_match_all('/\b\w/u', Auth::user()->name, $matches);
                                $acronym = implode('', $matches[0]);
                                $acronym = substr(mb_strtoupper($acronym), 0, 2);
                            @endphp
                            {{ __($acronym) }}
                          </div>
                          <div class="hidden md:block text-left">
                            <p class="text-sm font-medium text-gray-700">{{ __(Auth::user()->name) }}</p>
                            <p class="text-xs text-gray-500">{{ __(Auth::user()->email) }}</p>
                          </div>
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                          </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdown" class="dropdown-menu absolute right-[-69px] md:right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border py-2">
                          <div class="px-4 py-3 border-b">
                            <p class="text-sm font-medium text-gray-900">{{ __(Auth::user()->name) }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ __(Auth::user()->email) }}</p>
                          </div>
                          <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span>{{ __('My Profile') }}</span>
                          </a>
                          <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            <span>{{ __('Edit Profile') }}</span>
                          </a>
                          <div class="border-t my-2"></div>
                           <form method="POST" action="{{ route('logout') }}" class="flex items-center space-x-3 px-4 text-sm text-red-600 hover:bg-red-50 transition-colors">
                              @csrf
                              <a href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                  this.closest('form').submit();" class="flex items-center py-2" style="margin-left: 0px !important;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
                                  <span class="ps-3">{{ __('Log Out') }}</span>
                              </a>
                          </form>
                        </div>
                      </div>
                  </div>
                </div>

                <!-- Body -->
                <div class="max-w-full">
                  <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div
                      class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"
                    ></div>
                    <div class="p-6">
                        @yield('content')
                    </div>
                  </div>
                </div>
            </main>
        </div>

      <script>
        // Sidebar toggle functionality
        const menuBtn = document.getElementById('menu-btn');
        const closeSidebar = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');

            if (!sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('div_position_unset');
                sidebar.classList.add('div_position_absolute');
            } else {
                sidebar.classList.remove('div_position_absolute');
                sidebar.classList.add('div_position_unset');
            }
        });
        closeSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
            sidebar.classList.remove('div_position_absolute');
            sidebar.classList.add('div_position_unset');
        });

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
      </script>
    </body>
</html>
