<button {{ $attributes->merge(['class' => 'btn btn-secondary', 'type' => 'button']) }}>
    {{ $slot }}
</button>