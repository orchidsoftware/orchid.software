@extends('_layouts.master')

@section('content')



    <section class="pb-5 bg-dark position-relative overflow-hidden b-b">
        <img src="https://raw.githubusercontent.com/orchidsoftware/platform/master/.github/IMAGES/promo-full.png" class="dev-macbook none d-md-block">
        <div class="container pt-4">
            <div class="row pl-sm-2 pr-sm-2">
                <div class="col-lg-6">
                    <div class="row pb-5">
                        <div class="col-md-12">
                            <h1 class="h2 normal text-white mb-4 mt-5 text-center text-sm-left">
                                <span class="icon-rocket text-muted m-r-md"></span> @yield('main.title')
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <h4 class="text-white font-thin"><i class="icon-settings mr-2"></i>  @yield('main.screen.title')</h4>
                            <div>
                                @yield('main.screen.description')
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <h4 class="text-white font-thin"><i class="icon-layers mr-2"></i> @yield('main.design.title')</h4>
                            <div>
                                @yield('main.design.description')
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <h4 class="text-white font-thin"><i class="icon-bulb mr-2"></i> @yield('main.idea.title')</h4>
                            <div>
                                @yield('main.idea.description')
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            <h4 class="text-white font-thin"><i class="icon-code mr-2"></i> @yield('main.code.title')</h4>
                            <div>
                                @yield('main.code.description')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{--
    <section class="hero bg-dark b-b">
        <div class="hero-dark">
            <div class="container">

            <div class="row pt-5">
                <h1 class="text-center center text-white font-thin w-75 padder-v mb-3 pt-5 mt-4">
                    <span class="icon-rocket text-muted m-r-md"></span> @yield('main.title')</h1>
            </div>

            <div class="row pt-5 pb-5">

                <div class="col-md-3 padder-v text-left">
                    <h4 class="text-white font-thin"><i class="icon-monitor mr-2"></i>  @yield('main.screen.title')</h4>
                    <div>
                        @yield('main.screen.description')
                    </div>
                </div>

                <div class="col-md-3 padder-v text-left">
                    <h4 class="text-white font-thin"><i class="icon-layers mr-2"></i> @yield('main.design.title')</h4>
                    <div>
                        @yield('main.design.description')
                    </div>
                </div>
                <div class="col-md-3 padder-v text-left">
                    <h4 class="text-white font-thin"><i class="icon-bulb mr-2"></i> @yield('main.idea.title')</h4>
                    <div>
                        @yield('main.idea.description')
                    </div>
                </div>
                <div class="col-md-3 padder-v text-left">
                    <h4 class="text-white font-thin"><i class="icon-code mr-2"></i> @yield('main.code.title')</h4>
                    <div>
                        @yield('main.code.description')
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
    --}}

    <section class="bg-white position-relative">
        <div class="container pt-5 pb-5">
            <h2 class="text-center center text-dark font-thin w-75 padder-v mb-3 pt-5">
                @yield('main.description')
            </h2>

            <div class="row padder-v mt-5">
                <div class="col col-12 col-md-4 m-md-0 mb-4">
                    <div class="item">
                        <div class="h3"><i class="icon-cloud-download"></i></div>
                        <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>
                        <div class="item-name h4 font-thin m-b"> @yield('main.col1.title')</div>
                        <div class="item-desc">
                            @yield('main.col1.description')
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-4 m-md-0 mb-4">
                    <div class="item">
                        <div class="h3"><i class="icon-clock"></i></div>
                        <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>
                        <div class="item-name h4 font-thin m-b">@yield('main.col2.title')</div>
                        <div class="item-desc">
                            @yield('main.col2.description')
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-4 m-md-0 mb-4">
                    <div class="item">
                        <div class="h3"><i class="icon-filter"></i></div>
                        <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>
                        <div class="item-name h4 font-thin m-b">@yield('main.col3.title')</div>
                        <div class="item-desc">
                            @yield('main.col3.description')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row padder-v mt-sm-5 mb-sm-5">
                <div class="col col-12 col-md-4 m-md-0 mb-4">
                    <div class="item">
                        <div class="h3"><i class="icon-organization"></i></div>
                        <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>
                        <div class="item-name h4 font-thin m-b">@yield('main.col4.title')</div>
                        <div class="item-desc">
                            @yield('main.col4.description')
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-4 m-md-0 mb-4">
                    <div class="item">
                        <div class="h3"><i class="icon-bar-chart"></i></div>
                        <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>
                        <div class="item-name h4 font-thin m-b">@yield('main.col5.title')</div>
                        <div class="item-desc">
                            @yield('main.col5.description')
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-md-4 m-md-0 mb-4">
                    <div class="item">
                        <div class="h3"><i class="icon-friends"></i></div>
                        <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>
                        <div class="item-name h4 font-thin m-b">@yield('main.col6.title')</div>
                        <div class="item-desc">
                            @yield('main.col6.description')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="github pos-rlt no-overflow b-t hidden-xs">
        <div class="container h-full v-center">
            <div class="row w-full m-t-xxl m-b-xxl">
                <div class="col-lg-5">
                    <div class="">
                        <a href="https://github.com/orchidsoftware/platform">
                            <img src="/assets/img/github_logo.png" alt="Github" class="m-b-lg">
                        </a>
                        <p class="h3 l-h-1x text-dark font-thin m-b-lg"> @yield('github.title')</p>
                        <p>
                            @yield('github.description')
                        </p>

                        <p class="padder-v">
                            <a href="/@yield('lang')/docs"
                               class="btn btn-lg btn-outline-primary btn-rounded">
                                @yield('read.doc')
                                <i class="icon-book-open m-l-xs" aria-hidden="true"></i>
                            </a>
                        </p>

                        <p class="text-muted m-t">
                            @yield('github.help')
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <a href="https://github.com/orchidsoftware/platform">
            <img src="/assets/img/github_browser.png" alt="Laravel Orchid Github" class="github_screenshot none d-md-block">
        </a>
    </section>


@endsection
