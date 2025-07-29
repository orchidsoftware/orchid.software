<nav class="nav-docs px-lg-5 py-2 px-3">
    @foreach($menu as $title => $values)
        <p class="h5 font-weight-normal my-lg-3 my-2 me-2 me-lg-0 d-none d-md-inline-block" style="color: #22184D8C">{{ $title }}</p>

        <ul>
            @foreach($values as $title => $link)
                <li class="border-start border-3 px-2 px-lg-3 py-1 {{ active('*'.$link, 'border-primary active-doc-menu') }}">
                    <a href="{{$link}}" class="text-decoration-none {{ active('*'.$link, 'text-primary') }}">
                        {!! $title !!}
                    </a>
                </li>
            @endforeach
        </ul>
    @endforeach
</nav>

{{-- Button: Go to top --}}
<div class="d-none d-xl-block h-100 position-relative pt-5">
    <a href="#" title="Scroll to the top of the page" class="stretched-link"></a>
</div>
