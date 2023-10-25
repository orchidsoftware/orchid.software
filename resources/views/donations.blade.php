@extends('layout')

@section('title', "Support Orchid Sustainable Development")
@section('description', 'Your contribution goes a long way in enabling us to develop and maintain our open-source packages while providing ongoing support to the community')

@section('body')

    <div class="bg-dark position-relative">

        <div class="container pt-md-4 pt-2 position-relative">
            <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4 px-4 position-relative">
                @include('header-menu')
            </header>
        </div>
    </div>


    <div class="container py-5 mb-5">
        <div class="row my-3 my-md-5">
            <div class="col-12 col-lg-6 mx-auto text-md-center">

                <h1 class="display-5 fw-bold px-3">
                    <span class="d-block d-md-inline-block">Your Donation <span class="text-primary d-block">Will Change Everything!</span></span>
                </h1>

                <p class="lead text-muted mb-md-5 mb-3 opacity-slow intersection px-3">
                    Your contribution empowers us to continue developing and maintaining these open-source packages and provide ongoing support to the community.
                </p>
            </div>
        </div>

        <div class="row g-4 g-xxl-5 g-lg-4 g-md-3 love-confetti py-md-5">

            <div class="col-12 col-xl-8 mx-auto position-relative py-md-5">



                <div class="card shadow-sm position-relative card-feature overflow-hidden card-back-rotate ">
                </div>


                <div class="card shadow-sm h-100 position-relative card-feature overflow-hidden">


                    <div class="row h-100">

                        <div class="col-12 col-md-5">
                            <div class="card-body d-flex flex-column p-5 h-100">

                                <div class="mb-auto">
                                    <p class="h2 mb-3">Donate on OpenCollective</p>

                                    <p>
                                        Contribute to Orchid for Laravel on OpenCollective to support us financially and track project expenses transparently.
                                        Help us promote sustainable and community-driven development.
                                    </p>
                                </div>


                                <div class="mt-auto">

                                    <a href="https://opencollective.com/orchid" target="_blank" class="link-secondary d-block stretched-link text-decoration-none link-more">
                                        Donate on OpenCollective

                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>

                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-7" style="background: #2C2939">

                            <div class="d-flex flex-column align-items-center align-content-center h-100 p-3 p-lg-5">
                                <small class="text-muted my-3">These people are already with us!</small>
                                <x-backers/>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>

        <p class="my-3 my-md-5 text-center text-muted">Not ready to donate? Explore countless ways to make Orchid magnificent on <a href="/en/community/promote" class="link-light">our page</a>!</p>
    </div>
@endsection
