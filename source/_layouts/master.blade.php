<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="{{ $page->description ?? $page->siteDescription }}">
        <meta name="author" content="Alexandr Chernyaev">

        <meta property="og:site_name" content="{{ $page->siteName }}"/>
        <meta property="og:title" content="{{ $page->title ?  $page->title . ' | ' : '' }}{{ $page->siteName }}"/>
        <meta property="og:description" content="{{ $page->description ?? $page->siteDescription }}"/>
        <meta property="og:url" content="{{ $page->getUrl() }}"/>
        <meta property="og:image" content="/assets/img/orchid.svg"/>
        <meta property="og:type" content="website"/>

        <meta name="twitter:image:alt" content="{{ $page->siteName }}">
        <meta name="twitter:card" content="summary_large_image">

        @if ($page->docsearchApiKey && $page->docsearchIndexName)
            <meta name="generator" content="tighten_jigsaw_doc">
        @endif

        <title>{{ $page->siteName }}{{ $page->title ? ' | ' . $page->title : '' }}</title>

        <link rel="home" href="{{ $page->baseUrl }}">
        <link rel="icon" href="/favicon.ico">

        @stack('meta')

        @if ($page->production)
            <!-- Insert analytics code here -->
            
            <meta name="yandex-verification" content="23bb1990414a4f0e" />

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" async> (function (d, w, c) {
            (w[c] = w[c] || []).push(function () {
                try {
                    w.yaCounter42925369 = new Ya.Metrika2({
                        id: 42925369,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true,
                        webvisor: true,
                        trackHash: true
                    });
                } catch (e) {
                }
            });
            var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () {
                n.parentNode.insertBefore(s, n);
            };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/tag.js";
            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks2"); </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/42925369" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript> <!-- /Yandex.Metrika counter -->


    <script async>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-39757298-4', 'auto');
        ga('send', 'pageview');
    </script>
            
        @endif

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,300i,400,400i,700,700i,800,800i" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css', 'assets/build') }}">
        <script src="{{ mix('js/app.js', 'assets/build') }}"></script>


    @if ($page->docsearchApiKey && $page->docsearchIndexName)
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" />
        @endif
    </head>


    <body itemscope itemtype="http://schema.org/WebPage">

    <div id="app" class="b-t b-primary">

        <!-- header -->
        <header id="header" class="bg-white b-b box-shadow-lg">
            <div class="container">
                <div class="d-flex flex-column flex-md-row align-items-center p-4 px-md-4">
                    <h5 class="my-0 mr-md-auto font-weight-normal">
                        <a href="{{$page->baseUrl}}/@yield('lang')">
                            <img src="/assets/img/orchid.svg" alt="Laravel Orchid" style="height: 20px;">
                        </a>
                    </h5>
                    <nav class="my-2 mt-4 mt-md-0 my-md-0 mr-md-3">
                        <a class="p-3 text-dark" href="/@yield('lang')/docs">
                            <i class="icon-docs m-r-xs text-xs"></i>
                            @yield('main.documentation')
                        </a>
                        <a class="p-3 text-dark" href="/@yield('lang')/icons">
                            <i class="icon-cup m-r-xs text-xs"></i>
                            @yield('main.icons')
                        </a>

                        <a class="p-3 text-dark" href="https://t.me/orchid_community" target="_blank" rel="noopener noreferrer">
                            <i class="icon-bubbles m-r-xs text-xs"></i>
                            @yield('main.discussion')
                        </a>

                        <a class="p-3 text-dark" href="https://github.com/orchidsoftware/platform/issues" target="_blank">
                            <i class="icon-support m-r-xs text-xs"></i>
                            @yield('main.support')
                        </a>
                    </nav>

                    <a href="https://github.com/orchidsoftware/platform" target="_blank" class="btn btn-sm btn-outline-primary btn-rounded hidden-sm">
                        <strong><i class="icon-social-github m-r-xs"></i> @yield('main.github')</strong>
                    </a>
                </div>
            </div>
        </header>
        <!-- / header -->

        <div id="content">
            @yield('content')
        </div>

        <!-- footer -->
        <footer id="footer">
            @yield('footer')

            <section class="b-t">
                <div class="container">
                    <div class="m-t-xl m-b-xl text-xs text-center">
                        <ul class="list-inline">



                            <li class="hidden-xs">
                                <a href="https://github.com/orchidsoftware" target="_blank">
                                    <i class="icon-social-github m-r-xs"></i> Github
                                </a>
                            </li>

                            <li>
                                <a href="https://twitter.com/orchid_platform" target="_blank" rel="noopener noreferrer">
                                    <i class="icon-social-twitter m-r-xs"></i> Twitter
                                </a>
                            </li>

                            <li>
                                <a href="https://join.slack.com/t/lara-orchid/shared_invite/MjIxODM3MDcxODcyLTE1MDE4NzY0MzctMzRiZTBlMzYxZg" target="_blank" rel="noopener noreferrer">
                                    <i class="icon-bubbles m-r-xs"></i> Slack
                                </a>
                            </li>
                            <li>
                                <a href="https://t.me/orchid_community" target="_blank" rel="noopener noreferrer">
                                    <i class="icon-paper-plane m-r-xs"></i> Telegram
                                </a>
                            </li>
                            <li>
                                <a href="https://www.paypal.me/tabuna/10usd" target="_blank" rel="noopener noreferrer">
                                    <i class="icon-wallet m-r-xs"></i> @yield('main.donate')
                                </a>
                            </li>
                        </ul>
                        <ul class="list-inline">
                                <a href="/en">English</a>
                                <span> / </span>
                                <a href="/ru">Russian</a>
                            {{--
                                @foreach(config('localization.localesOrder') as $key => $value)
                                    <a href="/{{$key}}">{{$value}}</a>

                                    @if($loop->remaining)
                                        <span> / </span>
                                    @endif

                                @endforeach
                                --}}
                        </ul>

                    </div>
                </div>
            </section>

        </footer>
        <!-- / footer -->


    </div>
    </body>

    {{--
    <body class="flex flex-col justify-between min-h-screen bg-grey-lightest text-grey-darkest leading-normal font-sans">
        <header class="flex items-center shadow bg-white border-b h-24 mb-8 py-4" role="banner">
            <div class="container flex items-center max-w-4xl mx-auto px-4 lg:px-8">
                <div class="flex items-center">
                    <a href="/" title="{{ $page->siteName }} home" class="inline-flex items-center">
                        <img class="h-8 md:h-10 mr-3" src="/assets/img/logo.svg" alt="{{ $page->siteName }} logo" />

                        <h1 class="text-lg md:text-2xl text-blue-darkest font-semibold hover:text-blue-dark my-0 pr-4">{{ $page->siteName }}</h1>
                    </a>
                </div>

                <div class="flex flex-1 justify-end items-center text-right md:pl-10">
                    @if ($page->docsearchApiKey && $page->docsearchIndexName)
                        @include('_nav.search-input')
                    @endif
                </div>
            </div>

            @yield('nav-toggle')
        </header>

        <main role="main" class="w-full flex-auto">
            @yield('body')
        </main>

        <script src="{{ mix('js/app.js', 'assets/build') }}"></script>

        @stack('scripts')

        <footer class="bg-white text-center text-sm mt-12 py-4" role="contentinfo">
            <ul class="flex flex-col md:flex-row justify-center list-reset">
                <li class="md:mr-2">
                    &copy; <a href="https://tighten.co" title="Tighten website">Tighten</a> {{ date('Y') }}.
                </li>

                <li>
                    Built with <a href="http://jigsaw.tighten.co" title="Jigsaw by Tighten">Jigsaw</a>
                    and <a href="https://tailwindcss.com" title="Tailwind CSS, a utility-first CSS framework">Tailwind CSS</a>.
                </li>
            </ul>
        </footer>
    </body>
--}}

</html>
