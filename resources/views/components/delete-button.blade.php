@props(['action'])
<form method="POST" action="{{ $action }}" class="inline" onsubmit="return confirm('Delete this record?')">
    @csrf
    @method('DELETE')
    <button class="text-red-600 hover:underline">Delete</button>
</form>
