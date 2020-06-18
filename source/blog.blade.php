---
pagination:
    collection: posts
    perPage: 6
---
@extends('_layouts.master')
@include('_lang.en')

@push('meta')
    <meta property="og:title" content="{{ $page->siteName }} Blog" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $page->getUrl() }}"/>
    <meta property="og:description" content="The list of blog posts for {{ $page->siteName }}" />
@endpush

@section('content')

    <main class="bg-white-only how-to-do-it">
        <div class="container">
            <div class="row pt-5 pb-5 container">



    <h1>Blog</h1>

    <hr class="border-b my-6">

    <div class="card-columns">
    @foreach ($pagination->items as $post)
        @include('_components.post-preview-inline')
    @endforeach
    </div>

    @if ($pagination->pages->count() > 1)
        <nav class="row justify-content-center center">
            @if ($previous = $pagination->previous)
                <a
                    href="{{ $previous }}"
                    title="Previous Page"
                    class="m-3"
                >&LeftArrow;</a>
            @endif

            @foreach ($pagination->pages as $pageNumber => $path)
                <a
                    href="{{ $path }}"
                    title="Go to Page {{ $pageNumber }}"
                    class="m-3 {{ $pagination->currentPage == $pageNumber ? 'text-muted' : '' }}"
                >{{ $pageNumber }}</a>
            @endforeach

            @if ($next = $pagination->next)
                <a
                    href="{{ $next }}"
                    title="Next Page"
                    class="m-3"
                >&RightArrow;</a>
            @endif
        </nav>
    @endif

            </div>
        </div>
    </main>
@stop
