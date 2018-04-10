@extends('layouts.app')

@section('title','Laravel Admin Panel')
@section('description','Simple Laravel Admin panel and CMS')


@section('content')


    <div class="bg-white b-b hidden">
        <section class="bg-white  box-shadow-lg">
            <div class="container">
                <div class="row  m-t-xxl m-b-xxl v-center">
                    <div class="col-md-7 col-sm-12 col-xs-12 display-table sm-height-auto">
                        <div class="row">
                            <!-- section title -->
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h1 class="font-thin m-t-n l-h-1x padder-v text-black">
                                    Laravel
                                    <span class="main-typed-element text-primary">{{trans('welcome.title')}}}}</span>
                                </h1>
                                <p class="text-muted m-b-lg">
                                    {{trans('welcome.descriptions')}}
                                </p>
                            </div>
                            <!-- end section title -->
                        </div>
                        <!-- feature box -->
                        <div class="row two-column no-margin m-t-md">
                            <div class="col-md-6 col-sm-6 col-xs-12 padder-v">
                                <div class="col-md-3 col-xs-12 text-center  m-b-md">
                                    <p class="h3 inline b b-dark r-3x wrapper-sm">
                                        <i class=" w-1x icon-cloud-download text-primary"></i>
                                    </p>
                                </div>
                                <div class="col-md-8 col-xs-12 ">
                                    <p class="h4 text-black font-thin">{{trans('welcome.promo.list_1.title')}}</p>
                                    <div class="m-t-sm">
                                        <p class="small">{{trans('welcome.promo.list_1.descriptions')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 padder-v">
                                <div class="col-md-3 col-xs-12 text-center m-b-md">
                                    <p class="h3 inline b b-dark r-3x wrapper-sm">
                                        <i class=" w-1x icon-rocket text-primary"></i>
                                    </p>
                                </div>
                                <div class="col-md-8 col-xs-12">
                                    <p class="h4 text-black font-thin">{{trans('welcome.promo.list_2.title')}}</p>
                                    <div class="m-t-sm">
                                        <p class="small">{{trans('welcome.promo.list_2.descriptions')}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 padder-v">
                                <div class="col-md-3 col-xs-12 text-center m-b-md">
                                    <p class="h3 inline b b-dark r-3x wrapper-sm">
                                        <i class=" w-1x icon-screen-desktop  text-primary"></i>
                                    </p>
                                </div>
                                <div class="col-md-8 col-xs-12 ">
                                    <p class="h4 text-black font-thin">{{trans('welcome.promo.list_3.title')}}</p>
                                    <div class="m-t-sm">
                                        <p class="small">{{trans('welcome.promo.list_3.descriptions')}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 padder-v">
                                <div class="col-md-3 col-xs-12 text-center m-b-md">
                                    <p class="h3 inline b b-dark r-3x wrapper-sm">
                                        <i class=" w-1x icon-support  text-primary"></i>
                                    </p>
                                </div>
                                <div class="col-md-8 col-xs-12 ">
                                    <p class="h4 text-black font-thin">{{trans('welcome.promo.list_4.title')}}</p>
                                    <div class="m-t-sm">
                                        <p class="small">{{trans('welcome.promo.list_4.descriptions')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end feature box -->
                    </div>
                    <div class="col-md-5 col-sm-5 hidden-xs">
                        <img class="img-responsive" src="/img/cms/7.png" alt="">
                    </div>
                </div>
            </div>
        </section>
    </div>



    <section id="about" class="bg-white-only b-b">
        <!--Container-->
        <div class="container">
            <!--Row-->
            <div class="row  m-t-xl">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 m-t-xl">
                    <div class="block-content text-center">

                        <h1 class="font-thin m-t-n m-b-md l-h-1x padder-v text-black">
                            Простая и гибкая<br>
                            <span class="main-typed-element text-primary">{{trans('welcome.title')}}}}</span> для Laravel
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
        </div>
        <!--End container-->
    </section>



    <div class="bg-white">
            <div class="container">
                <!--Row-->
                <div class="row vertical-align v-center m-t-xxl m-b-xxl">
                    <div class="hidden-xs col-md-5 col-sm-5 m-b-xxl">
                        <div class="block-shot b box-shadow-lg">
                            <img src="/img/monitor.png" class="img-responsive" alt="" style="
height: 600px;
    object-fit: none;
    object-position: top left;
">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-md-offset-1 col-sm-8 col-sm-offset-1  m-b-xxl">

                        <div class="col-md-12">
                            <h1 class="h2 text-black font-thin">Часто задаваемые вопросы</h1>
                        </div>
                        <div class="col-md-12  m-t-md ">
                            <div class="block-faq m-b-lg">
                                <h4 class="m-b-md text-black">Что такое ORCHID?</h4>
                                <p style="line-height: 25px;">
                                    ORCHID - это пакет для Laravel, который помогает при администрировании приложения,
                                    предоставляя только хороший набор инструментов, который будет востребован практически в каждом проекте.
                                </p>
                            </div>
                            <div class="block-faq  m-b-lg">
                                <h4 class="m-b-md text-black">Нужно ли использовать встроенные записи?</h4>
                                <p style="line-height: 25px;">
                                    Мы предполагаем, что большинство ваших записей будут сохранены в json, что позволит вам сделать перевод и универсальную структуру,
                                    но если есть жёсткие условия то, вы можете использовать классический CRUD самостоятельно , ORCHID не остановит вас.
                                </p>
                            </div>
                            <div class="block-faq  m-b-lg">
                                <h4 class="m-b-md text-black">Существуют дополнительные системные требования?</h4>
                                <p style="line-height: 25px;">Да, вам нужно расширение PHP для обработки изображений и поддержка json-типа выбранной базы данных.</p>
                            </div>

                            <div class="block-faq  m-b-lg">
                                <h4 class="m-b-md text-black">Сколько это стоит?</h4>
                                <p style="line-height: 25px;">ORCHID бесплатна, но мы ценим пожертвования.</p>
                            </div>
                        </div>


                    </div>
                </div>
                <!--End row-->
            </div>
    </div>


    <div class="bg-white b-t">
        <div class="container">
            <div class="row v-center m-b-md">
                <div class="col-md-7">
                    <div class="padder-v">
                        <h3 class="font-thin text-black">Загрузить ORCHID Platform</h3>
                        <div class="w-xxl b-b"></div>
                    </div>
                    <p class="padder-v small">Lasting change, stakeholders development Angelina Jolie world problem solving progressive. Courageous; social entrepreneurship change; accelerate resolve pursue these aspirations asylum.</p>
                </div>

                <div class="col-md-3 col-md-offset-2">
                    <a href="#" class="btn btn-lg btn-primary btn-rounded btn-block center"><span class="icon-cloud-download m-r-xs"></span>Download GitHub</a>
                </div>

            </div>
        </div>
    </div>

@endsection
