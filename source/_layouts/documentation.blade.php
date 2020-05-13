@extends('_layouts.master')

@include('_lang.'.$page->get('lang','en'))

@section('nav-toggle')
    @include('_nav.menu-toggle')
@endsection

@section('content')

    <div class="bg-white-only">
        <div class="container no-padder" id="docs">
            <div class="row pt-3 pb-3 m-0">
                <div class="col-md-3 b-r">
                    <nav class="nav-docs">
                        @include('_nav.menu', ['items' => $page->navigation
                            [$page->get('lang','en')]
                            [$page->get('menu','docs')]
                        ])
                    </nav>
                </div>
                <div class="col col-md-9">
                    <main class="py-2 px-2 py-md-4 px-md-4 order-md-first">
                        <h1>{{ $page->title }}</h1>

                        @if($page->get('githubEdit',true))
                            <div class="none d-md-block">
                                <a href="{{$page->editGitHub()}}"
                                   class="pull-right bg-white"
                                   style="margin-top: -0.5em; padding-left: 15px; ">
                                    <small class="text-muted"><i class="icon-pencil m-r-xs"></i> @yield('docs.edit')</small>
                                </a>
                            </div>
                        @endif
                        <hr class="mb-4">

                        <!--Docs Anchors-->

                        @yield('main')
                    </main>
                </div>
            </div>
        </div>
    </div>

@endsection
