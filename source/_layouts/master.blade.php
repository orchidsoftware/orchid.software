<!DOCTYPE html>
<html lang="@yield('lang', 'en')">
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" />

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

    <div id="app">

        <!-- header -->
        <header id="header" class="bg-dark">
            <div class="container">
                <div class="d-flex flex-column flex-md-row align-items-center p-4 px-md-4">
                    <h5 class="my-0 mr-md-auto font-weight-normal">
                        <a href="{{$page->baseUrl}}/@yield('lang')" class="v-center">
                            <img src="/assets/img/logo-white.svg" alt="Laravel Orchid" class="mr-3" style="height: 20px;">
                            <span class="h3 font-thin text-uppercase">Orchid</span>
                        </a>
                    </h5>
                    <nav class="my-2 mt-4 mt-md-0 my-md-0 mr-md-3">
                        <a class="p-3 m-sm-0" href="/@yield('lang')/docs">
                            <i class="icon-docs m-r-xs text-xs"></i>
                            @yield('main.documentation')
                        </a>
                        <a class="p-3 m-sm-0" href="/@yield('lang')/icons">
                            <i class="icon-cup m-r-xs text-xs"></i>
                            @yield('main.icons')
                        </a>

                        <a class="p-3 m-sm-0 d-none d-sm-inline" href=" @yield('main.telegram')" target="_blank" rel="noopener noreferrer">
                            <i class="icon-bubbles m-r-xs text-xs"></i>
                            @yield('main.discussion')
                        </a>

                        <a class="p-3 m-sm-0 d-none d-sm-inline" href="https://github.com/orchidsoftware/platform/issues" target="_blank">
                            <i class="icon-support m-r-xs text-xs"></i>
                            @yield('main.support')
                        </a>
                    </nav>

                    <a href="https://github.com/orchidsoftware/platform" target="_blank" class="btn btn-sm btn-outline-primary btn-rounded d-none d-sm-inline">
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
                    <div class="pt-5 pb-5 text-xs text-center">
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
                                <a href="@yield('main.telegram')" target="_blank" rel="noopener noreferrer">
                                    <i class="icon-paper-plane m-r-xs"></i> Telegram
                                </a>
                            </li>
                        </ul>
                        <ul class="list-inline">
                                <a href="/en">English</a>
                                <span> / </span>
                                <a href="/ru">Russian</a>
                        </ul>

                    </div>
                </div>
            </section>

        </footer>
        <!-- / footer -->


    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
    <script type="text/javascript"> docsearch({
            apiKey: 'afc2a7f7d4f201489dcd8c4f0f40bde2',
            indexName: 'orchid_software',
            inputSelector: '#docsearch',
            algoliaOptions: {'facetFilters': ["lang:" + document.documentElement.lang]},
            debug: true
        });
    </script>

    </body>
</html>
