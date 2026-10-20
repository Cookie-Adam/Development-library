@props(['name', 'label', 'options', 'selected' => null])
{{-- $options: [value => label] --}}
<div class="mb-4">
    <label for="{{ $name }}" class="mb-1 block text-sm font-medium">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" class="w-full rounded border border-slate-300 bg-white px-3 py-2 text-sm">
        <option value="">— Select —</option>
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" @selected((string) old($name, $selected) === (string) $value)>{{ $text }}</option>
        @endforeach
    </select>
    @error($name)<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
</div>
