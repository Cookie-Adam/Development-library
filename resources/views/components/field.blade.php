@props(['name', 'label', 'type' => 'text', 'value' => null])
<div class="mb-4">
    <label for="{{ $name }}" class="mb-1 block text-sm font-medium">{{ $label }}</label>
    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value) }}"
           {{ $attributes->merge(['class' => 'w-full rounded border border-slate-300 bg-white px-3 py-2 text-sm']) }}>
    @error($name)<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
</div>
