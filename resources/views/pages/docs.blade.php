@extends('layouts.app')

@section('title',$title)
@section('description',$description)


@section('content')

    <div class="bg-white-only">
        <div class="container" id="docs">
            <div class="row m-t-md m-b-md">
                <div class="col-md-3 b-r b-light">
                    <nav class="nav-docs">
                        {!! $menu !!}
                    </nav>
                </div>
                <div class="col-md-9 col-xs-12 wrapper-lg">
                    <main>
                        <h1>{{$title}}</h1>
                        <hr>
                        <ul class="padder-v">
                            @foreach($anchors as $anchor)

                                <li class="anchor-{{$anchor['level']}}">
                                    <a href="#{{$anchor['id']}}">{{$anchor['text']}}</a>
                                </li>
                            @endforeach

                        </ul>


                        {!! $content !!}


                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection
