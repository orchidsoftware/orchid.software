@if (!$url = is_string($item) ? $item : $item->url)
        {{-- Menu item without URL--}}
        <h4 class="h5 text-black mb-3">{{ $label }}</h4>
@endif

<li class="{{ $page->isActive($url) ? 'active' : '' }}">
    @if ($url = is_string($item) ? $item : $item->url)
        {{-- Menu item with URL--}}
        <a href="{{ $page->url($url) }}"
            class="{{ 'lvl' . $level }} {{ $page->isActiveParent($item) ? 'lvl' . $level . '-active' : '' }}"
        >
            {{ $label }}
        </a>
    @endif

    @if (! is_string($item) && $item->children)
        {{-- Recursively handle children --}}
        @include('_nav.menu', ['items' => $item->children, 'level' => ++$level])
    @endif
</li>
