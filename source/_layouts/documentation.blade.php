@extends('_layouts.master')

@section('nav-toggle')
    @include('_nav.menu-toggle')
@endsection

@section('content')

    <div class="bg-white-only">
        <div class="container no-padder" id="docs">
            <div class="row pt-3 pb-3 m-0">
                <div class="col col-md-3 b-r">
                    <nav class="nav-docs">

                        <div class="form-group mb-0 pl-sm-3 pr-sm-3 mb-3 mb-sm-0 d-none d-md-block">
                            <div class="block w-100">
                                <input type="search" class="form-control w-full" id="docsearch" placeholder="@yield('Search')">
                            </div>
                        </div>

                        @yield('documentation.menu')
                    </nav>
                </div>
                <div class="col col-md-9">
                    <main class="wrapper-lg order-md-first">
                        <h1>{{ $page->title }}</h1>

                        <div class="none d-md-block">
                            <a href="{{$page->editGitHub()}}"
                               class="pull-right bg-white"
                               style="margin-top: -0.5em; padding-left: 15px; ">
                                <small class="text-muted"><i class="icon-pencil m-r-xs"></i> @yield('docs.edit')</small>
                            </a>
                        </div>
                        <hr class="mb-4">

                        <!--Docs Anchors-->

                        @yield('main')
                    </main>
                </div>
            </div>
        </div>
    </div>

@endsection
