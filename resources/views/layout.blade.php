<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.svg" sizes="any" type="image/svg+xml">
    <link rel="stylesheet" type="text/css" href="{{  mix('/css/app.css') }}">


    <x-meta
        title="{{ View::getSection('title') ?  View::getSection('title') . ' | ' : '' }}{{ config('site.name') }}"
        description="{{ View::getSection('description', config('site.description')) }}"
        image="https://github.com/orchidsoftware/art/raw/master/orchid-share.jpg"
    />

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

            <div class="col-12 col-md-7 text-center text-md-start">
                <div class="px-md-4 py-md-5 my-md-5 py-5 px-3">
                    <h1 class="display-4 fw-bold mb-5">
                        And one more <span class="text-primary">thing.</span>
                    </h1>
                    <div class="col-lg-7 me-md-auto ms-md-0 mx-auto">
                        <p class="mb-0">
                            <a href="https://github.com/orchidsoftware/platform/discussions"
                               class="btn btn-outline-primary mb-3">Discussion</a>
                            <a href="https://blog.orchid.software" class="btn btn-outline-primary mb-3">Blog</a>
                            <a href="https://opencollective.com/orchid"
                               class="btn btn-outline-primary mb-3">Donation</a>
                        </p>
                        <p>
                            <a href="https://github.com/orchidsoftware" class="btn btn-outline-primary mb-3">GitHub</a>
                            <a href="https://t.me/orchid_community" class="btn btn-outline-primary mb-3">Telegram</a>
                            <a href="https://twitter.com/orchid_platform"
                               class="btn btn-outline-primary mb-3">Twitter</a>
                            <a href="https://discord.gg/aEVdGMyRt4" class="btn btn-outline-primary mb-3">Discord</a>
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
            if (e.keyCode === 111) {
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
