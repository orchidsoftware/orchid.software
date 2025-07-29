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



    <link rel="stylesheet" type="text/css" href="{{  mix('/css/app.css') }}">


    <x-meta
        title="{{ View::getSection('title') ?  View::getSection('title') . ' | ' : '' }}{{ config('site.name') }}"
        description="{{ View::getSection('description', config('site.description')) }}"
        image="https://github.com/orchidsoftware/art/raw/master/orchid-share.jpg"
    />

    <meta http-equiv="Content-Security-Policy" content="frame-ancestors metrika.yandex.ru metrika.yandex.by metrica.yandex.com metrica.yandex.com.tr webvisor.com *.webvisor.com;">
    <meta name="view-transition" content="same-origin">
        
    <link rel="alternate" href="{{ \App\Docs::ahref('ru') }}" hreflang="ru"/>
    <link rel="alternate" href="{{ \App\Docs::ahref('en') }}" hreflang="en"/>
    <link rel="alternate" href="{{ \App\Docs::ahref('en') }}" hreflang="x-default"/>

    <meta name="author" content="Alexandr Chernyaev">
    <meta property="og:site_name" content="{{ config('site.name') }}"/>
    <meta name="yandex-verification" content="23bb1990414a4f0e"/>
    <meta name="google-site-verification" content="EWv-U0_XG4_ck_eYWIAhKzyZeHWvow4EsYexXE1q0mc"/>
</head>
<body>

@yield('body')


<div class="footer bg-dark">
    <div class="container">
        <div class="row">

            <div class="col-md-5 footer-tentacles"></div>

            <div class="col-12 col-md-7">
                <div class="px-md-4 py-lg-5 my-lg-5 pb-5 px-3">
                    <h1 class="display-4 fw-bold mb-4 mb-md-5 text-balance">
                        <span class="text-primary">Discover</span> even more.
                    </h1>
                    <div class="col-lg-7 me-md-auto ms-md-0 mx-auto">
                        <p class="mb-0">
                            <a href="/en/community/code-of-conduct"
                               class="btn btn-outline-primary mb-3">Community Guidelines</a>
                            {{--
                            <a href="https://blog.orchid.software" class="btn btn-outline-primary mb-3">Blog</a>
                            --}}
                            <a href="https://opencollective.com/orchid"
                               class="btn btn-outline-primary mb-3">Donation</a>
                        </p>
                        <p>
                            <a href="https://github.com/orchidsoftware" class="btn btn-outline-primary mb-3">GitHub</a>
                            <a href="/en/discussions" class="btn btn-outline-primary mb-3">Discussion</a>
                            <a href="/en/hig" class="btn btn-outline-primary mb-3">HIG</a>
                            <a href="/en/license" class="btn btn-outline-primary mb-3">License</a>
                            
                        </p>
                    </div>
                    <small class="mt-5 mb-0">
                        <a href="/en/docs" class="{{ is_active(['*/en/*', '/', '/en']) ? 'text-white' : 'text-muted' }}">English</a>  /
                        <a href="/ru/docs" class="{{ is_active(['*/ru/*', '/ru']) ? 'text-white' : 'text-muted' }}">Russian</a>
                    </small>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ mix('/js/app.js') }}"></script>

@env('production')
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(42925369, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/42925369" style="position:absolute; left:-9999px;" alt="" /></div></noscript> 
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
<script type="text/javascript">
    if (window.document.getElementById('docsearch')) {
        docsearch({
            apiKey: 'afc2a7f7d4f201489dcd8c4f0f40bde2',
            indexName: 'orchid_software',
            inputSelector: '#docsearch',
            algoliaOptions: {'facetFilters': ["lang:" + document.documentElement.lang]},
            debug: true
        });
        document.addEventListener('keydown', (e) => {
            if (e.keyCode === 111 || e.keyCode === 191) {
                e.preventDefault()
                document.getElementById('docsearch').focus();
            }
            if (e.keyCode === 27) {
                document.getElementById('docsearch').blur();
                e.preventDefault()
            }
        })
    }
</script>

</body>
</html>
