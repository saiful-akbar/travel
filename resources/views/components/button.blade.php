@props([
    'type' => 'button',
    'color' => 'primary',
    'size' => 'md',
    'rounded' => false,
    'gradient' => false,
    'icon' => false,
    'startIcon' => null,
    'endIcon' => null,
])


@if ($type == 'link')
    <a {{ $attributes->class(['btn', "btn-$color", "btn-$size", 'rounded-pill' => $rounded, 'bg-gradient' => $gradient, 'btn-icon' => $icon]) }}>
        @isset($startIcon)<i class="{{ $startIcon }} {{ $icon ? '' : 'me-1' }}"></i>@endisset
        <span>{{ $slot }}</span>
        @isset($endIcon)<i class="{{ $endIcon }} ms-1"></i>@endisset
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class(['btn', "btn-$color", "btn-$size", 'rounded-pill' => $rounded, 'bg-gradient' => $gradient, 'btn-icon' => $icon]) }}>
        @isset($startIcon)<i class="{{ $startIcon }} {{ $icon ? '' : 'me-1' }}"></i>@endisset
        <span>{{ $slot }}</span>
        @isset($endIcon)<i class="{{ $endIcon }} ms-1"></i>@endisset
    </button>
@endif

