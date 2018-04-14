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
                    <div class="">
                        <a href="#"><span class="label label-primary padder">2.8</span></a>
                        <a href="#"><span class="label bg-white b text-black  padder">2.7</span></a>
                        <a href="#"><span class="label bg-white b text-black  padder">2.6</span></a>
                    </div>
                    <div class="form-group form-group-default m-t">
                        <label>Поиск по документации</label>
                        <div class="controls">
                            <input type="text"
                                   id="docs-search"
                                   placeholder="Введите поисковый запрос ..."
                                   class="form-control"
                                   data-notfound="Ничего не найдено"
                            >
                        </div>
                    </div>
                    <div id="docs-search-result" class="wrapper b hidden">


                    </div>

                    <main>
                        <h1>{{$title}}</h1>
                        @if(count($anchors) > 1)
                            <hr>
                            <ul class="padder-v">
                                @foreach($anchors as $anchor)
                                    <li class="anchor-{{$anchor['level']}}">
                                        <a href="#{{$anchor['id']}}">{{$anchor['text']}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        {!! $content !!}
                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection
