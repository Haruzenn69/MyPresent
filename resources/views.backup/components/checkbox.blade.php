@props(['id' => null, 'name' => null, 'checked' => false])

<div class="form-check">
    <input class="form-check-input" type="checkbox" id="{{ $id }}" name="{{ $name ?? $id }}" @if($checked) checked @endif>
    <label class="form-check-label" for="{{ $id }}">{{ $slot }}</label>
</div>
