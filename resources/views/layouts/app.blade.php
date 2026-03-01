<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
        </style>



    </head>
    <body class="bg-gray-50 min-h-screen">
        <!-- Dashboard Container -->
        <div class="flex flex-col lg:flex-row min-h-screen">
            <!-- Sidebar -->
            <aside class="lg:w-64 bg-white shadow-lg z-10 lg:h-screen lg:sticky lg:top-0">
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
                        Interactive Cares
                      </h1>
                      <p class="text-xs text-gray-500">Dashboard</p>
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
                      <span class="font-medium">My Profile</span>
                    </a>

                    <!-- Book Management Section -->
                    <div class="pt-4 pb-2">
                      <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Book Management</p>
                    </div>

                    <a
                      href="./category-list.html"
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
                      <span class="font-medium">Categories</span>
                    </a>
                    <a
                      href="./author-list.html"
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
                      <span class="font-medium">Authors</span>
                    </a>
                    <a
                      href="./book-list.html"
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
                      <span class="font-medium">Books</span>
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

            <!-- Main Content -->
            <main class="flex-1 p-6 lg:p-8">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
                  <div>
                    @isset($header)
                        {{ $header }}
                    @endisset
                    @isset($sub_header)
                        {{ $sub_header }}
                    @endisset
                  </div>
                  <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    this.closest('form').submit();" class="flex items-center space-x-2 px-4 py-2 bg-white border border-gray-200 rounded-lg text-gray-600 hover:text-indigo-600 hover:border-indigo-600 transition-all duration-200">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                      </svg>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                  </div>
                </div>

                <!-- Body -->
                <div class="max-w-4xl">
                  <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div
                      class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2"
                    ></div>
                    <div class="p-6">
                        {{ $slot }}
                    </div>
                  </div>
                </div>
            </main>
        </div>

    </body>
</html>
