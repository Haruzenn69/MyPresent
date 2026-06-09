@props(['align' => 'end'])
<div class="dropdown">
    {{ $trigger }}
    <div class="dropdown-menu dropdown-menu-{{ $align }}">
        {{ $content }}
    </div>
</div>
