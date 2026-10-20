@if(count($anchors) > 1)
    <nav class="anchors" aria-label="On this page">
        <ul class="list">
            @foreach($anchors as $anchor)
                <li class="item" data-level="{{$anchor['level']}}">
                    <a href="#{{$anchor['id']}}">{{$anchor['text']}}</a>
                </li>
            @endforeach
        </ul>
    </nav>
@endif
