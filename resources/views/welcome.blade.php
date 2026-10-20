@extends('layout')

@section('body')
    <div class="hero">

        <div class="art">
            <img src="/img/next/menu-tentacli.svg" class="tentacle top" alt="">
            <img src="/img/next/main-tentacli-left.svg" class="tentacle left" alt="">
            <img src="/img/next/main-tentacli-right.svg" class="tentacle right" alt="">
        </div>

        <div class="masthead shell">
            <header class="header">
                @include('header-menu')
            </header>

            <div class="intro">
                <div class="copy">
                    <h1 class="display">Enhance Your
                        <span class="line">Laravel with Orchid</span>
                    </h1>
                    <p class="intro-text">
                        Build admin panels and business applications with Laravel Orchid.
                        Compose screens in PHP and focus on your application's features.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="screen-preview shell" id="product-preview">
        <a href="/img/next/screen.jpg" class="frame" aria-label="View full-size screenshot of the Orchid administration screen">
            <img src="/img/next/screen.jpg" width="2400" height="1600"
                 class="image" alt="Orchid administration screen">
            <span class="caption">View full-size screenshot</span>
        </a>
    </div>

    <div class="shell">
        <div class="section-intro">
            <div class="copy">
                <h2 class="section-title">
                    <span class="line">Say <span class="text-accent">goodbye</span></span>
                    <small class="line">to Tedious Development</small>
                </h2>

                <p class="section-description">
                    Stop wasting time building admin panels from scratch. Orchid simplifies the process, letting you focus on what matters most — your application's core features.
                </p>
            </div>
        </div>

        <div class="feature-grid">

            <div class="feature-item">
                <x-quick-start/>
            </div>
            <div class="feature-item wide">
                <div class="card feature split screens">

                    <div class="layout">

                        <div class="content">
                        <div class="body">

                        <div class="copy">
                            <h3 class="heading">Screens</h3>

                            <p>
                                Build modern apps that are 80% in PHP, and spend less time fiddling with tools and updating incompatible libraries.
                                Focus on what matters most: creating exceptional features for your users.
                            </p>
                        </div>

                        <div class="actions">

                            <a href="/en/docs/screens" class="action link">
                                Learn About Screens

                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </a>

                        </div>
                    </div>
                        </div>

                        <div class="code">
                            @php
                                echo \Str::of('
```php
use Orchid\Screen\Screen;

class Task extends Screen
{
    public function query(Task $task): array
    {
        return [
            \'task\' => $task
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make(\'task.name\')
                    ->title(\'Name\')
                    ->placeholder(\'Enter task name\')
                    ->help(\'The name of the task to be created.\'),
            ]),
        ];
    }
}
```
                                ')->trim()->markdown(extensions: [new \Laravelsu\Highlight\CommonMark\HighlightExtension()])
                            @endphp
                        </div>

                    </div>

                </div>
            </div>

            <div class="feature-item wide">
                <div class="card feature split">

                    <div class="layout">

                        <div class="content">
                            <div class="body">

                                <div class="copy">
                                    <h3 class="heading">UI components</h3>

                                    <p>
                                        Orchid offers a vast selection of stunning UI components, including form inputs, dialogs, data grids, and visualizations.
                                        These components can be easily extended, and you can even create compositions directly in your code.
                                    </p>
                                </div>

                                <div class="actions">

                                    <p class="caption">Browse components:</p>

                                    <a href="/en/docs/field" class="action component-link">
                                        Form Elements

                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>

                                    <a href="/en/docs/table" class="action component-link">
                                        Tables

                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>

                                    <a href="/en/docs/legend" class="action component-link">
                                        Legend

                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>

                                    <a href="/en/docs/charts" class="action component-link">
                                        Charts

                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>

                                    <a href="/en/docs/modals" class="action component-link">
                                        Modals

                                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </a>

                                </div>
                            </div>
                        </div>

                        <div class="illustration">
                            <div class="table">
                                <img src="/img/next/table.svg" class="table-image" alt="Orchid data table with filters and row actions" loading="lazy">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="feature-item">
                <div class="card feature permissions">

                    <div class="body">

                        <div class="copy">
                            <h3 class="heading">Permissions</h3>

                            <p>
                                Manage user permissions and ensure application security effortlessly.
                                Backed by an intuitive interface, it's easy to set up and manage roles, without complex coding or external plugins.
                            </p>
                        </div>

                        <div class="actions">
                            <a href="/en/docs/access" class="action link trailing">
                                Learn About Permissions

                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="feature-item">
                <div class="card feature attachments">

                    <div class="body">

                        <div class="copy">
                            <h3 class="heading">Attachments</h3>

                            <p>
                                Easily attach any file to a record with Orchid’s flexible attachment system. 
                                Keep your data organized and streamline workflows by associating files with any model in your app.
                            </p>
                        </div>

                        <div class="actions">
                            <a href="/en/docs/attachments" class="action link trailing">
                                Learn About Attachment

                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feature-item">
                <div class="card feature guidelines">

                    <div class="body">

                        <div class="copy">
                            <h3 class="heading">Design Guidelines</h3>

                            <p>
                                Investing in a good user experience not only increases employee engagement, but also prevents expensive mistakes.
                                That's why we place a high priority on providing detailed documentation to assist you in creating exceptional apps.
                            </p>
                        </div>

                        <div class="actions">
                            <a href="/en/hig" class="action link trailing">
                                Read Guideline

                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="feature-item">
                <div class="card feature framework">

                    <img src="/img/next/feature3-tentacli.svg" class="tentacle" alt="">

                    <div class="body">

                        <div class="copy">
                            <h3 class="heading">Never limited by the framework abstraction</h3>

                            <p>
                                Relies entirely on browser and W3C standards, providing customization options to bring your vision to life.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="shell">

        <div class="community">

            <div class="copy">

                <h2 class="section-title">Free & <span class="text-accent">Open Source</span>
                    <span class="line">for any purposes</span>
                </h2>
                <p class="section-description">
                    Everything that we do is 100% composed of open and free code, jointly developed by people from all
                    over the world.
                </p>

                <a href="/en/license" class="action">View License
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
                    </svg>
                </a>

            </div>

            <div class="contributors">
                <x-contributors/>
            </div>
        </div>
    </div>

@endsection
