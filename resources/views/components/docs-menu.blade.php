<nav class="nav-docs px-md-5 py-2 px-3">
    @foreach($menu as $title => $values)
        <h4 class="font-weight-normal my-md-3 my-2 me-2 me-md-0" style="color: #22184D8C">{{ $title }}</h4>

        <ul>
            @foreach($values as $title => $link)
                <li class="border-start border-3 px-2 px-md-3 py-1 {{ active('*'.$link, 'border-primary active-doc-menu') }}">
                    <a href="{{$link}}" class="text-decoration-none {{ active('*'.$link, 'text-primary') }}">
                        {{ $title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endforeach
</nav>
