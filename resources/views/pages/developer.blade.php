@extends('layouts.app')

@section('title','Developer')
@section('description','Developer')


@section('content')



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
