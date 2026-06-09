@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-info mb-3']) }}>
        {{ $status }}
    </div>
@endif