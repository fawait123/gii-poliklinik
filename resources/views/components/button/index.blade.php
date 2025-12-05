@props([
    'variant' => null,
    'size' => null,
    'type' => 'button',
    'disabled' => false,
])

@inject('button', 'App\Services\ButtonCvaService')

<button type="{{ $type }}"
    {{ $attributes->twMerge($button(['variant' => $variant, 'size' => $size]), $type == 'button' ? '' : 'cursor-pointer') }}
    :disabled="{{ $disabled ? 'true' : 'false' }}">
    <x-lucide-refresh-cw class="mr-2 size-4 animate-spin" x-show="{{ $disabled ? 'true' : 'false' }}" />
    {{ $slot }}
</button>
