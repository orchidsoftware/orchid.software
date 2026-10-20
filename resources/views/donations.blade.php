@extends('layout')

@section('title', "Support Orchid Sustainable Development")
@section('description', 'Your contribution goes a long way in enabling us to develop and maintain our open-source packages while providing ongoing support to the community')

@section('body')

    <div class="page-masthead">

        <div class="masthead shell">
            <header class="header">
                @include('header-menu')
            </header>
        </div>
    </div>

    <main class="donations shell">
        <div class="donation-intro">
            <div class="copy">

                <h1 class="title section-title">
                    <span class="headline">Your Donation <span class="accent text-accent">Will Change Everything!</span></span>
                </h1>

                <p class="description section-description reveal">
                    Your contribution empowers us to continue developing and maintaining these open-source packages and provide ongoing support to the community.
                </p>
            </div>
        </div>

        <div class="donation-stage">

            <div class="panel">

                <div class="backdrop">
                </div>

                <div class="card donation">

                    <div class="layout">

                        <div class="copy">
                            <div class="body">

                                <div class="message">
                                    <p class="heading">Donate on OpenCollective</p>

                                    <p>
                                        Contribute to Orchid for Laravel on OpenCollective to support us financially and track project expenses transparently.
                                        Help us promote sustainable and community-driven development.
                                    </p>
                                </div>

                                <div class="actions">

                                    <a href="https://opencollective.com/orchid" target="_blank" class="donate-link">
                                        Donate on OpenCollective

                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>

                                </div>
                            </div>
                        </div>

                        <div class="supporters">

                            <div class="supporter-content">
                                <small class="caption">These people are already with us!</small>
                                <x-backers/>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <p class="outro">Not ready to donate? Explore countless ways to make Orchid magnificent on <a href="/en/community/promote" class="text-link">our page</a>!</p>
    </main>
@endsection
