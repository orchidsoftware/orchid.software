@php $level = $level ?? 0 @endphp

<ul class="@if($level) {{ 'toc-links-'.$level }} @else {{ 'toc-links' }} @endif">
    @foreach ($items as $label => $item)
        @include('_nav.menu-item')
    @endforeach
</ul>
