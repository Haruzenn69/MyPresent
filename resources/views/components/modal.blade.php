@props(['name', 'show' => false, 'maxWidth' => ''])

@php
$maxWidth = match ($maxWidth) {
    'sm' => 'mw-25',
    'md' => 'mw-50',
    'lg' => 'mw-75',
    'xl' => 'mw-100',
    default => 'mw-50',
};
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            let selector = 'a, button, input:not([type=hidden]), textarea, select, details, [tabindex]:not([tabindex=-1])'
            return [...document.querySelectorAll(selector)].filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % this.focusables().length },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement) - 1) },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable()?.focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })"
    x-on:open-modal.window="$event.detail === '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail === '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="position-fixed top-0 start-0 end-0 bottom-0 z-3 overflow-auto p-4"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        class="position-fixed top-0 start-0 end-0 bottom-0"
        x-on:click="show = false"
        x-transition:enter.duration.300ms.opacity
        x-transition:leave.duration.200ms
    >
        <div class="position-absolute top-0 start-0 end-0 bottom-0 bg-dark" style="opacity: 0.6;"></div>
    </div>

    <div
        x-show="show"
        class="card border-0 overflow-hidden w-100 {{ $maxWidth }} mx-auto"
        x-transition:enter.duration.300ms
        x-transition:leave.duration.200ms
    >
        {{ $slot }}
    </div>
</div>
