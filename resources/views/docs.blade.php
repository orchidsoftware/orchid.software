@extends('layout')

@section('title', $title ?? '')
@section('description', $description ?? '')
@section('keywords', $keywords ?? '')

@section('body')

    <div class="masthead shell">
        <header class="header">
            @include('header-menu')
        </header>
    </div>

    <div class="documentation">
        <div class="shell frame" id="docs">
            <img src="/img/next/docs-left-tentacli.svg" class="art left" alt="" aria-hidden="true">
            <img src="/img/next/docs-right-tentacli.svg" class="art right" alt="" aria-hidden="true">

            <div class="docs-layout theme-paper">
                <aside class="sidebar">
                    <x-docs-menu :section="$section ?? 'site.navigation.'"/>
                </aside>
                <div class="reading">
                    <main class="article">
                        @isset($redirect)
                            <script>
                                setTimeout( () => {
                                    window.location.href = '{{ $redirect }}';
                                }, 100);
                            </script>
                            <div class="docs-redirect">
                                <h1>Page Moved</h1>
                                <p>
                                    This page has been moved to a new address. If you were not automatically redirected,
                                    please click the button below to go to the new location.
                                </p>
                                <a href="{{ $redirect }}" class="button">
                                    Go to the new address
                                </a>
                            </div>
                        @else

                            <div class="headline">
                                <h1>{{ $title }}</h1>

                                <x-docs-edit :href="$edit" />
                            </div>


                            <x-docs-anchors :content="$content"/>
                            <x-docs-content :content="$content"/>


                            @yield('sub-main')
                        @endisset
                    </main>
                </div>

                <aside class="sponsors" aria-label="Our Friends">
                    <div class="content">
                        <p class="title">
                            Our Friends
                        </p>

                        <div class="links">
                            <a href="https://github.com/Assisted-Mindfulness?utm_source=orchid&utm_medium=docs&utm_campaign=friends" class="link" target="_blank" rel="noopener">
                                <img src="/img/sponsors/assisted-mindfulness-logo.svg" alt="Assisted Mindfulness" class="logo">
                            </a>

                            <a href="https://sajya.github.io?utm_source=orchid&utm_medium=docs&utm_campaign=friends" class="link" target="_blank" rel="noopener">
                                <img src="/img/sponsors/sajya.svg" alt="Sajya" class="logo">
                            </a>

                            @if(request()->fullUrlIs('*/ru/*'))
                                <a href="https://laravel.su?utm_source=orchid&utm_medium=docs&utm_campaign=friends" class="link" target="_blank" rel="noopener">
                                    <img src="/img/sponsors/laravelsu.png" alt="Laravel.su" class="logo">
                                </a>
                            @endif
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>



@endsection
