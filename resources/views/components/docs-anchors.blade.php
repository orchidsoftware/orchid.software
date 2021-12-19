<div class="anchors">
    @if(count($anchors) > 1)
        <ul>
            @foreach($anchors as $anchor)
                <li class="anchor-{{$anchor['level']}}">
                    <a href="#{{$anchor['id']}}">{{$anchor['text']}}</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
