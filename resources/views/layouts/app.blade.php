<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title',setting('site_title','')) - Лучшая база поставщиков услуг</title>
    <meta name="description" content="@yield('description',setting('site_description',''))">
    <meta name="keywords" content="@yield('keywords',setting('site_keywords',''))">

    <meta http-equiv="X-DNS-Prefetch-Control" content="on">
    <link rel="dns-prefetch" href="{{ config('app.url') }}">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://maps.googleapis.com">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link rel="stylesheet" href="{{ mix('/css/app.css')}}" type="text/css"/>

    <meta property="og:title" content="@yield('title',setting('site_title','')) - Лучшая база поставщиков услуг">
    <meta property="og:description" content="@yield('description',setting('site_description',''))">
    <meta property="og:type" content="article">
    <meta property="og:image" content="@yield('image', config('app.url').'/img/tour/logo.png')">
    <meta property="og:url" content="{{url()->current()}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auth" content="{{ Auth::id() }}">


    <link rel="shortcut icon" type="image/png" href="/img/logo.png">

    <!--
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#58666e">
    <meta name="theme-color" content="#f1f3f5">
    -->

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
    color             : #1c7cd6;
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
<body>

<div id="app">



    <!-- header -->
<header id="header" class="navbar bg-white padder-v b-b box-shadow-lg">
    <div class="container">
        <div class="navbar-header">
        <button class="btn btn-link visible-xs pull-right m-r"
                type="button"
                data-toggle="collapse"
                data-target=".navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
        <a href="{{ url('/') }}" class="navbar-brand m-r-lg">
            <img src="http://demo-orchid.tk/orchid/img/orchid.svg" style="height: 20px;">
        </a>
      </div>
        <div class="collapse navbar-collapse">


            <ul class="nav navbar-nav">


                <li>
                    <a href="{{route('docs')}}">{{trans('welcome.documentation')}}</a>
                </li>
                <li>
                    <a href="{{url('http://demo.orchid.software')}}" target="_blank">{{trans('welcome.demo')}}</a>
                </li>
                {{--
            <li>
                <a href="/news">Новости</a>
            </li>
            --}}

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
                        <a href="https://www.paypal.me/tabuna/10usd" class="btn btn-sm btn-primary btn-rounded m-l"><strong>{{trans('welcome.donate')}}</strong></a>
                    </div>
              </ul>



        </div>
    </div>
</header>
    <!-- / header -->


    <div id="content">

        @yield('content')


    </div>


{{--
    <div class="bg-white b-t m-t-md">
        <div class="container">
            <div class="row m-t-xxl m-b-lg">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <p class="h2 text-black font-thin">Спонсоры</p>
                            <p class="text-muted">
                                Компании, которые нас поддерживают
                            </p>
                        </div>
            </div>

            <div class="row m-b-xxl v-center">
                        <div class="col-sm-3">
                            <a href="https://m.do.co/c/16c90d96a00c" target="_blank"><img src="https://theorchid.github.io/assets/img/sponsors/do.png" class="img-responsive"></a>
                        </div>
                                       <div class="col-sm-3">
                            <a href="https://m.do.co/c/16c90d96a00c" target="_blank"><img src="https://pantheon.io/sites/default/files/logos-int/logo-int-phpstorm.png" class="img-responsive"></a>
                        </div>


            </div>

        </div>
    </div>
--}}




<!-- footer -->
    <footer id="footer">
        @yield('footer')

        <section class="bg-white b-t">
            <div class="container">
                <div class="row m-t-xl m-b-xl">
                    <div class="col-md-6 hidden-xs">
                        <div class="m-t">
                            <ul class="list-inline">
                                <li><a href="https://github.com/theOrchid">Github</a></li>
                                <li><a href="mailto:bliz48rus@gmail.com?subject=ORCHID" target="_blank" rel="noopener noreferrer">{{trans('welcome.support')}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-12 text-right">
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
</body>
</html>
