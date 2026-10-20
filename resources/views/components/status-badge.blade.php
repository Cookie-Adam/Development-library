@props(['status'])
@php
    $classes = match ($status) {
        'available' => 'bg-green-100 text-green-800',
        'in_use' => 'bg-amber-100 text-amber-800',
        default => 'bg-slate-200 text-slate-700',
    };
@endphp
<span class="rounded px-2 py-0.5 text-xs font-medium {{ $classes }}">{{ str_replace('_', ' ', $status) }}</span>
