<x-layouts.app :title="$client->name">
    <div class="mb-6 max-w-lg rounded-lg bg-white p-6 shadow-sm">
        <dl class="grid grid-cols-3 gap-2 text-sm">
            <dt class="text-slate-500">Card</dt><dd class="col-span-2">{{ $client->card_number }}</dd>
            <dt class="text-slate-500">Email</dt><dd class="col-span-2">{{ $client->email ?? '—' }}</dd>
            <dt class="text-slate-500">Phone</dt><dd class="col-span-2">{{ $client->phone ?? '—' }}</dd>
        </dl>
        <div class="mt-4 space-x-3 text-sm">
            <a href="{{ route('clients.edit', $client) }}" class="text-blue-600 hover:underline">Edit</a>
            <a href="{{ route('clients.index') }}" class="text-slate-500">Back</a>
        </div>
    </div>

    <h2 class="mb-2 font-semibold">Borrowings</h2>
    <div class="mb-6 overflow-x-auto rounded-lg bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500"><tr><th class="p-3">Book</th><th class="p-3">Borrowed</th><th class="p-3">Due</th><th class="p-3">Returned</th></tr></thead>
            <tbody class="divide-y">
                @forelse ($client->borrowings as $b)
                    <tr class="{{ $b->isOverdue() ? 'bg-red-50 text-red-700' : '' }}">
                        <td class="p-3">{{ $b->book->title }}</td>
                        <td class="p-3">{{ $b->borrowed_at->format('Y-m-d') }}</td>
                        <td class="p-3">{{ $b->due_at->format('Y-m-d') }}</td>
                        <td class="p-3">{{ $b->returned_at?->format('Y-m-d') ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-4 text-center text-slate-500">None.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <h2 class="mb-2 font-semibold">Computer sessions</h2>
    <div class="overflow-x-auto rounded-lg bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500"><tr><th class="p-3">Computer</th><th class="p-3">Started</th><th class="p-3">Ended</th></tr></thead>
            <tbody class="divide-y">
                @forelse ($client->computerSessions as $s)
                    <tr>
                        <td class="p-3">{{ $s->computer->name }}</td>
                        <td class="p-3">{{ $s->started_at->format('Y-m-d H:i') }}</td>
                        <td class="p-3">{{ $s->ended_at?->format('Y-m-d H:i') ?? 'In progress' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="p-4 text-center text-slate-500">None.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
