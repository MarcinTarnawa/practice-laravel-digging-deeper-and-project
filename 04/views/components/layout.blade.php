<!DOCTYPE html>
<html lang="pl" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Moja Aplikacja' }}</title>
    @vite('resources/css/app.css')
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>
<body class="h-full font-sans antialiased text-gray-900">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-8">
                    <a href="/" class="text-xl font-bold text-indigo-600">ExpenseApp</a>
                    <div class="hidden md:flex space-x-4">
                        <a href="/expenses" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Wydatki</a>
                    </div>
                    <div class="hidden md:flex space-x-4">
                        <a href="/form" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Test Form</a>
                    </div>
                    <div class="hidden md:flex space-x-4">
                        <a href="/statistics" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Statystyki</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="/login" class="text-sm font-medium text-gray-600">Zaloguj</a>
                        <a href="/register" class="px-4 py-2 text-sm font-medium rounded-md text-white bg-indigo-600">Rejestracja</a>
                    @endguest
                    @auth
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">Cześć, <strong>{{ auth()->user()->name }}</strong>!</span>
                            <form method="POST" action="/logout" class="inline">
                                @csrf
                                <button class="text-sm font-medium text-red-600">Wyloguj</button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

</body>
</html>