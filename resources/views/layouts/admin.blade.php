<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SMK Negeri 1 Subang - Admin') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Quill CSS -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @yield('styles')

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #ffffff;
            color: #1f2937;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            background-color: #f9fafb;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
            border-right: 1px solid #e5e7eb;
            transition: transform 0.3s ease;
        }
        .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }
        .sidebar-header img {
            width: 40px;
            height: 40px;
            margin-right: 0.5rem;
        }
        .sidebar-header span {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
        }
        .sidebar-nav {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #4b5563;
            text-decoration: none;
            border-radius: 0.375rem;
            margin-bottom: 0.25rem;
            transition: background-color 0.2s ease, color 0.2s ease;
            font-size: 0.875rem;
            font-weight: 500;
            height: 35px;
        }
        .sidebar-nav a:hover {
            background-color: #e5e7eb;
            color: #111827;
        }
        .sidebar-nav a.active {
            background-color: #22c55e;
            color: white;
        }
        .sidebar-nav svg {
            margin-right: 0.75rem;
            width: 20px;
            height: 20px;
        }
        .logout-container {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid #e5e7eb;
        }
        .logout-btn {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #4b5563;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background-color 0.2s ease, color 0.2s ease;
            height: 35px;
        }
        .logout-btn:hover {
            background-color: #dc2626;
            color: white;
            border-color: #dc2626;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
        }
        .header {
            background: white;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .header h1 {
            font-size: 1.875rem;
            font-weight: 600;
            color: #1f2937;
        }
        .header .welcome-text {
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
        }
        .content {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .toggle-btn {
            display: none;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
                width: 200px;
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .toggle-btn {
                display: block;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 50;
                background-color: #22c55e;
                color: white;
                padding: 0.5rem;
                border-radius: 0.375rem;
                border: none;
                cursor: pointer;
            }
        }
        .ql-container {
            z-index: 10 !important;
        }
        .ql-toolbar {
            background-color: #f8f9fa !important;
            z-index: 20 !important;
            position: relative;
        }
        .ql-snow .ql-picker-options {
            z-index: 30 !important;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .ql-editor {
            min-height: 300px;
        }
        .ql-editor img {
            max-width: 100%;
            height: auto;
        }
        .prose img {
            max-width: 100%;
            height: auto;
        }
        .prose ul,
        .prose ol {
            padding-left: 1.5em;
        }
        .prose h1,
        .prose h2,
        .prose h3 {
            margin: 0.5em 0;
        }
        .prose [style*="text-align"] {
            text-align: inherit;
        }
    </style>
</head>
<body class="min-h-screen bg-white">
    <button class="toggle-btn lg:hidden">☰</button>
    <div class="sidebar" style="width: 280px;">
        <div class="sidebar-header" style="padding-bottom:0rem;">
            <img src="{{ asset('images/logo.jpeg') }}" alt="SMK Negeri 1 Subang Logo" style="width:45px;height:45px;margin-right:0.5rem;">
            <span style="font-size:1.3rem;font-weight:600;">SMKN 1 Subang</span>
        </div>
        <nav class="sidebar-nav">
            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-5 py-3 rounded hover:bg-gray-300 transition w-full text-lg mb-2
                      {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

           {{-- Dropdown Profil --}}
<div class="relative mb-2" x-data="{ open: {{ request()->routeIs('profiles.*') || request()->routeIs('menus.*') ? 'true' : 'false' }} }">
    <a href="#" @click.prevent="open = !open"
       class="relative flex items-center pl-5 py-3 w-full rounded hover:bg-gray-300 transition text-lg
              {{ (request()->routeIs('profiles.*') || request()->routeIs('menus.*')) ? 'active' : '' }}">
        <span class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A7.5 7.5 0 0112 15.5a7.5 7.5 0 016.879 2.304M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Profil
        </span>
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5 absolute right-0 mr-2 transform transition-transform duration-200"
             :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </a>

    <div x-show="open" x-transition class="ml-6 mt-1.5 space-y-1.5">
        <a href="{{ route('profiles.index') }}"
           class="flex items-center px-4 py-2 rounded hover:bg-gray-200 transition text-lg
                  {{ request()->routeIs('profiles.*') ? 'active' : '' }}">
            Profil
        </a>
        <a href="{{ route('menus.index', 1) }}"
           class="flex items-center px-4 py-2 rounded hover:bg-gray-200 transition text-lg
                  {{ request()->routeIs('menus.*') ? 'active' : '' }}">
            Menu Profil
        </a>
    </div>
</div>

{{-- Dropdown Kompetensi Keahlian / Jurusan --}}
<div class="relative mb-2" x-data="{ open: {{ request()->routeIs('admin.jurusan.*') || request()->routeIs('admin.posts.*') ? 'true' : 'false' }} }">
    <a href="#" @click.prevent="open = !open"
       class="relative flex items-center pl-5 py-3 w-full rounded hover:bg-gray-300 transition text-lg
              {{ (request()->routeIs('admin.jurusan.*') || request()->routeIs('admin.posts.*')) ? 'active' : '' }}">
        <span class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 0 018 0z"/>
            </svg>
            Kompetensi Keahlian
        </span>
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5 absolute right-0 mr-2 transform transition-transform duration-200"
             :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </a>

    <div x-show="open" x-transition class="ml-6 mt-1.5 space-y-1.5">
        <a href="{{ route('admin.jurusan.index') }}"
           class="flex items-center px-4 py-2 rounded hover:bg-gray-200 transition text-lg
                  {{ request()->routeIs('admin.jurusan.*') ? 'active' : '' }}">
            Jurusan
        </a>
        <a href="{{ route('admin.posts.index') }}"
           class="flex items-center px-4 py-2 rounded hover:bg-gray-200 transition text-lg
                  {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
            Posts Jurusan
        </a>
    </div>
</div>
{{-- Dropdown IKM --}}
<div class="relative mb-2"
     x-data="{ open: {{ request()->routeIs('admin.ikm.*') || request()->routeIs('admin.ikm_konten.*') ? 'true' : 'false' }} }">

    <a href="#" @click.prevent="open = !open"
       class="relative flex items-center pl-5 py-3 w-full rounded hover:bg-gray-300 transition text-lg
              {{ (request()->routeIs('admin.ikm.*') || request()->routeIs('admin.ikm_konten.*')) ? 'active' : '' }}">
        <span class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 17v-6h6v6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h5l2 2h5a2 2 0 012 2v10a2 2 0 01-2 2z"/>
            </svg>
            IKM
        </span>
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5 absolute right-0 mr-2 transform transition-transform duration-200"
             :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </a>

    <div x-show="open" x-transition class="ml-6 mt-1.5 space-y-1.5">
        <a href="{{ route('admin.ikm.index') }}"
           class="flex items-center px-4 py-2 rounded hover:bg-gray-200 transition text-lg
                  {{ request()->routeIs('admin.ikm.*') ? 'active' : '' }}">
            Judul IKM
        </a>
        <a href="{{ route('admin.ikm_konten.index') }}"
           class="flex items-center px-4 py-2 rounded hover:bg-gray-200 transition text-lg
                  {{ request()->routeIs('admin.ikm_konten.*') ? 'active' : '' }}">
            Konten IKM
        </a>
    </div>

   {{-- Dropdown Galeri --}}
<div class="relative mb-2" x-data="{ open: {{ request()->routeIs('admin.galeri.*') ? 'true' : 'false' }} }">
    <a href="{{ route('admin.galeri.index') }}"
       class="relative flex items-center pl-5 py-3 w-full rounded hover:bg-gray-300 transition text-lg
              {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
       <span class="flex items-center">
           <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M3 4a1 1 0 011-1h4l2 2h6l2-2h4a1 1 0 011 1v14a1 1 0 01-1 1H4a1 1 0 01-1-1V4z" />
           </svg>
           Galeri
       </span>
    </a>
</div>


</div>



            {{-- Logout --}}
            <div class="logout-container mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn flex items-center px-5 py-3 rounded hover:bg-red-300 text-lg w-full transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h3a3 3 0 013 3v1" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </nav>

    </div>


    <div class="main-content">
        <header class="header">
            <h1 class="text-3xl">Admin Dashboard</h1>
            <div class="welcome-text">Selamat Datang, {{ Auth::user()->name }}</div>
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        console.log('Quill loaded:', typeof Quill !== 'undefined');
    </script>
    @livewireScripts
    @yield('scripts')

    <!-- Script untuk handle session success dan error dengan SweetAlert -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
</body>
</html>
