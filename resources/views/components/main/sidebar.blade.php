@props(['menu'])

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="nav nav-minimal" id="toc-nav">
            @foreach (main_menu() as $menu)
                <li class="nav-item">
                    <a class="nav-link fs-4" href="{{ url($menu['path']) }}">
                        {{ $menu['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- <div class="offcanvas-footer border-top pt-5">
        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="#" class="text-muted text-primary-hover">
                    <i class="bi bi-facebook fs-lg"></i>
                </a>
            </li>

            <li class="list-inline-item ms-1">
                <a href="#" class="text-muted text-primary-hover">
                    <i class="bi bi-twitter fs-lg"></i>
                </a>
            </li>

            <li class="list-inline-item ms-1">
                <a href="#" class="text-muted text-primary-hover">
                    <i class="bi bi-linkedin fs-lg"></i>
                </a>
            </li>
        </ul>
    </div> --}}
</div>
