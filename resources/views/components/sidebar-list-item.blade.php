@props(['class' => '', 'route' => '', 'routeIs' => '', 'title' => '', 'icon' => ''])

<li class="nav-item {{ $class }}"><a href="{{ route($route) }}" class="nav-link {{ request()->routeIs($routeIs) ? 'active' : '' }}">
    <i class="bi {{ $icon }} me-2"></i> <span class="nav-item-text">{{$title}}</span></a>
</li>
