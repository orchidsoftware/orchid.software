@if(count($anchors) > 1)
    <ul class="pl-5">
        @foreach($anchors as $anchor)
            <li class="anchor-{{$anchor['level']}}">
                <a href="#{{$anchor['id']}}">{{$anchor['text']}}</a>
            </li>
        @endforeach
    </ul>
    <hr>
@endif