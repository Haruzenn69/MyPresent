@props(['active' => false])

@php
$classes = ['nav-link', 'px-3'];
if ($active) {
    $classes[] = 'active';
    $classes[] = 'fw-bold';
}
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
