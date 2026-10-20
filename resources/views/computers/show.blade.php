<x-layouts.app :title="$computer->name">
    <div class="mb-6 max-w-lg rounded-lg bg-white p-6 shadow-sm">
        <div class="text-sm">Status: <x-status-badge :status="$computer->status" /></div>
        <div class="mt-4 space-x-3 text-sm">
            <a href="{{ route('computers.edit', $computer) }}" class="text-blue-600 hover:underline">Edit</a>
            <a href="{{ route('computers.index') }}" class="text-slate-500">Back</a>
        </div>
    </div>

    <h2 class="mb-2 font-semibold">Session history</h2>
    <div class="overflow-x-auto rounded-lg bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500"><tr><th class="p-3">Client</th><th class="p-3">Started</th><th class="p-3">Ended</th></tr></thead>
            <tbody class="divide-y">
                @forelse ($computer->sessions->sortByDesc('started_at') as $s)
                    <tr>
                        <td class="p-3">{{ $s->client->name }}</td>
                        <td class="p-3">{{ $s->started_at->format('Y-m-d H:i') }}</td>
                        <td class="p-3">{{ $s->ended_at?->format('Y-m-d H:i') ?? 'In progress' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="p-4 text-center text-slate-500">No sessions yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
