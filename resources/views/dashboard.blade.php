<x-layouts.app title="Dashboard">
    @php
        $cards = [
            ['Total books', $totalBooks, 'text-slate-800'],
            ['Borrowed now', $borrowedNow, 'text-blue-600'],
            ['Overdue', $overdue, $overdue ? 'text-red-600' : 'text-slate-800'],
            ['Computers in use', $computersInUse, 'text-amber-600'],
            ['Clients', $clients, 'text-slate-800'],
        ];
    @endphp
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
        @foreach ($cards as [$label, $value, $color])
            <div class="rounded-lg bg-white p-5 shadow-sm">
                <div class="text-sm text-slate-500">{{ $label }}</div>
                <div class="mt-1 text-3xl font-semibold {{ $color }}">{{ $value }}</div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 flex gap-3">
        <a href="{{ route('borrowings.create') }}" class="rounded bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">Check out a book</a>
        <a href="{{ route('sessions.create') }}" class="rounded bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">Start a session</a>
    </div>
</x-layouts.app>
