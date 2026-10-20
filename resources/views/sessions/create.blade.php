<x-layouts.app title="Start a session">
    <form method="POST" action="{{ route('sessions.store') }}" class="max-w-lg rounded-lg bg-white p-6 shadow-sm">
        @csrf
        <x-select name="client_id" label="Client"
                  :options="$clients->mapWithKeys(fn ($c) => [$c->id => "{$c->name} ({$c->card_number})"])" />
        <x-select name="computer_id" label="Computer (available only)" :options="$computers->pluck('name', 'id')" />
        <x-select name="staff_id" label="Staff" :options="$staff->pluck('name', 'id')" />

        <button class="rounded bg-blue-600 px-4 py-2 text-sm text-white">Start</button>
        <a href="{{ route('sessions.index') }}" class="ml-3 text-sm text-slate-500">Cancel</a>
    </form>
</x-layouts.app>
