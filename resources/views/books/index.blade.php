<x-layouts.app title="Books">
    <x-search create-route="books.create" create-label="Add book" />

    <div class="overflow-x-auto rounded-lg bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500">
                <tr><th class="p-3">Title</th><th class="p-3">Author</th><th class="p-3">Category</th><th class="p-3">Available</th><th class="p-3"></th></tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($books as $book)
                    <tr>
                        <td class="p-3 font-medium">{{ $book->title }}</td>
                        <td class="p-3">{{ $book->author }}</td>
                        <td class="p-3">{{ $book->category }}</td>
                        <td class="p-3 {{ $book->available_copies === 0 ? 'text-red-600' : '' }}">{{ $book->available_copies }} / {{ $book->copies }}</td>
                        <td class="space-x-3 p-3 text-right">
                            <a href="{{ route('books.show', $book) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('books.edit', $book) }}" class="text-blue-600 hover:underline">Edit</a>
                            <x-delete-button :action="route('books.destroy', $book)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-center text-slate-500">No books found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $books->links() }}</div>
</x-layouts.app>
