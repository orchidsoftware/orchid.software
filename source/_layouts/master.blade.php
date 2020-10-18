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
        <meta property="og:image" content="/favicon.svg"/>
        <meta property="og:type" content="website"/>

        <meta name="yandex-verification" content="23bb1990414a4f0e" />
        <meta name="google-site-verification" content="EWv-U0_XG4_ck_eYWIAhKzyZeHWvow4EsYexXE1q0mc" />

        <meta name="twitter:image:alt" content="{{ $page->siteName }}">
        <meta name="twitter:card" content="summary_large_image">

        <link rel="alternate" href="{{ $page->ahref('ru') }}" hreflang="ru"/>
        <link rel="alternate" href="{{ $page->ahref('en') }}" hreflang="en"/>
        <link rel="alternate" href="{{ $page->ahref('en') }}" hreflang="x-default"/>

        <title>{{ $page->title ?  $page->title . ' | ' : '' }}{{ $page->siteName }}</title>

        <link rel="home" href="{{ $page->baseUrl }}">
        <link rel="icon" href="/favicon.svg" sizes="any" type="image/svg+xml">
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
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="mr-3" height="30px" fill="currentColor">
                                <g>
                                    <path d="M86.55 30.73c-11.33 10.72-27.5 12.65-42.3 14.43-10.94 1.5-23.3 3.78-30.48 13.04-6.2 8.3-4.25 20.3 2.25 27.8 1.35 2.03 5.7 5.7 6.38 5.3-5.96-8.42-5.88-21.6 2.6-28.4 8.97-7.52 21.2-7.1 32.03-9.7 6.47-1.23 13.3-3.5 19.2-5.34-8.3 7.44-19.38 10.36-29.7 13.75-8.7 3.08-17.22 10.23-17.45 20.1-.17 6.8 3.1 14.9 10.06 17.07 18.56 4.34 39.14-3.16 50.56-18.4 12.7-16.12 13.75-40.2 2.43-57.33-1.33 2.9-3.28 5.5-5.58 7.7z"/>
                                    <path d="M0 49.97c-.14 4.35 1.24 13.9 2.63 14.64 1.2-11.48 10.2-20.74 20.83-24.47 17.9-7.06 38.75-3.1 55.66-13.18 5.16-2.3 9.28-9.48 4.36-14.1-2.16-1.76-5.9-5.75-3.7-.72.83 6.22-5.47 10.06-10.63 11.65-10.9 3.34-22.46 3-33.62 4.93-1.9.32-5.9 1.2-2.07-.6 10.52-5.02 23.57-4.38 32.6-12.5 4.8-3.75 2.77-11.16-2.4-13.4C57.4-.35 50.3-.35 43.63.35c-19.85 2.3-37.3 17.7-42.05 37.1C.52 41.57 0 45.77 0 49.97z"/>
                                </g>
                            </svg>

                            <span class="h3 font-thin text-uppercase">Orchid</span>
                        </a>
                    </h5>

                    <nav class="my-2 mt-4 mt-md-0 my-md-0 mr-md-3 d-none d-md-block">

                        <a class="p-3 m-sm-0" href="https://blog.orchid.software/">
                            <i class="icon-cup m-r-xs text-xs"></i>
                            @yield('main.blog')
                        </a>

                        <a class="p-3 m-sm-0 d-none d-sm-inline" href=" @yield('main.telegram')" target="_blank" rel="noopener noreferrer">
                            <i class="icon-bubbles m-r-xs text-xs"></i>
                            @yield('main.discussion')
                        </a>

                        <a class="p-3 m-sm-0" href="https://github.com/orchidsoftware">
                            <i class="icon-docs m-r-xs text-xs"></i>
                            GitHub
                        </a>

                    </nav>


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

                            <li>
                                <a href="https://blog.orchid.software/" target="_blank" rel="noopener noreferrer">
                                    <i class="icon-paper-plane m-r-xs"></i> Blog
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
