@extends('_layouts.documentation')

@include('_lang.ru')

@section('documentation.menu')
    @include('_nav.menu', ['items' => $page->navigation['ru']])
@endsection
