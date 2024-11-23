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


            <div class="px-3 py-md-5 my-md-5 text-md-center text-white">
                <div class="col-lg-6 mx-auto mb-5 pb-5 pt-3 pt-md-0">
                    <h1 class="display-5 fw-bold mb-md-5 mb-3">Enhance Your
                        <span class="d-block">Laravel with Orchid</span>
                    </h1>
                    <p class="lead mb-md-5 pb-md-5 mb-3 text-balance">
                        Laravel Orchid is a powerful and easy-to-use solution for creating admin panel and line of business applications.
                        With its code-driven approach, you can quickly and easily create efficient applications.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="container position-relative d-none d-md-block" style="margin-top: -13em; z-index: 3">
        <div class="col-lg-10 mx-auto">
            <img src="/img/next/screen.png"
                 class="pe-none img-fluid rounded-3">
        </div>
    </div>


    <div class="container">
        <div class="row my-3 my-md-5">
            <div class="col-12 col-lg-6 mx-auto text-md-center">
                <h1 class="display-5 fw-bold px-3">
                    <span class="d-block d-md-inline-block ">Say <span class="text-primary">goodbye</span></span>
                    <small class="d-block">to tedious development</small>
                </h1>

                <p class="lead text-muted mb-md-5 mb-3 opacity-slow intersection px-3 text-balance">
                    Stop wasting time and effort on developing admin panels from scratch.
                    Orchid streamlines the process, allowing you to focus on what truly matters - creating your application's logic.
                </p>
            </div>
        </div>

        <div class="row g-4 g-xxl-5 g-lg-4 g-md-3">

            <div class="col-12 col-xl-4">
                <div class="card shadow-sm h-100 position-relative card-feature" style="background-image: url(/img/next/rocket.svg);
    background-position: -20% 120%;
    background-repeat: no-repeat;">

                    <div class="card-body d-flex flex-column p-5">

                        <div class="mb-auto">
                            <p class="h2 mb-3">Quick Start</p>

                            <p>
                                Orchid ship with the necessary technical documentation and examples for a quick and
                                successful implementation
                            </p>
                        </div>


                        <div class="mt-auto">
                            <a href="/en/docs" class="link-secondary text-end d-block stretched-link text-decoration-none link-more">
                                Documentation
                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-8">
                <div class="card shadow-sm h-100 position-relative card-feature overflow-hidden">


                    <div class="row">

                        <div class="col-12 col-md-5">
                        <div class="card-body d-flex flex-column p-5 h-100">

                        <div class="mb-auto">
                            <p class="h2 mb-3">Screens</p>

                            <p>
                                Build modern apps that are 99% in PHP, and spend less time fiddling with tools and updating incompatible libraries.
                                Focus on what matters most: creating exceptional features for your users.
                            </p>
                        </div>


                        <div class="mt-auto">

                            <a href="/en/docs/screens" class="link-secondary d-block stretched-link text-decoration-none link-more">
                                Learn about Screens

                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </a>

                        </div>
                    </div>
                        </div>

                        <div class="col-12 col-md-7" style="background: #2C2939">
                            <pre class="overflow-hidden user-select-none" style="background: #2C2939"><code class="language-php">

use Orchid\Screen\Screen;

class Task extends Screen
{
    public function query(Task $task): iterable
    {
        return [
            'task' => $task
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('task.name')
                    ->title('Name')
                    ->placeholder('Enter task name')
                    ->help('The name of the task to be created.'),
            ]),
        ];
    }
}

</code></pre>
                        </div>

                    </div>


                </div>
            </div>

            <div class="col-12 col-xl-8">
                <div class="card shadow-sm h-100 position-relative card-feature overflow-hidden">


                    <div class="row h-100">

                        <div class="col-12 col-md-6">
                            <div class="card-body d-flex flex-column p-5 h-100">

                                <div class="mb-auto">
                                    <p class="h2 mb-3">UI components</p>

                                    <p>
                                        Orchid offers a vast selection of stunning UI components, including form inputs, dialogs, data grids, and visualizations.
                                        These components can be easily extended, and you can even create compositions directly in your code.
                                    </p>
                                </div>


                                <div class="mt-auto">

                                    <p class="text-muted mb-2">Browse components:</p>



                                    <a href="/en/docs/field" class="link-secondary d-inline-flex align-items-center mb-1 text-decoration-none link-more">
                                        Form Elements

                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>


                                    <a href="/en/docs/table" class="link-secondary d-inline-flex align-items-center mb-1 text-decoration-none link-more">
                                        Tables

                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>


                                    <a href="/en/docs/legend" class="link-secondary d-inline-flex align-items-center mb-1 text-decoration-none link-more">
                                        Legend

                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>


                                    <a href="/en/docs/charts" class="link-secondary d-inline-flex align-items-center mb-1 text-decoration-none link-more">
                                        Charts

                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>


                                    <a href="/en/docs/modals" class="link-secondary d-inline-flex align-items-center mb-1 text-decoration-none link-more">
                                        Modals

                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>


                                </div>
                            </div>
                        </div>

                        <div class="d-none d-md-block col-md-6">
                            <div class="pt-5 pe-5">
                                <img src="/img/next/table.svg" class="img-fluid">
                            </div>
                        </div>

                    </div>


                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-4">
                <div class="card shadow-sm h-100 position-relative card-feature" style="background-image: url(/img/next/shield.svg);
    background-position: -10% 101%;
    background-repeat: no-repeat;">

                    <div class="card-body d-flex flex-column p-5">

                        <div class="mb-auto">
                            <p class="h2 mb-3">Permissions</p>

                            <p>
                                Manage user permissions and ensure application security effortlessly.
                                Backed by an intuitive interface, it's easy to set up and manage roles, without complex coding or external plugins.
                            </p>
                        </div>


                        <div class="mt-auto">
                            <a href="/en/docs/access" class="link-secondary text-end d-block stretched-link text-decoration-none link-more">
                                Learn about Permissions

                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-12 col-lg-6 col-xl-4">
                <div class="card shadow-sm h-100 position-relative card-feature" style="background-image: url(/img/next/attachments.svg);
    background-position: 50% 70%;
    background-repeat: no-repeat;">

                    <div class="card-body d-flex flex-column p-5">

                        <div class="mb-auto">
                            <p class="h2 mb-3">Attachments</p>

                            <p>
                                Easily attach any file format or extension to a specific record with our flexible attachment feature.
                                Keep your important data organized and streamline your workflow by attaching files to any model in your application.
                            </p>
                        </div>


                        <div class="mt-auto">
                            <a href="/en/docs/attachments" class="link-secondary text-end d-block stretched-link text-decoration-none link-more">
                                Learn about Attachment

                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-4">
                <div class="card shadow-sm h-100 position-relative card-feature" style="background-image: url(/img/next/draw.svg);
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: contain;">

                    <div class="card-body d-flex flex-column p-5">

                        <div class="mb-auto">
                            <p class="h2 mb-3">Design Guidelines</p>

                            <p>
                                Investing in a good user experience not only increases employee engagement, but also prevents expensive mistakes.
                                That's why we place a high priority on providing detailed documentation to assist you in creating exceptional apps.
                            </p>
                        </div>


                        <div class="mt-auto">
                            <a href="/en/hig" class="link-secondary text-end d-block stretched-link text-decoration-none link-more">
                                Read documentation

                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-4">
                <div class="card shadow-sm h-100 position-relative card-feature">

                    <img src="/img/next/feature3-tentacli.svg" class="d-none d-md-block pe-none position-absolute" style="
    top: 16em;
    left: -1.8em;
    height: 10em;">

                    <div class="card-body d-flex flex-column p-5">

                        <div class="mb-auto">
                            <p class="h2 mb-3">Never limited by the framework abstraction</p>

                            <p>
                                Relies entirely on browser and W3C standards, providing customization options to bring your vision to life.
                            </p>
                        </div>
                    </div>
                </div>
            </div>


<!--
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
                            <li>Scout Search</li>
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
                            <li>Form Builder</li>
                            <li>Localization</li>
                        </ul>
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>

    <div class="container">


        <div class="row align-items-center my-3 py-3 my-md-5 py-md-5">

            <div class="col-12 col-md-5">

                <h2 class="display-5 fw-bold px-3">Free & <span class="text-primary">Open Source</span>
                    <span class="d-block">for any purposes</span>
                </h2>
                <p class="lead px-lg-8 text-muted opacity-slow intersection px-3 text-balance">
                    Everything that we do is 100% composed of open and free code, jointly developed by people from all
                    over the world.
                </p>

                <a href="/en/license" class="link-secondary d-block text-decoration-none link-more px-3">View License
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                    </svg>
                </a>
                
            </div>

            <div class="d-none d-md-block col-md-7">
                <x-contributors/>
            </div>
        </div>
    </div>

    {{--
    <div class="bg-white text-dark bottom-union">


        <div class="container pt-5">


            <div class="px-md-4 py-5 text-md-center text-dark">
                <div class="col-lg-6 mx-auto">
                    <h2 class="display-5 fw-bold px-3">Hear from <span class="text-primary">satisfied</span> users</h2>
                    <p class="lead px-lg-8 opacity-slow intersection px-3">
                        See how Orchid has helped developers like you create top-quality applications with minimal effort.
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
--}}

{{--
    <div class="bg-white text-dark top-union pb-5 pt-5">

        <div class="container py-5 mb-5">
            <div class="row flex-lg-row-reverse align-items-center">
                <div class="d-none d-md-block col-12 col-sm-8 col-lg-6">
                    <img src="/img/next/unbox.svg" class="d-block mx-auto img-fluid" alt="Open Source" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3 text-md-start px-3">Explore Orchid <span class="text-primary">Now!</span></h1>
                    <p class="lead mx-auto ms-md-0 opacity-slow intersection px-3">
                        Join our community-driven journey and support Laravel Orchid's innovation. Your passion and generosity fuel our progress.
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
--}}


@endsection
