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
