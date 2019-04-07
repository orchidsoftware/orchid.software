@extends('_layouts.master')

@section('nav-toggle')
    @include('_nav.menu-toggle')
@endsection

@section('content')

    <div class="bg-white-only">
        <div class="container" id="docs">
            <div class="row pt-3 pb-3 m-0">
                <div class="col col-md-3 b-r">
                    <nav class="nav-docs">
                        @yield('documentation.menu')
                    </nav>
                </div>
                <div class="col col-md-9">
                    <main class="wrapper-lg order-md-first">
                        <h1>{{ $page->title }}</h1>

                        <div class="hidden-xs">
                            <a href="https://github.com/orchidsoftware/orchid.software/edit/master/source{{ $page->getPath() }}"
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
