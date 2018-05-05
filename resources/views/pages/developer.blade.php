@extends('layouts.app')

@section('title','Developer')
@section('description','Developer')


@section('content')


    <style>


        .has-codeshell {
            height: 520px;
            overflow: hidden;
            max-width: 780px;
            margin: auto;
            position: relative;
        }


        .codeshell {
            background: #fff;
            border-radius: 5px;
            position: absolute;
            height: 320px;
            left: 0;
            right: 0;
            font-size: 14px;
        }
        .codeshell .disc {
            width: 11px;
            border-radius: 50%;
            height: 11px;
            margin: 0 2px;
        }

        .codeshell .codeshell-header {
            border-top-right-radius: 3px;
            border-top-left-radius: 4px;
            display: flex;
            align-items: center;
            padding-left: 4px;
            height: 27px;
        }

        .codeshell .codeshell-body {
            color: #f8f8f2;
            font-family: source-code-pro,Consolas,Monaco,Andale Mono,monospace;
            padding: 20px 20px 30px;
            height: 100%;
            font-size: 1.3rem;
        }

        <!-- Удалить -->
        .codeshell .codeshell-body .codeshell-action {
            color: #52fa7c;
            font-weight: 600;
        }
        .codeshell .codeshell-body .codeshell-title {
            color: #8be8fd;
            font-weight: 600;
            margin-top: 20px;
            position: relative;
            display: inline-block;
        }

</style>


    <div class="install bg-white">
        <div class="container">

            <div class="row m-t-xxl m-b-xl v-center">
                <div class="shrinked-container has-codeshell">
                    <div class="m-b-xl">
                        <h2 class="text-dark font-thin"> Laravel <span class="main-typed-element text-primary">{{trans('welcome.title')}}</span></h2>
                        <p class="m-t-md font-thin">AdonisJs is a Node.js web framework with a breath of fresh air and drizzle of elegant syntax on top of it. We prefer <strong>developer joy</strong> and <strong>stability</strong> over anything else.</p>
                    </div>
                    <div class="codeshell">
                        <div class="codeshell-header b bg-light">
                            <div class="disc bg-danger"></div>
                            <div class="disc bg-warning"></div>
                            <div class="disc bg-success"></div>
                        </div>
                        <div class="codeshell-body bg-dark">
                            <div class="codeshell-action">$ composer require orchid/platform</div>
                            <div>Crafting new application...</div>
                            <div>Application crafted! <span class="info">Build something awesome</span></div>
                            <div class="codeshell-title">adonisjs apps are packed with</div>
                            <div>------------------------------</div>
                            <ul>
                                <li> seamless authentication </li>
                                <li> SQL ORM, migrations and seeds </li>
                                <li> inbuilt support for i18n </li>
                                <li> first class testing support </li>
                                <li> moreover, written in plain javascript </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="bg-white b-t">
        <div class="container pos-rlt">
            <div class="row m-t-xxl m-b-xxl">
                <div class="col-lg-10">
                    <img src="https://wrappixel.com/demos/ui-kit/wrapkit-free/assets/images/features/feature30/img1.jpg" class="b box-shadow-lg img-responsive" alt="wrappixel"></div>
                <div class="col-lg-5 col-md-7 text-center wrap-feature-box pos-abt bottom-right" style="top: 30rem">
                    <div class="bg-white b box-shadow-lg">
                        <div class="wrapper-lg">
                            <h3 class="text-black font-thin">The New way of Making Your Website in mins</h3>
                            <p class="text-">You can relay on our amazing features list and also our customer services will be great experience. You will love it for sure.</p>
                            <a class="btn btn-primary btn-rounded btn-sm" href="#"><span>Explore More <i class="ti-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--
    <div class="bg-black-opacity">
        <section class="container-fluid hidden-xs">
            <div class="row">
                <div style="background: url('/img/header.jpg') center center;background-size: cover;">
                    <div class="wrapper-xl bg-black-opacity bg-dark min-h-h pos-rlt  text-ellipsis">
                        <div class="row  m-t-xxl m-b-xxl">
                            <div class="container m-t-md top-desc-block">
                                <div class="col-xs-12">
                                    <div class="page-hero-content">

                                        <h1 class="font-thin m-t-n l-h-1x padder-v text-white">
                                            Laravel фреймворк <br> нового поколения
                                        </h1>

                                        <p class="text-white small">
                                            Мы верим, что процесс разработки только тогда наиболее продуктивен,<br>
                                            когда работа с фреймворком приносит радость и удовольствие.<br>
                                            Счастливые разработчики пишут лучший код.


                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    --}}



    <div class="bg-white">
        <div class="container">
            <!--Row-->
            <div class="row m-b-xxl">

                <div class="col-md-12">
                    <h3 class="font-thin text-black text-center m-b-lg m-t-xl">What's next?</h3>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="m-t-md m-b-md wrapper-lg  b">
                        <div class="ico column text-primary"><i class="icon-energy"></i></div>
                        <div class="desc">
                            <h4 class="font-thin">Tutorials</h4>
                            <p>
                                Build a simple app in minutes. Master advanced concepts and techniques
                            </p>
                            <p class="text-right">
                                <a href="#" class="small">Start now <i class="icon-right m-l-xs"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="m-t-md m-b-md wrapper-lg  b">
                        <div class="ico column text-primary"><i class="icon-direction"></i></div>
                        <div class="desc">
                            <h4 class="font-thin">Guide</h4>
                            <p>
                                The best practices for creating applications based on the ORCHID platform
                            </p>
                            <p class="text-right">
                                <a href="#" class="small">Read now <i class="icon-right m-l-xs"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="m-t-md m-b-md wrapper-lg  b">
                        <div class="ico column text-primary"><i class="icon-notebook"></i></div>
                        <div class="desc">
                            <h4 class="font-thin">Documentation</h4>
                            <p>
                                Reference documentation to discover everything Meteor has to offer
                            </p>
                            <p class="text-right">
                                <a href="#" class="small">Explore now <i class="icon-right m-l-xs"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--End row-->
        </div>
    </div>



    <div class="bg-white b-b">
        <div class="container">
            <div class="row m-t-xxl m-b-xxl v-center">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="text-black font-thin">Simple CRUD Systems</h3>
                            <p class="text-muted m-b-lg">
                                Build complex dialogs with an ease
                            </p></div>
                    </div>
                    <div class="row m-t">

                        <ul class="list-group  no-borders">
                            <li class="list-group-item"><i class="icon-check pull-left text-lg m-r text-primary"></i>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            </li>
                            <li class="list-group-item"><i class="icon-check pull-left text-lg m-r text-primary"></i>
                                Ut fermentum tincidunt risus, egestas laoreet felis porttitor ut.
                            </li>
                            <li class="list-group-item"><i class="icon-check pull-left text-lg m-r text-primary"></i>
                                Nulla vitae ex non nibh venenatis faucibus. Curabitur vel sapien mauris. Phasellus pretium placerat tellus quis hendrerit.
                            </li>
                            <li class="list-group-item"><i class="icon-check pull-left text-lg m-r text-primary"></i>
                                Quisque quis purus nunc. Maecenas tellus lectus, viverra ut nisl sed, posuere consequat dui.
                            </li>
                            <li class="list-group-item"><i class="icon-check pull-left text-lg m-r text-primary"></i>
                                Curabitur ut cursus neque, ut maximus tortor. Fusce dictum dapibus viverra.
                            </li>
                                                        <li class="list-group-item"><i class="icon-check pull-left text-lg m-r text-primary"></i>
                                Quisque quis purus nunc. Maecenas tellus lectus, viverra ut nisl sed, posuere consequat dui.
                            </li>
                            <li class="list-group-item"><i class="icon-check pull-left text-lg m-r text-primary"></i>
                                Curabitur ut cursus neque, ut maximus tortor. Fusce dictum dapibus viverra.
                            </li>
                                                        <li class="list-group-item"><i class="icon-check pull-left text-lg m-r text-primary"></i>
                                Quisque quis purus nunc. Maecenas tellus lectus, viverra ut nisl sed, posuere consequat dui.
                            </li>
                            <li class="list-group-item"><i class="icon-check pull-left text-lg m-r text-primary"></i>
                                Curabitur ut cursus neque, ut maximus tortor. Fusce dictum dapibus viverra.
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-md-6 hidden-xs">
                    <pre class="bg-black">
                        <code class="language-php">
class Blog extends Many
{
    /**
     * @var string
     */
    public $name = 'Blog post';

    /**
     * Grid View for post type.
     */
    public function grid() : array
    {
        return [];
    }

    /**
     * @return array
     */
    public function fields() : array
    {
        return [];
    }

    /**
     * @return array
     */
    public function modules() : array
    {
        return [];
    }
}</code>
                    </pre>
                </div>
            </div>
        </div>
    </div>


    <div class="bg-white">
            <div class="container">
            <div class="row m-t-xxl m-b-xxl b-b r-2x b-2x b-primary" style="box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);">
                    <div class="col-md-6 col-xs-12 sm-text-center">
                        <h3 class="text-black font-thin">Interested in new themes and discounts?</h3>
                        <p class="text-muted">We'll notify you and promise never to spam.</p>
                    </div>
                    <div class="col-md-6 col-xs-12 sm-text-center">
                        <div class="form-group form-group-default m-t-xl">
                            <label>Your email here</label>
                            <div class="controls">
                                <input type="text" placeholder="Your email here..." class="form-control">
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>



    <div class="">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <div class="padder-v m-t-xxl">
                        <h2 class="font-thin m-t-n l-h-1x m-b-sm text-black">
                            Code once, run everywhere
                        </h2>
                        <div class="w-xxl b-b"></div>
                        <p class="text-muted m-t-md">
                            Single API for all supported platforms
                        </p>
                    </div>

                </div>
            </div>

            <div class="row m-t-md m-b-xl text-center">
                <div class="col-sm-3 "><p class="h3 m-b-xl inline b b-dark r-3x wrapper-lg"><i
                                class=" w-1x icon-book-open"></i></p>
                    <div class="m-b-xl">
                        <h3 class="m-t-none font-thin l-h-1x">
                            Документация
                        </h3>
                        <p class="text-muted m-t-lg">
                            Get a basic app running, built, and ready for distribution with our Getting Started guide
                        </p>
                    </div>
                </div>
                <div class="col-sm-3"><p class="h3 m-b-xl inline b b-dark r-3x wrapper-lg"><i
                                class="w-1x icon-layers"></i></p>
                    <div class="m-b-xl">
                        <h3 class="m-t-none font-thin l-h-1x">
                            Дизайн
                        </h3>
                        <p class="text-muted m-t-lg">Learn about the design principles that make up apps on Lorem ipsum dolor sit amet consectetur.</p></div>
                </div>
                <div class="col-sm-3"><p class="h3 m-b-xl inline b b-dark r-3x wrapper-lg"><i
                                class="w-1x icon-question"></i></p>
                    <div class="m-b-xl"><h3 class="m-t-none font-thin l-h-1x">
                            Материалы
                        </h3>
                        <p class="text-muted m-t-lg">Get more info about code style, reporting issues, and proposing design changes</p></div>
                </div>
                <div class="col-sm-3"><p class="h3 m-b-xl inline b b-dark r-3x wrapper-lg"><i
                                class="w-1x icon-bubbles"></i></p>
                    <div class="m-b-xl">
                        <h3 class="m-t-none font-thin l-h-1x text-black">
                            Чат
                        </h3>
                        <p class="text-muted m-t-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam porta eget nulla sit amet convallis.</p></div>
                </div>
            </div>
        </div>
    </div>



    <section class="text-center b-t bg-white">
        <!--Container-->
        <div class="container">


            <!--Row-->
            <div class="row m-t-xxl m-b-xxl">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center">
                    <h3 class="font-thin text-black">Сделать вклад</h3>
                    <div class="w-xxl b-b center"></div>
                    <p class="lead not-mb m-t-md">
                        Я призываю всех внести свой вклад в проект ORCHID. <br>Вы можете найти последнюю версию кода GitHub на странице
                        <a href="https://github.com/orchidsoftware" target="_blank">https://github.com/orchidsoftware</a>.
                    </p>
                </div>
            </div>
            <!--End row-->
        </div>
        <!--End container-->
    </section>

@endsection
