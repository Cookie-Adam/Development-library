<x-layouts.app title="Clients">
    <x-search create-route="clients.create" create-label="Add client" />

    <div class="overflow-x-auto rounded-lg bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500">
                <tr><th class="p-3">Name</th><th class="p-3">Card</th><th class="p-3">Email</th><th class="p-3">Phone</th><th class="p-3"></th></tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($clients as $client)
                    <tr>
                        <td class="p-3 font-medium">{{ $client->name }}</td>
                        <td class="p-3">{{ $client->card_number }}</td>
                        <td class="p-3">{{ $client->email }}</td>
                        <td class="p-3">{{ $client->phone }}</td>
                        <td class="space-x-3 p-3 text-right">
                            <a href="{{ route('clients.show', $client) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('clients.edit', $client) }}" class="text-blue-600 hover:underline">Edit</a>
                            <x-delete-button :action="route('clients.destroy', $client)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-center text-slate-500">No clients found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $clients->links() }}</div>
</x-layouts.app>
