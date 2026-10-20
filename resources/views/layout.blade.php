<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/svg+xml" sizes="any"   href="/favicon.svg">
    <link rel="icon" type="image/svg+xml" sizes="64x64" href="/favicon.svg">
    <link rel="icon" type="image/svg+xml" sizes="32x32" href="/favicon.svg">
    <link rel="icon" type="image/svg+xml" sizes="16x16" href="/favicon.svg">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#272531">
    <meta name="msapplication-TileColor" content="#272531">
    <meta name="theme-color" content="#272531">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-meta
        title="{{ View::getSection('title') ?  View::getSection('title') . ' | ' : '' }}{{ config('site.name') }}"
        description="{{ View::getSection('description', config('site.description')) }}"
        image="https://github.com/orchidsoftware/art/raw/master/orchid-share.jpg"
    />

    <meta http-equiv="Content-Security-Policy" content="frame-ancestors metrika.yandex.ru metrika.yandex.by metrica.yandex.com metrica.yandex.com.tr webvisor.com *.webvisor.com;">
    <meta name="view-transition" content="same-origin">

    @unless(request()->routeIs('design-system'))
        <link rel="alternate" href="{{ \App\Docs::ahref('ru') }}" hreflang="ru"/>
        <link rel="alternate" href="{{ \App\Docs::ahref('en') }}" hreflang="en"/>
        <link rel="alternate" href="{{ \App\Docs::ahref('en') }}" hreflang="x-default"/>
    @endunless

    <meta name="author" content="Alexandr Chernyaev">
    <meta property="og:site_name" content="{{ config('site.name') }}"/>
    <meta name="yandex-verification" content="23bb1990414a4f0e"/>
    <meta name="google-site-verification" content="EWv-U0_XG4_ck_eYWIAhKzyZeHWvow4EsYexXE1q0mc"/>

</head>
<body>

@yield('body')


<footer class="footer">
    <div class="layout shell">
        <div class="art" aria-hidden="true"></div>
        <div class="content">
            <h2 class="title"><span class="text-accent">Discover</span> even more.</h2>
            <nav class="links" aria-label="Community">
                <p class="link-row">
                <a href="/{{ app()->getLocale() }}/community/code-of-conduct" class="link">Community Guidelines</a>
                <a href="https://opencollective.com/orchid" class="link">Donation</a>
                </p>
                <p class="link-row">
                <a href="https://github.com/orchidsoftware" class="link">GitHub</a>
                <a href="/{{ app()->getLocale() }}/discussions" class="link">Discussion</a>
                <a href="/en/hig" class="link">HIG</a>
                <a href="/{{ app()->getLocale() }}/license" class="link">License</a>
                </p>
            </nav>
            <nav class="languages" aria-label="Documentation language">
                <a href="/en/docs" @class(['link', 'is-active' => is_active(['*/en/*', '/', '/en'])])>English</a>
                <span aria-hidden="true">/</span>
                <a href="/ru/docs" @class(['link', 'is-active' => is_active(['*/ru/*', '/ru'])])>Russian</a>
            </nav>
        </div>
    </div>
</footer>

@env('production')
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(42925369, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/42925369" class="analytics-pixel" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

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
@endenv

</body>
</html>
