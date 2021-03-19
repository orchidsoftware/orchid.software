@extends('_layouts.master')

@include('_lang.en')

@section('content')

    <div class="bg-white-only how-to-do-it">
        <div class="container">
            <div class="row pt-5 pb-5 container">
                <div class="col-md-8 col-sm-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-white-only p-0">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/en/recipes">Recipes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                        </ol>
                    </nav>
                    <h1 class="text-dark font-thin mt-2 mb-2">{{ $page->title }}</h1>

                    @if($page->get('githubEdit',true))
                        <div class="none d-md-block">
                            <a href="{{$page->editGitHub()}}"
                               class="pull-right bg-white"
                               style="margin-top: -0.5em; padding-left: 15px; ">
                                <small class="text-muted">

                                    <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32" fill="currentColor">
                                        <path d="M30.133 1.552c-1.090-1.044-2.291-1.573-3.574-1.573-2.006 0-3.47 1.296-3.87 1.693-0.564 0.558-19.786 19.788-19.786 19.788-0.126 0.126-0.217 0.284-0.264 0.456-0.433 1.602-2.605 8.71-2.627 8.782-0.112 0.364-0.012 0.761 0.256 1.029 0.193 0.192 0.45 0.295 0.713 0.295 0.104 0 0.208-0.016 0.31-0.049 0.073-0.024 7.41-2.395 8.618-2.756 0.159-0.048 0.305-0.134 0.423-0.251 0.763-0.754 18.691-18.483 19.881-19.712 1.231-1.268 1.843-2.59 1.819-3.925-0.025-1.319-0.664-2.589-1.901-3.776zM22.37 4.87c0.509 0.123 1.711 0.527 2.938 1.765 1.24 1.251 1.575 2.681 1.638 3.007-3.932 3.912-12.983 12.867-16.551 16.396-0.329-0.767-0.862-1.692-1.719-2.555-1.046-1.054-2.111-1.649-2.932-1.984 3.531-3.532 12.753-12.757 16.625-16.628zM4.387 23.186c0.55 0.146 1.691 0.57 2.854 1.742 0.896 0.904 1.319 1.9 1.509 2.508-1.39 0.447-4.434 1.497-6.367 2.121 0.573-1.886 1.541-4.822 2.004-6.371zM28.763 7.824c-0.041 0.042-0.109 0.11-0.19 0.192-0.316-0.814-0.87-1.86-1.831-2.828-0.981-0.989-1.976-1.572-2.773-1.917 0.068-0.067 0.12-0.12 0.141-0.14 0.114-0.113 1.153-1.106 2.447-1.106 0.745 0 1.477 0.34 2.175 1.010 0.828 0.795 1.256 1.579 1.27 2.331 0.014 0.768-0.404 1.595-1.24 2.458z"></path>
                                    </svg>

                                    @yield('docs.edit')
                                </small>
                            </a>
                        </div>
                    @endif

                    <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>


                    <main>
                        @yield('main')
                    </main>
                </div>

                <div class="col-md-4 d-none d-md-block">
                    @empty(!$page->getBlogItems())
                        <section>
                            <h3 class="center text-dark font-thin">
                                <span>Latest News</span>
                            </h3>

                                <div class="row my-2">

                                    @foreach(collect($page->getBlogItems())->take(2) as $entry)
                                        <div class="col-md-12 my-2">


                                            <a href="{{$entry->link['href']}}" class="d-block">
                                                <img src="{{ $entry->logo }}" class="img-blog mb-3 border">
                                            </a>

                                            <h5 class="l-h-1x text-dark font-thin">
                                                <a href="{{$entry->link['href']}}">{{ $entry->title }}</a>
                                            </h5>

                                            <time class="my-2 d-block text-muted">
                                                {{ date('F j, Y', (int) $entry->timestamp) }}
                                            </time>
                                        </div>
                                    @endforeach

                                </div>
                        </section>
                    @endempty
                </div>
            </div>
        </div>
    </div>

@endsection
