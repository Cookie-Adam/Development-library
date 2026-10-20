<x-layouts.app title="Check out a book">
    <form method="POST" action="{{ route('borrowings.store') }}" class="max-w-lg rounded-lg bg-white p-6 shadow-sm">
        @csrf
        <x-select name="client_id" label="Client"
                  :options="$clients->mapWithKeys(fn ($c) => [$c->id => "{$c->name} ({$c->card_number})"])" />
        <x-select name="book_id" label="Book (available only)"
                  :options="$books->mapWithKeys(fn ($b) => [$b->id => "{$b->title} — {$b->available_copies} left"])" />
        <x-select name="staff_id" label="Staff" :options="$staff->pluck('name', 'id')" />
        <x-field name="due_at" label="Due date" type="date" :value="now()->addDays(14)->toDateString()" :min="today()->toDateString()" required />

        <button class="rounded bg-blue-600 px-4 py-2 text-sm text-white">Check out</button>
        <a href="{{ route('borrowings.index') }}" class="ml-3 text-sm text-slate-500">Cancel</a>
    </form>
</x-layouts.app>
