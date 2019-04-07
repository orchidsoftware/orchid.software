@extends('_layouts.master')

@section('content')


    <section class="bg-dark b-b">
        <div class="container">

            <div class="row pt-4">
                <h1 class="text-center center text-white font-thin w-75 padder-v mb-3 pt-5 mt-4">
                    <span class="icon-rocket text-muted m-r-md"></span> @yield('main.title')</h1>
            </div>

            <div class="row pt-4" style="margin-bottom: -3em!important;">

                <div class="col-md-9 text-center">
                    <div class="center">
                        <img src="https://user-images.githubusercontent.com/5102591/52168128-014cb680-2737-11e9-9ed3-28637780cf64.png"
                             alt="Laravel Orchid Admin"
                             class="img-fluid">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="padder-v text-left m-b-xl">
                        <h4 class="text-white font-thin"><i class="icon-monitor mr-2"></i>  @yield('main.screen.title')</h4>
                        <div>
                            @yield('main.screen.description')
                        </div>
                    </div>
                    <div class="padder-v text-left m-b-xl">
                        <h4 class="text-white font-thin"><i class="icon-layers mr-2"></i> @yield('main.design.title')</h4>
                        <div>
                            @yield('main.design.description')
                        </div>
                    </div>
                    <div class="padder-v text-left m-b-xl">
                        <h4 class="text-white font-thin"><i class="icon-bulb mr-2"></i> @yield('main.idea.title')</h4>
                        <div>
                            @yield('main.idea.description')
                        </div>
                    </div>
                    <div class="padder-v text-left m-b-xl">
                        <h4 class="text-white font-thin"><i class="icon-code mr-2"></i> @yield('main.code.title')</h4>
                        <div>
                            @yield('main.code.description')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="bg-white position-relative">
        <div class="container pt-5 pb-5">
            <h2 class="text-center center text-dark font-thin w-75 padder-v mb-3 pt-5">
                @yield('main.description')
            </h2>

            <div class="row padder-v mt-5">
                <div class="col">
                    <div class="item">
                        <div class="h4"><i class="icon-cloud-download"></i></div>
                        <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>
                        <div class="item-name h4 font-thin m-b"> @yield('main.col1.title')</div>
                        <div class="item-desc">
                            @yield('main.col1.description')
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="h4"><i class="icon-badge"></i></div>
                        <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>
                        <div class="item-name h4 font-thin m-b">@yield('main.col2.title')</div>
                        <div class="item-desc">
                            @yield('main.col2.description')
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="h4"><i class="icon-briefcase"></i></div>
                        <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>
                        <div class="item-name h4 font-thin m-b">@yield('main.col3.title')</div>
                        <div class="item-desc">
                            @yield('main.col3.description')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row padder-v mt-5 mb-5">
                <div class="col">
                    <div class="item">
                        <div class="h4"><i class="icon-organization"></i></div>
                        <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>
                        <div class="item-name h4 font-thin m-b">@yield('main.col4.title')</div>
                        <div class="item-desc">
                            @yield('main.col4.description')
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="h4"><i class="icon-bar-chart"></i></div>
                        <div class="linear-gradient h-1/2 bg-primary w-xs mt-3 mb-3" style="height: 2px;"></div>
                        <div class="item-name h4 font-thin m-b">@yield('main.col5.title')</div>
                        <div class="item-desc">
                            @yield('main.col5.description')
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="item">
                        <div class="h4"><i class="icon-friends"></i></div>
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
                        <img src="/assets/img/github_logo.png" alt="Github" class="m-b-lg">
                        <p class="h3 l-h-1x text-dark font-thin m-b-lg"> @yield('github.title')</p>
                        <p>
                            @yield('github.description')
                        </p>

                        <p class="padder-v">
                            <a href="https://github.com/orchidsoftware/platform"
                               class="btn btn-lg btn-outline-primary btn-rounded">
                                @yield('github.button')
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
        <img src="/assets/img/github_browser.png" alt="Laravel Orchid Github" class="github_screenshot">
    </section>


@endsection
