@props(['title' => 'Library'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} · Library</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased">
@php
    $nav = [
        ['Dashboard', 'dashboard', 'dashboard'],
        ['Clients', 'clients.index', 'clients.*'],
        ['Books', 'books.index', 'books.*'],
        ['Borrowings', 'borrowings.index', 'borrowings.*'],
        ['Computers', 'computers.index', 'computers.*'],
        ['Sessions', 'sessions.index', 'sessions.*'],
        ['Staff', 'staff.index', 'staff.*'],
    ];
@endphp
<div class="min-h-screen md:flex">
    <aside class="bg-slate-900 text-slate-200 md:w-56 md:shrink-0">
        <div class="px-5 py-4 text-lg font-semibold text-white">📚 Library</div>
        <nav class="flex gap-1 overflow-x-auto px-2 pb-3 md:block md:space-y-1">
            @foreach ($nav as [$label, $route, $pattern])
                <a href="{{ route($route) }}"
                   class="block whitespace-nowrap rounded px-3 py-2 text-sm {{ request()->routeIs($pattern) ? 'bg-slate-700 text-white' : 'hover:bg-slate-800' }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>
    </aside>

    <main class="flex-1 p-6">
        <h1 class="mb-4 text-2xl font-semibold">{{ $title }}</h1>

        @if (session('status'))
            <div class="mb-4 rounded bg-green-100 px-4 py-2 text-sm text-green-800">{{ session('status') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-4 rounded bg-red-100 px-4 py-2 text-sm text-red-800">{{ session('error') }}</div>
        @endif

        {{ $slot }}
    </main>
</div>
</body>
</html>
