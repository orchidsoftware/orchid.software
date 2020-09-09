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

        <meta name="yandex-verification" content="23bb1990414a4f0e" />
        <meta name="google-site-verification" content="EWv-U0_XG4_ck_eYWIAhKzyZeHWvow4EsYexXE1q0mc" />

        <meta name="twitter:image:alt" content="{{ $page->siteName }}">
        <meta name="twitter:card" content="summary_large_image">

        @if ($page->docsearchApiKey && $page->docsearchIndexName)
            <meta name="generator" content="tighten_jigsaw_doc">
        @endif

        <title>{{ $page->siteName }}{{ $page->title ? ' | ' . $page->title : '' }}</title>

        <link rel="home" href="{{ $page->baseUrl }}">
        <link rel="icon" href="/favicon.ico">
        <link rel="stylesheet" href="{{ mix('css/app.css', 'assets/build') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" />

        @stack('meta')
    </head>


    <body itemscope itemtype="http://schema.org/WebPage">

    <div id="app">

        <!-- header -->
        <header id="header" class="bg-dark">
            <div class="container">
                <div class="d-flex flex-column flex-md-row align-items-center py-3">
                    <h5 class="my-0 mr-md-auto font-weight-normal">
                        <a href="{{$page->baseUrl}}/@yield('lang')" class="v-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 117.5 64.125" class="mr-3" height="20px" fill="currentColor">
                                <path d="M29.04 64.13c-.64 0-1.28-.25-1.77-.74L14.15 50.26c-.98-.98-.98-2.56 0-3.54.97-.97 2.56-.97 3.53 0L30.8 59.86c1 .97 1 2.56 0 3.53-.48.48-1.12.73-1.76.73zM88.46 64.13c-.64 0-1.28-.25-1.77-.74-1-.98-1-2.57 0-3.54l13.1-13.13c1-.97 2.57-.97 3.55 0s.98 2.56 0 3.54L90.23 63.4c-.5.48-1.13.73-1.77.73zM58.75 63.5c-.66 0-1.3-.26-1.77-.73l-39.3-39.32-13.4 13.4c-1 .98-2.57.98-3.55 0-.97-.98-.97-2.56 0-3.53L15.9 18.15c.98-.98 2.56-.98 3.54 0l39.3 39.32 39.33-39.32c.97-.98 2.56-.98 3.53 0l15.17 15.17c.98.97.98 2.56 0 3.53s-2.56.98-3.54 0l-13.4-13.4-39.3 39.32c-.48.47-1.12.73-1.78.73zM73.92 20.17c-.64 0-1.28-.25-1.77-.74l-13.4-13.4-13.4 13.4c-.98.98-2.56.98-3.53 0-.98-.97-.98-2.55 0-3.53L56.98.73c.98-.98 2.56-.98 3.54 0L75.68 15.9c.98.97.98 2.56 0 3.53-.48.5-1.12.74-1.76.74z"></path>
                            </svg>
                            <span class="h3 font-thin text-uppercase">Orchid</span>
                        </a>
                    </h5>
                    {{--
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

                    </nav>
                    --}}

                    <div class="form-group mb-0 pl-sm-3 pr-sm-3 mb-3 mb-sm-0 d-none d-md-block">
                        <div class="block w-100">
                            <input type="search" class="form-control w-full"
                                   id="docsearch"
                                   placeholder="@yield('Search')"
                            >
                        </div>
                    </div>

                    <a href="/@yield('lang')/docs" class="btn btn-sm btn-outline-primary btn-rounded mt-4 mt-sm-0 d-none d-md-block">
                        <strong>
                            <svg class="m-r-xs" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32" fill="currentColor">
                                <path d="M24 0h-11c-1.104 0-2 0.895-2 2h11v8h8v16h-7v2h7c1.105 0 2-0.895 2-2v-18zM24 8v-5.172l5.171 5.172h-5.171zM2 4c-1.105 0-2 0.896-2 2v24c0 1.105 0.895 2 2 2h17c1.105 0 2-0.895 2-2v-18l-8-8.001h-11zM19 30h-17v-24h9v8h8v16zM13 12v-5.172l5.171 5.172h-5.171z"></path>
                            </svg>

                            @yield('main.documentation')
                        </strong>
                    </a>

                    {{--
                    <a href="https://github.com/orchidsoftware/platform" target="_blank" class="btn btn-sm btn-outline-primary btn-rounded d-none d-sm-inline">
                        <strong><i class="icon-social-github m-r-xs"></i> @yield('main.github')</strong>
                    </a>
                    --}}
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

                        @foreach($page->navigation[$page->get('lang','en')]['community'] as $links)
                            <ul class="list-inline">
                            @isset($links['children'])
                                @foreach($links['children'] as $name => $url)
                                        <li class="hidden-xs">
                                            <a href="{{$url}}">
                                                {{ $name }}
                                            </a>
                                        </li>
                                @endforeach
                            @endisset
                            </ul>
                        @endforeach

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


    @if ($page->production)
        <!-- Insert analytics code here -->

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

    <script src="{{ mix('js/app.js', 'assets/build') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
    <script type="text/javascript">
        if(window.document.getElementById('docsearch')) {
            docsearch({
                apiKey: 'afc2a7f7d4f201489dcd8c4f0f40bde2',
                indexName: 'orchid_software',
                inputSelector: '#docsearch',
                algoliaOptions: {'facetFilters': ["lang:" + document.documentElement.lang]},
                debug: true
            });
        }
    </script>

    </body>
</html>
