<x-layouts.app title="Edit book">
    <form method="POST" action="{{ route('books.update', $book) }}" class="max-w-lg rounded-lg bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('books._form')
        <button class="rounded bg-blue-600 px-4 py-2 text-sm text-white">Update</button>
        <a href="{{ route('books.show', $book) }}" class="ml-3 text-sm text-slate-500">Cancel</a>
    </form>
</x-layouts.app>
