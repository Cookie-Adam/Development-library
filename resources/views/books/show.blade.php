<x-layouts.app :title="$book->title">
    <div class="mb-6 max-w-lg rounded-lg bg-white p-6 shadow-sm">
        <dl class="grid grid-cols-3 gap-2 text-sm">
            <dt class="text-slate-500">Author</dt><dd class="col-span-2">{{ $book->author }}</dd>
            <dt class="text-slate-500">ISBN</dt><dd class="col-span-2">{{ $book->isbn ?? '—' }}</dd>
            <dt class="text-slate-500">Category</dt><dd class="col-span-2">{{ $book->category ?? '—' }}</dd>
            <dt class="text-slate-500">Copies</dt><dd class="col-span-2">{{ $book->available_copies }} available of {{ $book->copies }}</dd>
        </dl>
        <div class="mt-4 space-x-3 text-sm">
            <a href="{{ route('books.edit', $book) }}" class="text-blue-600 hover:underline">Edit</a>
            <a href="{{ route('books.index') }}" class="text-slate-500">Back</a>
        </div>
    </div>

    <h2 class="mb-2 font-semibold">Borrowing history</h2>
    <div class="overflow-x-auto rounded-lg bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500"><tr><th class="p-3">Client</th><th class="p-3">Borrowed</th><th class="p-3">Due</th><th class="p-3">Returned</th></tr></thead>
            <tbody class="divide-y">
                @forelse ($book->borrowings as $b)
                    <tr class="{{ $b->isOverdue() ? 'bg-red-50 text-red-700' : '' }}">
                        <td class="p-3">{{ $b->client->name }}</td>
                        <td class="p-3">{{ $b->borrowed_at->format('Y-m-d') }}</td>
                        <td class="p-3">{{ $b->due_at->format('Y-m-d') }}</td>
                        <td class="p-3">{{ $b->returned_at?->format('Y-m-d') ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-4 text-center text-slate-500">Never borrowed.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
