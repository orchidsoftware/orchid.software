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
                    <x-docs-menu :section="$section ?? 'site.navigation.'" :documentation="$documentation ?? null">
                        @if($documentation ?? null)
                            <div class="docs-version">
                                <svg class="symbol" aria-hidden="true" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="6" cy="5" r="2"/><circle cx="6" cy="19" r="2"/><circle cx="18" cy="5" r="2"/><path d="M6 7v10m12-10a10 10 0 0 1-10 10H6"/>
                                </svg>
                                <select id="docs-version" aria-label="{{ app()->getLocale() === 'ru' ? 'Версия Orchid' : 'Orchid version' }}" onchange="window.location.href = this.value">
                                    @foreach(collect($documentation->switcher($docPage))->groupBy(fn ($link, $version) => (int) $version < 14 ? 'Legacy' : 'Current', preserveKeys: true) as $group => $options)
                                        <optgroup label="{{ $group }}">
                                            @foreach($options as $version => $link)
                                                <option value="{{ $link }}" @selected($version === $documentation->version)>{{ $version }}{{ $version === \App\Documentation::latest() ? (app()->getLocale() === 'ru' ? ' (актуальная)' : ' (latest)') : (version_compare($version, \App\Documentation::latest(), '>') ? (app()->getLocale() === 'ru' ? ' (в разработке)' : ' (development)') : '') }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <svg class="chevron" aria-hidden="true" width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="m3 4.5 3 3 3-3"/></svg>
                                <noscript>
                                    <ul >
                                        @foreach($documentation->switcher($docPage) as $version => $link)
                                            <li><a href="{{ $link }}" @if($version === $documentation->version) aria-current="true" @endif>{{ $version }}</a></li>
                                        @endforeach
                                    </ul>
                                </noscript>
                            </div>
                        @endif
                    </x-docs-menu>
                </aside>
                <div class="reading">
                    <main class="article">
                        @if(($documentation ?? null) && $documentation->version !== \App\Documentation::latest())
                            <aside class="docs-archive alert-warning" role="note" aria-label="{{ $documentation->isDevelopment() ? (app()->getLocale() === 'ru' ? 'Документация в разработке' : 'Development documentation') : (app()->getLocale() === 'ru' ? 'Архивная документация' : 'Archived documentation') }}">
                                <svg class="symbol" aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 7h16v13H4zM3 3h18v4H3zM9 11h6"/>
                                </svg>
                                <div class="message">
                                    <div class="heading">
                                        <strong>{{ $documentation->isDevelopment() ? (app()->getLocale() === 'ru' ? 'Документация в разработке' : 'Development documentation') : (app()->getLocale() === 'ru' ? 'Архивная документация' : 'Archived documentation') }}</strong>
                                        <span class="version">{{ $documentation->version }}</span>
                                    </div>
                                    <p class="copy">{{ $documentation->isDevelopment() ? (app()->getLocale() === 'ru' ? 'Orchid '.$documentation->version.' находится в разработке. API может измениться до релиза.' : 'Orchid '.$documentation->version.' is in development. APIs may change before release.') : (app()->getLocale() === 'ru' ? 'Это руководство относится к одной из предыдущих версий Orchid.' : 'This guide covers an earlier version of Orchid.') }}</p>
                                    <a class="action" href="{{ $documentation->switcher($docPage)[\App\Documentation::latest()] }}">
                                        {{ $documentation->isDevelopment() ? (app()->getLocale() === 'ru' ? 'Открыть стабильную версию' : 'Read the stable version') : (app()->getLocale() === 'ru' ? 'Открыть актуальную версию' : 'Read the latest version') }}
                                        <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                            </aside>
                        @endif
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
                            <x-docs-content :content="$content" :documentation="$documentation ?? null"/>


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
