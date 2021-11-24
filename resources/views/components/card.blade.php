@props(['className'])

@php
    $class = $className ?? '';
    $class = "bg-white shadow-sm rounded-lg p-6" . " $class";
@endphp
<div class="{{ $class }}">
    {{ $slot }}
</div>
