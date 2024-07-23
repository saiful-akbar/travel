
<aside class="{{ implode(' ', $classes) }}">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-content">
            <x-layouts.dashboard-sidebar.mini-content :perusahaan="$perusahaan" />

            <div class="navbar-nav nav-vertical navbar-vertical-without-icons pt-2">
                <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                    @foreach ($menus as $menu)
                        <span class="dropdown-header {{ $loop->iteration > 1 ? 'mt-4' : '' }}">{{ $menu['name'] }}</span>
                        <small class="bi-three-dots nav-subtitle-replacer"></small>
    
                        <div id="{{ str_replace(' ', '', $menu['name']) }}">
                            @foreach ($menu['sub_menu'] as $subMenu)
                                <div class="nav-item">
                                    <a class="nav-link {{ Request::is("{$subMenu['path']}*") ? 'active' : '' }}" href="{{ url($subMenu['path']) }}" data-placement="left">
                                        <i class="nav-icon {{ $subMenu['icon'] ?? 'bi-dot' }}"></i>
                                        <span class="nav-link-title">{{ $subMenu['name'] }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</aside>
