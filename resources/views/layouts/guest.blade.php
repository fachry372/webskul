<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SMK Negeri 1 Subang') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background-color: rgb(45, 112, 236)
                
            }
            .login-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 1rem;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                padding: 2rem;
                max-width: 400px;
                width: 100%;
                margin: 2rem auto;
            }
            .logo {
                display: flex;
                justify-content: center;
                margin-bottom: 1.5rem;
            }
            .logo img {
                width: 80px;
                height: 80px;
                object-fit: contain;
            }
            .form-title {
                font-family: 'Inter', sans-serif;
                font-size: 1.5rem;
                font-weight: 600;
                color: #1f2937;
                text-align: center;
                margin-bottom: 1.5rem;
            }
            .form-group {
                margin-bottom: 1.25rem;
            }
            .form-group label {
                display: block;
                font-family: 'Inter', sans-serif;
                font-size: 0.875rem;
                font-weight: 500;
                color: #374151;
                margin-bottom: 0.5rem;
            }
            .form-group input {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #d1d5db;
                border-radius: 0.5rem;
                font-family: 'Inter', sans-serif;
                font-size: 0.875rem;
                color: #1f2937;
                transition: border-color 0.3s ease;
            }
            .form-group input:focus {
                outline: none;
                border-color: #22c55e;
                box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
            }
            .btn-submit {
                width: 100%;
                padding: 0.75rem;
                background-color: #22c55e;
                color: white;
                font-family: 'Inter', sans-serif;
                font-size: 0.875rem;
                font-weight: 500;
                border-radius: 0.5rem;
                border: none;
                cursor: pointer;
                transition: background-color 0.3s ease, transform 0.2s ease;
            }
            .btn-submit:hover {
                background-color: #16a34a;
                transform: translateY(-2px);
            }
            .text-link {
                font-family: 'Inter', sans-serif;
                font-size: 0.875rem;
                color: #22c55e;
                text-decoration: none;
                transition: color 0.3s ease;
            }
            .text-link:hover {
                color: #16a34a;
                text-decoration: underline;
            }
        </style>
    </head>
    <body class="min-h-screen flex items-center justify-center">
        <div class="login-container">
            <div class="logo">
                <img src="{{ asset('logo.png') }}" alt="SMK Negeri 1 Subang Logo" />
            </div>
            <h2 class="form-title">Login to SMK Negeri 1 Subang</h2>
            {{ $slot }}
        </div>
    </body>
</html>
