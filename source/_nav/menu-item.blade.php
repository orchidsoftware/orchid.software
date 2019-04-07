@if (!$url = is_string($item) ? $item : $item->url)
        {{-- Menu item without URL--}}
        <h4 class="text-orchid font-thin">{{ $label }}</h4>
@endif

<li>
    @if ($url = is_string($item) ? $item : $item->url)
        {{-- Menu item with URL--}}
        <a href="{{ $page->url($url) }}"
            class="{{ 'lvl' . $level }} {{ $page->isActiveParent($item) ? 'lvl' . $level . '-active' : '' }} {{ $page->isActive($url) ? 'active font-semibold text-blue' : '' }} nav-menu__item hover:text-blue"
        >
            {{ $label }}
        </a>
    @endif

    @if (! is_string($item) && $item->children)
        {{-- Recursively handle children --}}
        @include('_nav.menu', ['items' => $item->children, 'level' => ++$level])
    @endif
</li>
