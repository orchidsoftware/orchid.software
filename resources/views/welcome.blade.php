@extends('layout')

@section('body')
    <div class="bg-dark bg-main position-relative">

        <div class="d-none d-md-block position-absolute start-0 end-0 bottom-0 top-0 overflow-hidden pe-none">
            <img src="/img/next/menu-tentacli.svg" class="position-absolute" style="right: 25vw;top: -3em;">
            <img src="/img/next/main-tentacli-left.svg" class="position-absolute" style="left: 16vw;bottom: -1em;">
            <img src="/img/next/main-tentacli-right.svg" class="position-absolute" style="right: 7vw;bottom: -7em;">
        </div>


        <div class="container pt-md-4 pt-2 position-relative" style="z-index: 1">
            <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4 px-4 position-relative">
                @include('header-menu')
            </header>


            <div class="px-4 py-md-5 my-md-5 text-center text-white">
                <div class="col-lg-6 mx-auto mb-5 pb-5">
                    <h1 class="display-5 fw-bold mb-md-5 mb-3">Build admin panels
                        <span class="d-block">with Laravel Orchid</span> 
                    </h1>
                    <p class="lead mb-md-5 pb-md-5 mb-3">
                        A free Laravel package that abstracts standard business logic and enables code-driven,
                        rapid development of back-office applications like admin panels and dashboards.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="container position-relative d-none d-md-block" style="margin-top: -13em; z-index: 3">
        <div class="col-lg-10 mx-auto">
            <img src="/img/next/screen.png"
                 class="pe-none img-fluid rounded">
        </div>
    </div>


    <div class="container">
        <div class="row my-3 my-md-5">
            <div class="col-12 col-lg-6 mx-auto text-center">
                <h1 class="display-5 fw-bold">Develop <span class="d-block d-md-inline-block text-primary">web applications,</span>
                    <small class="d-block">not admin panels.</small>
                </h1>


                <p class="lead text-muted mb-md-5 mb-3">
                    Stop reinventing the wheel and wasting your time developing your own admin panel from scratch. 
                    Focus on what really matters to you and start coding application logic right now!
                </p>
            </div>
        </div>

        <div class="row g-md-5">
            <div class="col-12 col-md-4 mb-3">
                <div class="card shadow-sm h-100 position-relative card-feature">


                    <img src="/img/next/feature1-tentacli.svg" class="d-none d-md-block pe-none position-absolute" style="
    top: -6em;
    right: -3em;">

                    <div class="card-body">

                        {{-- <h3 class="text-center">Easy to use</h3> --}}

                        <img src="/img/next/feature1.svg" class="pe-none img-fluid mx-auto d-block">

                        <ul class="d-table mx-auto p-0">
                            <li>Fast Loading Pages</li>
                            <li>Filtering & Sorting</li>
                            <li>Data Search</li>
                            <li>User Notifications</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <div class="card shadow-sm h-100 position-relative card-feature">
                    <div class="card-body">

                        {{-- <h3 class="text-center">Secured</h3> --}}

                        <img src="/img/next/feature2.svg" class="pe-none img-fluid mx-auto d-block">

                        <ul class="d-table mx-auto p-0">
                            <li>Security Permissions</li>
                            <li>Two-Factor Authentication</li>
                            <li>User Impersonation</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-3">
                <div class="card shadow-sm h-100 position-relative card-feature">


                    <img src="/img/next/feature3-tentacli.svg" class="d-none d-md-block pe-none position-absolute" style="
    top: 6em;
    left: -3.8em;">

                    <div class="card-body">

                        {{-- <h3 class="text-center">Customizable</h3> --}}

                        <img src="/img/next/feature3.svg" class="pe-none img-fluid mx-auto d-block">

                        <ul class="d-table mx-auto p-0">
                            <li>Various Interface Elements</li>
                            <li>Support for right-to-left text</li>
                            <li>Form builder</li>
                            <li>Localization</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">


        <div class="row align-items-center my-5 py-5">

            <div class="col-12 col-md-5">

                <h2 class="display-5 fw-bold">Free and <span class="text-primary">Open Source</span>
                    <span class="d-block">for any purposes.</span>
                </h2>
                <p class="lead px-lg-8 text-muted">
                    Everything that we do is 100% composed of open and free code, jointly developed by people from all
                    over the world.
                </p>
            </div>

            <div class="d-none d-md-block col-md-7">
                <x-contributors/>
            </div>
        </div>
    </div>

    <div class="bg-white text-dark bottom-union">


        <div class="container pt-5">


            <div class="px-md-4 py-5 text-md-center text-dark">
                <div class="col-lg-6 mx-auto">
                    <h2 class="display-5 fw-bold text-primary">Testimonials</h2>
                    <p class="lead px-lg-8">
                        Over the years, the package has helped many developers create high-quality applications
                        with a minimum of attention to administration panels.
                    </p>
                </div>
            </div>


            <div class="row align-items-top justify-content-center">

                <div class="col-md-8 col-lg-4">
                    <div class="p-4 ">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <img alt="image" class="rounded-circle"
                                     src="/img/testimonials/Pavlov-Pavel.jpg"
                                     width="64px" height="64px">
                            </div>
                            <div class="col-auto mr-auto">
                                <strong>Pavlov Pavel</strong><br>
                                <small class="text-muted">Russia, Shira</small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <p class="font-weight-light">
                                    For me, Orchid appeared at the same time as Laravel because for learning Laravel,
                                    I started looking for the admin panel and chose the Orchid Platform. At the moment,
                                    I am doing all projects on Orchid. The main advantage of Orchid is that you can get
                                    started quickly,
                                    and in a short time, you can get to the very essence of the project. And then, it is
                                    easy to scale the project.
                                    Another huge plus of the Orchid Platform is the code organization structure.
                                    Learning to think according to
                                    this structure to speed up development in other projects.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-4 mt-4 mt-lg-0">
                    <div class="p-4 ">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <img alt="image" class="rounded-circle"
                                     src="/img/testimonials/Lemys-Lopez.jpg"
                                     width="64px" height="64px"
                                >
                            </div>
                            <div class="col-auto mr-auto">
                                <strong>Lemys López</strong><br>
                                <small class="text-muted">Venezuela, Valencia.</small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <p class="font-weight-light">
                                    The laravel ecosystem is vast as mature. But as an aged web developer,
                                    I realize that "richness" is not enough, I need a stable and well-designed open
                                    source platform,
                                    in terms of architecture and principles which allows to me and my team ship
                                    solutions fast,
                                    with an easy to maintain base code and without all the common fancy "automatic
                                    magic" that
                                    might be complex to adapt and useless most of the time. Orchid-platform is all that
                                    and more,
                                    Orchid-Platform boost out our productivity in levels that i can't almost not to
                                    believe with
                                    beautiful and expressive resulting code. Orchid-platform is application-nature
                                    agnostic but
                                    it fits like no other package on administrative kind of Solutions.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-4 mt-4 mt-lg-0">
                    <div class="p-4 ">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <img alt="image" class="rounded-circle"
                                     src="/img/testimonials/Vladislav-Ponomarev.jpg"
                                     width="64px" height="64px"
                                >
                            </div>
                            <div class="col-auto mr-auto">
                                <strong>Vladislav Ponomarev</strong><br>
                                <small class="text-muted">Russia, Krasnodar</small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <p class="font-weight-light">

                                    Before meeting Orchid, I constantly had to write the admin panel from scratch.
                                    It was such a "pleasure". I first heard about Orchid in a podcast on "Five Minutes
                                    PHP".
                                    After reading the documentation, I decided to try it, and I still use it. Orchid
                                    fits most projects I develop and scales well. If you have any questions,
                                    you will always be helped in the project's official Telegram chat. Although the
                                    answers to most of the questions are in the documentation.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-4 mt-4 mt-lg-0">
                    <div class="p-4 ">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <img alt="image" class="rounded-circle"
                                     src="/img/testimonials/alash3al.jpeg"
                                     width="64px" height="64px"
                                >
                            </div>
                            <div class="col-auto mr-auto">
                                <strong>Mohamed Al Ashaal</strong><br>
                                <small class="text-muted">Egypt, Cairo</small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <p class="font-weight-light">
                                    I liked Orchid as it gives me the power of control without the need of missy plugins/modules,
                                    I'm using it in many side-projects when comparing it to its similar solutions, I found that Orchid has a better architecture.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-4 mt-4 mt-lg-0">
                    <div class="p-4 ">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <img alt="image" class="rounded-circle"
                                     src="/img/testimonials/romansidorov.jpeg"
                                     width="64px" height="64px"
                                >
                            </div>
                            <div class="col-auto mr-auto">
                                <strong>Roman Sidorov</strong><br>
                                <small class="text-muted">Russia, Moscow</small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <p class="font-weight-light">
                                    A great solution. The key feature is a compromise between user-friendly interface and developer-friendly architecture.
                                    Ideal for administering small to medium sized projects. I recommend to consider it if you are a developer.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>



    <div class="bg-white text-dark top-union pb-5">

        <div class="container py-5 mb-5">
            <div class="row flex-lg-row-reverse align-items-center">
                <div class="d-none d-md-block col-12 col-sm-8 col-lg-6">
                    <img src="/img/next/unbox.svg" class="d-block mx-auto img-fluid" alt="Open Source" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3 text-center text-md-start">Explore Orchid <span class="text-primary">now!</span></h1>
                    <p class="lead w-75 mx-auto ms-md-0">
                        We are driven by enthusiasm and voluntary donations from the following users:
                    </p>

                    <x-backers/>

                    <div class="d-grid gap-1 d-md-flex justify-content-md-start">
                        <a href="/en/docs" class="btn btn-outline-dark btn-lg me-md-1">Read The Documentation</a>
                        <a href="https://opencollective.com/orchid/donate" class="btn btn-link btn-lg">Become a baker</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
