@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="Temitope Olotin" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <img src="/images/my-logo.png" alt="Temitope Olotin" class="size-5" style="filter: invert(1);">
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="Temitope Olotin" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <img src="/images/my-logo.png" alt="Temitope Olotin" class="size-5" style="filter: invert(1);">
        </x-slot>
    </flux:brand>
@endif
