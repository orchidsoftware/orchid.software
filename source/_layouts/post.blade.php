@extends('_layouts.master')

@include('_lang.en')

@push('meta')
    <meta property="og:title" content="{{ $page->title }}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ $page->getUrl() }}"/>
    <meta property="og:description" content="{{ $page->description }}"/>
@endpush

@section('content')

    <main class="bg-white-only how-to-do-it">
        <div class="container">
            <div class="row p-5 mx-md-5">
                <div class="col-auto">
                    <h1 class="pb-2 mb-3">{{ $page->title }}</h1>

                    @if ($page->cover_image)
                        <img src="{{ $page->cover_image }}" alt="{{ $page->title }} cover image" class="mb-2 img-fluid">
                    @endif

                    <p class="text-muted mb-1">
                        {{ $page->author }} • <time datetime="{{ $page->date }}">{{ date('F j, Y', $page->date) }}</time>
                    </p>

                    @if ($page->categories)
                        @foreach ($page->categories as $i => $category)
                            <a
                                    href="{{ '/blog/categories/' . $category }}"
                                    title="View posts in {{ $category }}"
                                    class="inline-block uppercase badge badge-secondary"
                            >{{ $category }}</a>
                        @endforeach
                    @endif

                    <div class="my-4 border-bottom">
                        @yield('main')
                    </div>



                    <nav class="row justify-content-between">
                            <div class="col-auto">
                                @if ($next = $page->getNext())
                                    <a href="{{ $next->getUrl() }}" title="Older Post: {{ $next->title }}">
                                        &LeftArrow; {{ $next->title }}
                                    </a>
                                @endif
                            </div>

                            <div class="col-auto">
                                @if ($previous = $page->getPrevious())
                                    <a href="{{ $previous->getUrl() }}" title="Newer Post: {{ $previous->title }}">
                                        {{ $previous->title }} &RightArrow;
                                    </a>
                                @endif
                            </div>
                        </nav>

                </div>
            </div>
        </div>
    </main>


@endsection
