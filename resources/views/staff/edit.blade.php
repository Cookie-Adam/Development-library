<x-layouts.app title="Edit staff member">
    <form method="POST" action="{{ route('staff.update', $staff) }}" class="max-w-lg rounded-lg bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('staff._form', ['member' => $staff])
        <button class="rounded bg-blue-600 px-4 py-2 text-sm text-white">Update</button>
        <a href="{{ route('staff.show', $staff) }}" class="ml-3 text-sm text-slate-500">Cancel</a>
    </form>
</x-layouts.app>
