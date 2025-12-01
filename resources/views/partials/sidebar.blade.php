<div class="sidebar">
    <h4>Panel</h4>

    @php
        $menuItems = [];

        if(Auth::user()->role == 'admin') {
            $menuItems = [
                ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'bi bi-speedometer2', 'children' => []],
                ['label' => 'Users', 'route' => 'admin.users.index', 'icon' => 'bi bi-people', 'children' => [
                    ['label' => 'All Users', 'route' => 'admin.users.index'],
                    ['label' => 'Add User', 'route' => 'admin.users.create'],
                ]],
            ];
        } elseif(Auth::user()->role == 'student') {
            $menuItems = [
                ['label' => 'Dashboard', 'route' => 'student.dashboard', 'icon' => 'bi bi-speedometer2', 'children' => []],
            ];
        } elseif(Auth::user()->role == 'instructor') {
            $menuItems = [
                ['label' => 'Dashboard', 'route' => 'instructor.dashboard', 'icon' => 'bi bi-speedometer2', 'children' => []],
            ];
        }
    @endphp

    <ul class="nav flex-column">
        @foreach($menuItems as $item)
            @php
                $isActive = request()->routeIs($item['route']) || (!empty($item['children']) && collect($item['children'])->pluck('route')->contains(request()->route()->getName()));
            @endphp

            @if(!empty($item['children']))
                <li class="nav-item">
                    <a class="nav-link d-flex justify-content-between {{ $isActive ? '' : 'collapsed' }}"
                       data-bs-toggle="collapse"
                       href="#menu-{{ \Illuminate\Support\Str::slug($item['label']) }}"
                       role="button"
                       aria-expanded="{{ $isActive ? 'true' : 'false' }}">
                        <span><i class="{{ $item['icon'] }}"></i> {{ $item['label'] }}</span>
                        <i class="bi bi-chevron-down small"></i>
                    </a>

                    <div class="collapse {{ $isActive ? 'show' : '' }}" id="menu-{{ \Illuminate\Support\Str::slug($item['label']) }}">
                        <ul class="nav flex-column ms-3">
                            @foreach($item['children'] as $child)
                                <li>
                                    <a href="{{ route($child['route']) }}" class="nav-link {{ request()->routeIs($child['route']) ? 'active fw-bold' : '' }}">
                                        {{ $child['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ route($item['route']) }}" class="nav-link {{ $isActive ? 'active fw-bold' : '' }}">
                        <i class="{{ $item['icon'] }}"></i> {{ $item['label'] }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
