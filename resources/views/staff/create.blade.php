<x-layouts.app title="New staff member">
    <form method="POST" action="{{ route('staff.store') }}" class="max-w-lg rounded-lg bg-white p-6 shadow-sm">
        @csrf
        @include('staff._form', ['member' => null])
        <button class="rounded bg-blue-600 px-4 py-2 text-sm text-white">Save</button>
        <a href="{{ route('staff.index') }}" class="ml-3 text-sm text-slate-500">Cancel</a>
    </form>
</x-layouts.app>
