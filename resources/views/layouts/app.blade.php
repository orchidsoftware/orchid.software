<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title',setting('site_title')) @if(isset($title)) - @endif ORCHID - Simple Laravel CMS</title>
    <meta name="description" content="@yield('description',setting('site_description',''))">
    <meta name="keywords" content="@yield('keywords',setting('site_keywords',''))">
    <meta name="author" content="Alexandr Chernyaev">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta http-equiv="X-DNS-Prefetch-Control" content="on">
    <link rel="dns-prefetch" href="{{ config('app.url') }}">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://maps.googleapis.com">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="{{ mix('/css/app.css')}}" type="text/css"/>

    <meta property="og:title" content="@yield('title',setting('site_title','')) ORCHID - Laravel admin panel - Laravel platform, laravel admin panel">
    <meta property="og:description" content="@yield('description',setting('site_description',''))">
    <meta property="og:type" content="article">
    <meta property="og:image" content="@yield('image', config('app.url').'/img/tour/logo.png')">
    <meta property="og:url" content="{{url()->current()}}">


    {!! Feed::link(route('rss'), 'atom', 'News', App::getLocale()) !!}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auth" content="{{ Auth::id() }}">


    <link rel="shortcut icon" type="image/png" href="/img/logo.png">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ac5ca0">
    <meta name="theme-color" content="#ffffff">


    <style>

        .flipkart-navbar-input {
            padding       : 11px 16px;
            border-radius : 2px 0 0 2px;
            border        : 0 none;
            outline       : 0 none;
            font-size     : 15px;
            color: #000;
        }

        .flipkart-navbar-button {
            border-radius : 0 2px 2px 0;
            padding       : 10px 0;
            height        : 43px;
            cursor        : pointer;
        }

        .smallnav {
            display : block;
        }

        .smallsearch {
            margin: 0 auto;
        }

        .menu {
            cursor : pointer;
        }

        @media screen and (min-width : 768px) {
            .largenav {
                display : block;
            }

            .smallnav {
                display : none;
            }

            .smallsearch {
                margin: 0 auto;
            }
        }

        </style>

    <style>


.text-orchid {
    color : #AC5CA0;
}

.desc {
    width       : 220px;
    margin-left : 25%;
}

.column {
    float : left;
}

.ico {
    color             : #AC5CA0;
    font-size         : 40px;
    position          : absolute;
    top               : 50%;
    left              : 10%;
    transform         : translateY(-50%);
    -webkit-transform : translateY(-50%);
    -moz-transform    : translateY(-50%);
    -ms-transform     : translateY(-50%);
    -o-transform      : translateY(-50%);
}
        </style>


    @stack('stylesheet')
</head>
<body itemscope itemtype="http://schema.org/WebPage">

<div id="app">



    <!-- header -->
<header id="header" class="navbar bg-white padder-v b-b box-shadow-lg">
    <div class="container">
        <div class="navbar-header">
        <button class="btn btn-link visible-xs pull-right m-r"
                type="button"
                data-toggle="collapse"
                data-target=".navbar-collapse">
          <i class="icon-menu"></i>
        </button>
        <a href="{{ url('/') }}" class="navbar-brand m-r-lg">
            <img src="/img/orchid.svg" style="height: 20px;">
        </a>
      </div>
        <div class="collapse navbar-collapse">


            <ul class="nav navbar-nav">


                <li>
                      <a href="{{route('docs')}}">
                          {{trans('welcome.documentation')}}
                      </a>
                </li>

                <li>
                      <a href="{{route('blog')}}">
                          {{trans('welcome.blog')}}
                      </a>
                </li>

                <li>
                      <a href="{{url('https://github.com/orchidsoftware/platform/issues')}}" target="_blank">
                          {{trans('welcome.support')}}</a>
                </li>

                <li>
                      <a href="{{url('https://demo.orchid.software')}}" target="_blank">
                          {{trans('welcome.demo')}}
                      </a>
                </li>

        </ul>

            {{--
                    <div class="collapse navbar-collapse">



                        <ul class="nav navbar-nav navbar-right text-center-xs">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <div class="m-t-sm">
                                    <a href="{{ route('login') }}" class="btn btn-link btn-sm">Вход </a> или
                                    <a href="{{route('register')}}" class="btn btn-sm btn-info btn-rounded m-l"><strong>Зарегистрироваться</strong></a>
                                </div>

                            @else
                                <li>
                                <a href="{{ url('/profile') }}" title="Мой профиль">
                      <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                        <img src="{{Auth::user()->getAvatar() }}" alt="{{Auth::user()->name}}">
                        <i class="on md b-white bottom"></i>
                      </span>
                                    <span class="hidden-sm hidden-md">{{Auth::user()->name}}</span>
                                </a>
                            </li>
                            @endif

                        </ul>
                    </div>
        --}}


            <ul class="nav navbar-nav navbar-right text-center-xs">
                    <div class="m-t-sm">
                        <a href="https://github.com/orchidsoftware/Platform" target="_blank" class="btn btn-sm btn-primary btn-rounded m-l"><strong>View on Github</strong></a>
                    </div>
              </ul>



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
                <div class="row m-t-xl m-b-xl">
                    <div class="col-md-8 col-xs-12">

                        <div class="m-t text-xs">
                            <ul class="list-inline">
                                <li class="hidden-xs">
                                    <a href="https://github.com/orchidsoftware" target="_blank">
                                        <i class="icon-social-github m-r-xs"></i> Github
                                    </a>
                                </li>

                                <li class="hidden-xs">
                                    <a href="https://packagist.org/packages/orchid/" target="_blank">
                                        <i class="icon-briefcase m-r-xs"></i> Packagist
                                    </a>
                                </li>

                                {{--
                                <li class="hidden-xs">
                                    <a href="mailto:bliz48rus@gmail.com?subject=ORCHID" target="_blank" rel="noopener noreferrer">
                                         <i class="icon-envelope m-r-xs"></i> {{trans('welcome.contacts')}}
                                    </a>
                                </li>
                                --}}

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
                                        <i class="icon-wallet m-r-xs"></i> {{trans('welcome.donate')}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 hidden-xs text-right">
                        <p class="text-xs">
                           {{trans('welcome.licence')}}
                        </p>
                        <p class="text-xs text-muted">Copyright © 2016 - {{date('Y')}} Chernyaev Alexander</p>
                    </div>
                </div>
            </div>
        </section>
    </footer>
    <!-- / footer -->


</div>

<script src="{{ mix('/js/app.js')}}"></script>



<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter42925369 = new Ya.Metrika({ id:42925369, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/42925369" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->


<script>
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

<!--
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-6284335724986539",
        enable_page_level_ads: true
    });
</script>
-->



</body>
</html>
