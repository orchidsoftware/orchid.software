@foreach($menu as $value)
    <li>
            <a href="{{$value->slug}}"
               rel="{{$value->robot}}"
               class="{{$value->style}}"
               title="{{$value->title}}"
               target="{{$value->target}}">
                {{$value->label}}
            </a>
        </li>
@endforeach
