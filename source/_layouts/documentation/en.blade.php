@extends('_layouts.documentation')

@include('_lang.en')

@section('documentation.menu')
    @include('_nav.menu', ['items' => $page->navigation['en']])
@endsection
