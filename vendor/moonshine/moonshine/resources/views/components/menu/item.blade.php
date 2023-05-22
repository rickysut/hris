@props([
    'item'
])
<li class="menu-inner-item {{ $item->isActive() ? '_is-active' : '' }}">
    <a href="{{ $item->url() }}" class="menu-inner-link" x-data="navTooltip" @mouseenter="toggleTooltip()">
        {!! $item->getIcon(6) !!}

        <span class="menu-inner-text">{{ $item->label() }}</span>

        @if($item->hasBadge())
            <span class="menu-inner-counter">{{ $item->getBadge() }}</span>
        @endif
    </a>
</li>
