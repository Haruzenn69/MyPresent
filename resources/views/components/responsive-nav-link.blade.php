@props(['active' => false])

@php
$classes = 'list-group-item list-group-item-action';
if ($active) {
    $classes .= ' active';
}
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
