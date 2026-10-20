<nav class="docs-menu" aria-label="Documentation">
    @foreach($menu as $title => $values)
        <div class="group">
            <p class="title">{{ $title }}</p>

            <ul class="list">
                @foreach($values as $title => $link)
                    <li class="item">
                        <a href="{{$link}}" class="link" @if(active('*'.$link, 'is-active')) aria-current="page" @endif>
                            {!! $title !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</nav>

<a href="#" title="Scroll to the top of the page" class="back-to-top">Back to top ↑</a>
