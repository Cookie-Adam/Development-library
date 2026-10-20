<x-layouts.app title="Computers">
    <x-search create-route="computers.create" create-label="Add computer" />

    <div class="overflow-x-auto rounded-lg bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500"><tr><th class="p-3">Name</th><th class="p-3">Status</th><th class="p-3"></th></tr></thead>
            <tbody class="divide-y">
                @forelse ($computers as $computer)
                    <tr>
                        <td class="p-3 font-medium">{{ $computer->name }}</td>
                        <td class="p-3"><x-status-badge :status="$computer->status" /></td>
                        <td class="space-x-3 p-3 text-right">
                            <a href="{{ route('computers.show', $computer) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('computers.edit', $computer) }}" class="text-blue-600 hover:underline">Edit</a>
                            <x-delete-button :action="route('computers.destroy', $computer)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="p-6 text-center text-slate-500">No computers found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $computers->links() }}</div>
</x-layouts.app>
