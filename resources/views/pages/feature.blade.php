@extends('layouts.app')


@section('content')

    {{--
    <div class="bg-black-opacity">
        <section class="container-fluid hidden-xs">
            <div class="row">
                <div style="background: url('/img/header3.jpg') top center;background-size: cover;">
                    <div class="wrapper-xl bg-black-opacity bg-dark min-h-h pos-rlt  text-ellipsis">
                        <div class="row  m-t-xxl m-b-xxl">
                            <div class="container m-t-md top-desc-block">
                                <div class="col-xs-12">
                                    <div class="page-hero-content">

                                        <h1 class="font-thin m-t-n l-h-1x padder-v text-white">
                                            Простая и гибкая<br>
                                            панель управления для Laravel
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

    <section id="about" class="bg-white-only">
        <!--Container-->
        <div class="container">
            <!--Row-->
            <div class="row m-t-xl">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 m-t-xl">
                    <div class="block-content text-center">
                        <h1 class="title m-b-md text-dark" style="font-weight: 300;">Простая и гибкая<br>
                                                                                     панель управления для Laravel
                        </h1>
                        <p class="lead">
                            Платформа, которая растет вместе с вами не мешает и позволяет вам использовать ваши любимые технологии легко создавать необходимые функции.
                        </p>
                    </div>
                </div>
            </div>
            <!--End row-->
            <!--Row-->
            <div class="row m-t-xxl">
                <div class="col-md-4 col-sm-4">
                    <div class="m-t-md m-b-md wrapper-lg  b">
                        <div class="ico column text-primary"><i class="icon-cloud-download"></i></div>
                        <div class="desc">
                            <h4 class="font-thin">Простота установки</h4>
                            <p>
                                Установка пакета с помощником композитора и шаг за шагом делает процесс простым и понятным
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="m-t-md m-b-md wrapper-lg  b">
                        <div class="ico column text-primary"><i class="icon-layers"></i></div>
                        <div class="desc">
                            <h4 class="font-thin">Расширяемый</h4>
                            <p>
                                Вы можете установить свои любимые пакеты или написать свой собственный набор функций, которые будут следовать за вами в ваших приложениях
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="m-t-md m-b-md wrapper-lg  b">
                        <div class="ico column text-primary"><i class="icon-globe"></i></div>
                        <div class="desc">
                            <h4 class="font-thin">Локализация</h4>
                            <p>
                                Вы можете использовать панель на вашем родном языке или создавать приложения с поддержкой нескольких языков перевода
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--End row-->
            <!--Row-->
            <div class="row m-b-xxl">
                <div class="col-md-4 col-sm-4">
                    <div class="m-t-md m-b-md wrapper-lg  b">
                        <div class="ico column text-primary"><i class="icon-screen-desktop"></i></div>
                        <div class="desc">
                            <h4 class="font-thin">Light Design</h4>
                            <p>
                                Простота и удобство конструкции позволяют разработчикам не думать о внешнем виде своих приложений
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="m-t-md m-b-md wrapper-lg  b">
                        <div class="ico column text-primary"><i class="icon-rocket"></i></div>
                        <div class="desc">
                            <h4 class="font-thin">Экономит время</h4>
                            <p>
                                Вам не нужно беспокоиться о стандартных функциях приложений, сосредоточить внимание только на основные преимущества
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="m-t-md m-b-md wrapper-lg  b">
                        <div class="ico column text-primary"><i class="icon-support"></i></div>
                        <div class="desc">
                            <h4 class="font-thin">Большая поддержка</h4>
                            <p>
                                Реализация платной поддержки проектов компаний или открытых вопросов на GitHub и помощь сообщества Laravel
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--End row-->

            <div class="row m-t-lg m-b-lg">
                <div class="col-md-8 col-md-offset-2">
                    <div class="col-sm-6">
                        <div class="bg-white wrapper-md r">
                            <a href="#">
                                <span class="h4 m-b-xs block"><i class=" icon-user-follow m-r-sm"></i> Login or Create account</span>
                                <span class="text-muted">Get free musics when you logged in, and give your comments to them.</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="bg-info dker wrapper-md r">
                            <a href="#">
                                <span class="h4 m-b-xs block"><i class="icon-cloud-download  m-r-sm"></i> Download our app</span>
                                <span class="text-muted">Get the apps for desktop and mobile to start listening music at anywhere and anytime.</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--End container-->
    </section>

@stop
