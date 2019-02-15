<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8" />
    <base href="@yield('base',url()->current())">
    <title>@yield('title',setting('site_title')) @if(isset($title)) - @endif ORCHID - Laravel Admin Panel</title>
    <meta name="description" content="@yield('description',trans('welcome.descriptions'))">
    <meta name="keywords" content="@yield('keywords',setting('site_keywords',''))">
    <meta name="author" content="Alexandr Chernyaev">
    <link rel="shortcut icon" href="{{url('/favicon.ico')}}">
    <meta http-equiv="X-DNS-Prefetch-Control" content="on">
    <link rel="dns-prefetch" href="{{ config('app.url') }}">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://maps.googleapis.com">

    @foreach(config('localization.localesOrder') as $key => $value)
        <link rel="alternate" hreflang="{{$key}}" href="{{current_href_for_lang($key)}}">
    @endforeach

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="{{ url(mix('/css/app.css')) }}" type="text/css" />
    <meta property="og:title" content="@yield('title',setting('site_title','')) ORCHID - Laravel Admin Panel">
    <meta property="og:description" content="@yield('description', trans('welcome.descriptions'))">
    <meta property="og:type" content="article">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auth" content="{{ Auth::id() }}">

    <link rel="shortcut icon" type="image/png" href="{{  url('/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{  url('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" href="{{  url('/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{  url('/favicon-16x16.png') }}" sizes="16x16">
    <link rel="manifest" href="{{  url('/manifest.json') }}">
    <link rel="mask-icon" href="{{  url('/safari-pinned-tab.svg') }}" color="#ac5ca0">
    <meta name="theme-color" content="#ffffff">

    <script src="{{ url(mix('/js/app.js')) }}"></script>


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


    @stack('stylesheet')
</head>

<body itemscope itemtype="http://schema.org/WebPage">

<div id="app" class="b-t b-primary">



    <!-- header -->
    <header id="header" class="navbar bg-white padder-v b-b box-shadow-lg">
        <div class="container">
            <div class="navbar-header">
                <button class="btn btn-link visible-xs pull-right m-r" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="icon-menu"></i>
                </button>
                <a href="{{ url('/') }}" class="navbar-brand m-r-lg">
                    <img src="{{ url('/img/orchid.svg') }}" style="height: 20px;">
                </a>
            </div>
            <div class="collapse navbar-collapse">


                <ul class="nav navbar-nav">

                    <!--
                   <li>
                       <a href="/ru/feature">
                           Возможности
                       </a>
                   </li>
                   -->

                   <!--
                   <li>
                       <a href="/ru/developer">
                          Разработчикам
                       </a>
                   </li>
                   -->

                    <!--
                    <li>
                        <a href="/ru/get-involved">
                            Принять участие
                        </a>
                    </li>
                    -->


                    <li>
                        <a href="{{route('docs')}}">
                            <i class="icon-docs m-r-xs text-xs"></i>
                            {{trans('welcome.documentation')}}
                        </a>
                    </li>



                    <li>
                        <a href="{{route('icons')}}">
                            <i class="icon-cup m-r-xs text-xs"></i>
                            {{trans('welcome.icons')}}
                        </a>
                    </li>

                    <!--
                    <li>
                        <a href="{{route('blog')}}">
                            {{trans('welcome.blog')}}
                        </a>
                    </li>
                    -->
                    <!--
                    <li>
                        <a href="{{route('packages')}}">
                            <i class="icon-modules m-r-xs text-xs"></i>
                            {{trans('welcome.packages')}}
                        </a>
                    </li>
                    -->

                    <li>
                        <a href="{{url('https://t.me/orchid_community')}}" target="_blank" rel="noopener noreferrer">
                            <i class="icon-bubbles m-r-xs text-xs"></i>
                            {{trans('welcome.discussion')}}
                        </a>
                    </li>

                    <li>
                        <a href="{{url('https://github.com/orchidsoftware/platform/issues')}}" target="_blank">
                            <i class="icon-support m-r-xs text-xs"></i>
                            {{trans('welcome.support')}}
                        </a>
                    </li>


                    <!--
                    <li>
                        <a href="{{url('https://demo.orchid.software')}}" target="_blank">
                            {{trans('welcome.demo')}}
                        </a>
                    </li>
                    -->

                </ul>


                <div class="nav navbar-nav navbar-right text-center-xs">
                        <a href="https://github.com/orchidsoftware/platform" target="_blank" class="btn btn-sm btn-primary btn-rounded m-l m-t-sm">
                            <strong><i class="icon-social-github m-r-xs"></i> Contribute on GitHub</strong>
                        </a>
                </div>



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
                                    <a href="{{url('https://twitter.com/orchid_platform')}}" target="_blank" rel="noopener noreferrer">
                                        <i class="icon-social-twitter m-r-xs"></i> Twitter
                                    </a>
                                </li>

                                <li>
                                    <a href="{{url('https://join.slack.com/t/lara-orchid/shared_invite/MjIxODM3MDcxODcyLTE1MDE4NzY0MzctMzRiZTBlMzYxZg')}}" target="_blank" rel="noopener noreferrer">
                                        <i class="icon-bubbles m-r-xs"></i> Slack
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('https://t.me/orchid_community')}}" target="_blank" rel="noopener noreferrer">
                                        <i class="icon-paper-plane m-r-xs"></i> Telegram
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('https://www.paypal.me/tabuna/10usd')}}" target="_blank" rel="noopener noreferrer">
                                        <i class="icon-wallet m-r-xs"></i> {{trans('welcome.donate.button')}}
                                    </a>
                                </li>
                            </ul>
                    <ul class="list-inline">
                        <li class="m-r-xl">
                            @foreach(config('localization.localesOrder') as $key => $value)
                                <a href="/{{$key}}">{{$value}}</a>

                                @if($loop->remaining)
                                    <span> / </span>
                                @endif

                            @endforeach
                        </li>
                    </ul>

                </div>
            </div>
        </section>

    </footer>
    <!-- / footer -->


</div>
</body>
</html>
