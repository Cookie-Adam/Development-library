@props(['createRoute', 'createLabel' => 'Add new'])
<div class="mb-4 flex flex-wrap items-center justify-between gap-3">
    <form method="GET" class="flex gap-2">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search…"
               class="w-64 rounded border border-slate-300 bg-white px-3 py-2 text-sm">
        <button class="rounded bg-slate-800 px-4 py-2 text-sm text-white">Search</button>
        @if (request('q'))
            <a href="{{ url()->current() }}" class="px-2 py-2 text-sm text-slate-500">Clear</a>
        @endif
    </form>
    <a href="{{ route($createRoute) }}" class="rounded bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">{{ $createLabel }}</a>
</div>
