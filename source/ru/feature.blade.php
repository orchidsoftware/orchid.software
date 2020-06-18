@include('_lang.ru')
@extends('_layouts.master')

@section('content')


    <section class="bg-dark">
        <div class="container">

            <div class="row py-5 v-center">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="text-white font-thin">'welcome.feature.title'</h3>
                            <p class="text-muted m-b-lg">
                                'welcome.feature.descriptions'
                            </p>
                        </div>
                    </div>
                    <div class="row">

                        <div class="wrapper">
                            <ul class="list-unstyled">
                                <li>
                                    <i class="icon-check pull-left text-lg m-r m-t-sm text-primary"></i>
                                    <p class="clear m-b-lg">
                                        <strong class="text-white">'welcome.feature.list_1.title'</strong>
                                        'welcome.feature.list_1.descriptions'
                                    </p>
                                </li>
                                <li>
                                    <i class="icon-check pull-left text-lg m-r m-t-sm text-primary"></i>
                                    <p class="clear m-b-lg">
                                        <strong class="text-white">'welcome.feature.list_2.title'</strong>
                                        'welcome.feature.list_2.descriptions'
                                    </p>
                                </li>
                                <li>
                                    <i class="icon-check pull-left text-lg m-r m-t-sm text-primary"></i>
                                    <p class="clear m-b-lg">
                                        <strong class="text-white">'welcome.feature.list_3.title'</strong>
                                        'welcome.feature.list_3.descriptions'
                                    </p>
                                </li>
                                <li>
                                    <i class="icon-check pull-left text-lg m-r m-t-sm text-primary"></i>
                                    <p class="clear m-b-lg">
                                        <strong class="text-white">'welcome.feature.list_4.title'</strong>
                                        'welcome.feature.list_4.descriptions'
                                    </p>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 hidden-xs"><pre class="bg-black"><code class="language-php">namespace App\Orchid\Screens;

use Orchid\Screen\Screen;

class EmailSenderScreen extends Screen
{
    /**
     * Name and description properties are responsible for
     * what name will be displayed
     * on the user screen and in headlines.
     */
    public $name = 'EmailSenderScreen';

    /**
     * A method that defines all screen input data
     * is in it that database queries should be called,
     * api or any others (not necessarily explicit),
     * the result of which should be an array,
     * appeal to which his keys will be used.
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Identifies control buttons and events.
     * which will have to happen by pressing
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Set of mappings
     * rows, tables, graphs,
     * modal windows, and their combinations
     */
    public function layout(): array
    {
        return [];
    }
}</code></pre>
                </div>
            </div>
        </div>
    </section>



    <section class="bg-white b-t hidden-xs">
        <div class="container">

            <div class="col-md-7">

                <div class="row pt-5">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p class="h2 text-black font-thin">  'welcome.sponsor.title'</p>
                        <p class="text-muted">
                            'welcome.sponsor.descriptions'
                        </p>
                    </div>
                </div>

                <div class="row pb-5 v-center">
                    <div class="col-sm-6">
                        <a href="https://m.do.co/c/16c90d96a00c" target="_blank"><img src="/img/sponsors/do.png" class="img-responsive"></a>
                    </div>
                    <div class="col-sm-6">
                        <a href="https://www.jetbrains.com/phpstorm" target="_blank"><img src="/img/sponsors/JetBrains.png" class="img-responsive"></a>
                    </div>
                    <div class="col-sm-6">
                        <a href="http://laravel.su" target="_blank"><img src="/img/sponsors/laravelrus.png" style="height: 80px" class="img-responsive"></a>
                    </div>

                </div>

            </div>

            <div class="col-md-5">
                <div class="row">
                    <div class="col-sm-12 m-b-xl">
                        <h4 class="font-thin l-h-2x  m-b-lg">
                            <a href="https://twitter.com/themsaid/status/892387647733342208" target="_blank">
                                <em>“If you are looking for CMS package for your laravel project this package looks nice to me :)”</em>
                            </a>
                        </h4>
                        <p class="text-muted text-right">- <a href="https://twitter.com/themsaid/status/892387647733342208">Mohamed Said, First officer of Laravel</a></p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="bg-white border-top">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-10 col-md-offset-1">
                    <p class="h1 font-thin text-black">Our <span class="text-primary">Clients</span></p>

                    <div class="col-md-8 pull-in m-t-md">
                        <small>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  </small>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-1">

                    <div class="row">
                        <div class="col-md-2">
                            <a href="#" class="btn-opacity block">
                                <img src="https://raw.githubusercontent.com/orchidsoftware/orchid.software/master/source/assets/img/sponsors/JetBrains.png" class="img-fluid">
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="btn-opacity block">
                                <img src="/img/cms/2.png" class="img-responsive">
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="btn-opacity block">
                                <img src="/img/cms/3.png" class="img-responsive">
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="btn-opacity block">
                                <img src="/img/cms/4.png" class="img-responsive">
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="btn-opacity block">
                                <img src="/img/cms/5.png" class="img-responsive">
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="btn-opacity block">
                                <img src="/img/cms/6.png" class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


@endsection
