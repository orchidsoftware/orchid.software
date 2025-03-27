@extends('layout')

@section('title', $title ?? '')
@section('description', $description ?? '')
@section('keywords', $keywords ?? '')

@section('body')

    <div class="bg-dark position-relative">

        <div class="container pt-md-4 pt-2 position-relative">
            <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4 px-4 position-relative">
                @include('header-menu')
            </header>
        </div>
    </div>

    <div class="documentation position-relative mb-5 mt-md-4 overflow-hidden">

        <div class="container position-relative" id="docs">
            <div class="row g-0 m-0 px-0 rounded-3 overflow-hidden">

                <img src="/img/next/docs-left-tentacli.svg" class="d-none d-md-block pe-none position-absolute" style="
    left: -40.5em;
    height: 20em;
    z-index: 3;
    bottom: 35%;">
                <img src="/img/next/docs-right-tentacli.svg" class="d-none d-md-block pe-none position-absolute" style="
    right: -15em;
    width: 25em;
    z-index: -1;
    bottom: 20%">


                <div class="col-12 col-lg-auto bg-grey py-lg-3 d-flex flex-column text-balance" style="background:#F9F9FE;z-index: 2">
                    <x-docs-menu :section="$section ?? 'site.navigation.'"/>
                </div>
                <div class="col-12 col-lg col-md-auto me-auto bg-white py-lg-3 overflow-hidden">
                    <main class="py-2 px-3 py-md-2 px-md-4 px-xl-5 ms-md-4 me-md-auto order-md-first overflow-auto">
                        @isset($redirect)
                            <script>
                                setTimeout( () => {
                                    window.location.href = '{{ $redirect }}';
                                }, 100);
                            </script>
                            <div class="position-relative p-5 text-center">
                                <h1 class="text-body-emphasis">Page Moved</h1>
                                <p class="col-lg-10 mx-auto mb-4 text-balance">
                                    This page has been moved to a new address. If you were not automatically redirected,
                                    please click the button below to go to the new location.
                                </p>
                                <a href="{{ $redirect }}" class="btn btn-primary px-5 mb-5">
                                    Go to the new address
                                </a>
                            </div>
                        @else

                            <div class="d-flex align-items-center mb-3 mt-3">
                                <h1 class="me-3">{{ $title }}</h1>

                                <a href="{{ $edit }}" class="btn btn-outline-dark ms-auto d-none d-md-flex align-items-center text-decoration-none text-nowrap"
                                   title="View and edit this file on GitHub" target="_blank" rel="noopener"
                                >
                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32" fill="currentColor">
                                        <path d="M30.133 1.552c-1.090-1.044-2.291-1.573-3.574-1.573-2.006 0-3.47 1.296-3.87 1.693-0.564 0.558-19.786 19.788-19.786 19.788-0.126 0.126-0.217 0.284-0.264 0.456-0.433 1.602-2.605 8.71-2.627 8.782-0.112 0.364-0.012 0.761 0.256 1.029 0.193 0.192 0.45 0.295 0.713 0.295 0.104 0 0.208-0.016 0.31-0.049 0.073-0.024 7.41-2.395 8.618-2.756 0.159-0.048 0.305-0.134 0.423-0.251 0.763-0.754 18.691-18.483 19.881-19.712 1.231-1.268 1.843-2.59 1.819-3.925-0.025-1.319-0.664-2.589-1.901-3.776zM22.37 4.87c0.509 0.123 1.711 0.527 2.938 1.765 1.24 1.251 1.575 2.681 1.638 3.007-3.932 3.912-12.983 12.867-16.551 16.396-0.329-0.767-0.862-1.692-1.719-2.555-1.046-1.054-2.111-1.649-2.932-1.984 3.531-3.532 12.753-12.757 16.625-16.628zM4.387 23.186c0.55 0.146 1.691 0.57 2.854 1.742 0.896 0.904 1.319 1.9 1.509 2.508-1.39 0.447-4.434 1.497-6.367 2.121 0.573-1.886 1.541-4.822 2.004-6.371zM28.763 7.824c-0.041 0.042-0.109 0.11-0.19 0.192-0.316-0.814-0.87-1.86-1.831-2.828-0.981-0.989-1.976-1.572-2.773-1.917 0.068-0.067 0.12-0.12 0.141-0.14 0.114-0.113 1.153-1.106 2.447-1.106 0.745 0 1.477 0.34 2.175 1.010 0.828 0.795 1.256 1.579 1.27 2.331 0.014 0.768-0.404 1.595-1.24 2.458z"></path>
                                    </svg>
                                    Suggest Edit
                                </a>
                            </div>


                            <x-docs-anchors :content="$content"/>
                            <x-docs-content :content="$content"/>


                            @yield('sub-main')
                        @endisset
                    </main>
                </div>

                <div class="d-none d-xxl-block col-xxl-auto bg-white">
                    <div class="pt-5 d-none d-lg-flex flex-column mb-3">
                        <p class="mb-1 d-none d-md-inline-block text-dark opacity-75 text-center small">
                            Our Friends
                        </p>

                        <div class="d-flex flex-column friends">
                            <a href="https://assisted-mindfulness.com?utm_source=orchid&utm_medium=docs&utm_campaign=friends" class="mt-2 py-3 rounded-3 mx-4" target="_blank" style="background: #2624300f;">
                                <img src="/img/sponsors/assisted-mindfulness-logo.svg" class="rounded-3" height="40px">
                            </a>

                            <a href="https://sajya.github.io?utm_source=orchid&utm_medium=docs&utm_campaign=friends" class="mt-2 py-3 rounded-3 mx-4" target="_blank" style="background: #2624300f;">
                                <img src="/img/sponsors/sajya.svg" class="rounded-3" height="40px">
                            </a>

                            @if(request()->fullUrlIs('*/ru/*'))
                                <a href="https://laravel.su?utm_source=orchid&utm_medium=docs&utm_campaign=friends" class="mt-2 py-3 rounded-3 mx-4" target="_blank" style="background: #2624300f;">
                                    <img src="/img/sponsors/laravelsu.png" class="rounded-3" height="40px">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
