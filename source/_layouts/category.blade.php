@extends('_layouts.master')

@push('meta')
    <meta property="og:title" content="{{ $page->title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $page->getUrl() }}"/>
    <meta property="og:description" content="{{ $page->description }}" />
@endpush

@section('content')
    <main class="bg-white-only how-to-do-it">
        <div class="container">
            <div class="row pt-5 pb-5 container">



                <h1>{{ $page->title }}</h1>

                <hr class="border-b my-6">

                <div class="text-2xl border-b border-blue-200 mb-6 pb-10">
                    @yield('main')
                </div>

                <div class="card-columns">
                    @foreach ($page->posts($posts) as $post)
                        @include('_components.post-preview-inline')
                    @endforeach
                </div>

            </div>
        </div>
    </main>
@stop
