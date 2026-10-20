<x-layouts.app title="Edit client">
    <form method="POST" action="{{ route('clients.update', $client) }}" class="max-w-lg rounded-lg bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('clients._form')
        <button class="rounded bg-blue-600 px-4 py-2 text-sm text-white">Update</button>
        <a href="{{ route('clients.show', $client) }}" class="ml-3 text-sm text-slate-500">Cancel</a>
    </form>
</x-layouts.app>
