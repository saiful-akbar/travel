@props([
    'variant' => 'primary',
])

<div {{ $attributes->class(['alert', "alert-$variant", 'alert-dismissible', 'fade', 'show']) }} role="alert">
    <div class="d-flex">
        <div class="flex-shrink-0">
            @switch($variant)
                @case('success')
                    <i class="bi bi-check-circle-fill"></i>
                @break

                @case('info')
                    <i class="bi bi-info-circle-fill"></i>
                @break

                @case('warning')
                    <i class="bi bi-exclamation-triangle-fill"></i>
                @break

                @case('danger')
                    <i class="bi bi-x-octagon-fill"></i>
                @break

                @default
                    <i class="bi bi-info-circle-fill"></i>
            @endswitch
        </div>

        <div class="flex-grow-1 ms-2">
            {{ $slot }}
        </div>
    </div>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
