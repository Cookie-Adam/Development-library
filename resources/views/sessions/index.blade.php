<x-layouts.app title="Computer sessions">
    <div class="mb-4 text-right">
        <a href="{{ route('sessions.create') }}" class="rounded bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">Start session</a>
    </div>

    <div class="overflow-x-auto rounded-lg bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500">
                <tr><th class="p-3">Computer</th><th class="p-3">Client</th><th class="p-3">Staff</th><th class="p-3">Started</th><th class="p-3">Ended</th><th class="p-3"></th></tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($sessions as $s)
                    <tr>
                        <td class="p-3 font-medium">{{ $s->computer->name }}</td>
                        <td class="p-3">{{ $s->client->name }}</td>
                        <td class="p-3">{{ $s->staff->name }}</td>
                        <td class="p-3">{{ $s->started_at->format('Y-m-d H:i') }}</td>
                        <td class="p-3">{{ $s->ended_at?->format('Y-m-d H:i') ?? 'In progress' }}</td>
                        <td class="p-3 text-right">
                            @unless ($s->ended_at)
                                <form method="POST" action="{{ route('sessions.end', $s) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="rounded bg-slate-800 px-3 py-1 text-xs text-white">End session</button>
                                </form>
                            @endunless
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-6 text-center text-slate-500">No sessions yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $sessions->links() }}</div>
</x-layouts.app>
