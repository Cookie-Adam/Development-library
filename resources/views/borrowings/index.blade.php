<x-layouts.app title="Borrowings">
    <div class="mb-4 text-right">
        <a href="{{ route('borrowings.create') }}" class="rounded bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">Check out a book</a>
    </div>

    <div class="overflow-x-auto rounded-lg bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500">
                <tr><th class="p-3">Book</th><th class="p-3">Client</th><th class="p-3">Staff</th><th class="p-3">Borrowed</th><th class="p-3">Due</th><th class="p-3">Returned</th><th class="p-3"></th></tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($borrowings as $b)
                    <tr class="{{ $b->isOverdue() ? 'bg-red-50 font-medium text-red-700' : '' }}">
                        <td class="p-3">{{ $b->book->title }}</td>
                        <td class="p-3">{{ $b->client->name }}</td>
                        <td class="p-3">{{ $b->staff->name }}</td>
                        <td class="p-3">{{ $b->borrowed_at->format('Y-m-d') }}</td>
                        <td class="p-3">{{ $b->due_at->format('Y-m-d') }}@if ($b->isOverdue()) (overdue)@endif</td>
                        <td class="p-3">{{ $b->returned_at?->format('Y-m-d') ?? '—' }}</td>
                        <td class="p-3 text-right">
                            @unless ($b->returned_at)
                                <form method="POST" action="{{ route('borrowings.return', $b) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="rounded bg-slate-800 px-3 py-1 text-xs text-white">Return</button>
                                </form>
                            @endunless
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="p-6 text-center text-slate-500">No borrowings yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $borrowings->links() }}</div>
</x-layouts.app>
