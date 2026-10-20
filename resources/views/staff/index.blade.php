<x-layouts.app title="Staff">
    <x-search create-route="staff.create" create-label="Add staff" />

    <div class="overflow-x-auto rounded-lg bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-500">
                <tr><th class="p-3">Name</th><th class="p-3">Email</th><th class="p-3">Phone</th><th class="p-3">Role</th><th class="p-3"></th></tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($staff as $member)
                    <tr>
                        <td class="p-3 font-medium">{{ $member->name }}</td>
                        <td class="p-3">{{ $member->email }}</td>
                        <td class="p-3">{{ $member->phone }}</td>
                        <td class="p-3">{{ $member->role }}</td>
                        <td class="space-x-3 p-3 text-right">
                            <a href="{{ route('staff.show', $member) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('staff.edit', $member) }}" class="text-blue-600 hover:underline">Edit</a>
                            <x-delete-button :action="route('staff.destroy', $member)" />
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-6 text-center text-slate-500">No staff found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $staff->links() }}</div>
</x-layouts.app>
