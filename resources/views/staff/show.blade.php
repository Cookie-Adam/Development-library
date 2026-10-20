<x-layouts.app :title="$staff->name">
    <div class="max-w-lg rounded-lg bg-white p-6 shadow-sm">
        <dl class="grid grid-cols-3 gap-2 text-sm">
            <dt class="text-slate-500">Email</dt><dd class="col-span-2">{{ $staff->email }}</dd>
            <dt class="text-slate-500">Phone</dt><dd class="col-span-2">{{ $staff->phone ?? '—' }}</dd>
            <dt class="text-slate-500">Role</dt><dd class="col-span-2">{{ $staff->role }}</dd>
            <dt class="text-slate-500">Checkouts handled</dt><dd class="col-span-2">{{ $staff->borrowings_count }}</dd>
            <dt class="text-slate-500">Sessions handled</dt><dd class="col-span-2">{{ $staff->computer_sessions_count }}</dd>
        </dl>
        <div class="mt-4 space-x-3 text-sm">
            <a href="{{ route('staff.edit', $staff) }}" class="text-blue-600 hover:underline">Edit</a>
            <a href="{{ route('staff.index') }}" class="text-slate-500">Back</a>
        </div>
    </div>
</x-layouts.app>
