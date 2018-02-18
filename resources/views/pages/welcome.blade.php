@extends('layouts.app')

@section('title','Laravel Admin Panel')
@section('description','Simple Laravel Admin panel and CMS')


@section('content')



    <section class="container-fluid hidden-xs">
        <div class="row">
            <div style="background: url('/img/hero10.jpg') center center/cover;">
                <div class="wrapper-xl bg-black-opacity bg-dark min-h-h pos-rlt  text-ellipsis">
                    <div class="row  m-t-xxl m-b-xxl">
                        <div class="container m-t-md top-desc-block">
                            <div class="col-xs-12">
                                <div class="page-hero-content">
                                    <h1 class="font-thin m-t-n l-h-1x padder-v text-white">
                                        Laravel
                                        <span class="main-typed-element text-primary">{{trans('welcome.title')}}}}</span>
                                    </h1>
                                    <p class="text-white">
                                        ORCHID - платформа с открытым исходным кодом для быстрой разработки <br>корпоративных приложений и систем управления контентом с помощью Laravel
                                    </p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>







    <div class="bg-white b-b">
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






    <div id="features" class="bg-white-only box-shadow">

        <div class="container">

            <div class="row m-t-md m-b-md">
                <div class="w-xxl center">
                    <div class="page-header text-center">
                        <h2 class="font-thin text-black">Ценности проекта</h2>
                    </div>
                </div>
            </div>
            <div class="v-center">
                <article class="col-md-4">
                    <figure class="text-center padder-v">
                        <p class="text-primary"> Идеальный для дизайнеров</p>
                        <figcaption class="w-lg center-block">
                            <small>
                                Мы формируем в особых экономических зонах новые территории экономического развития и социального
                                роста для последующего масштабирования в рамках всей страны.
                            </small>
                        </figcaption>
                    </figure>
                </article>
                <article class="col-md-4">
                    <figure class="text-center padder-v">
                        <p class="text-primary"> Идеальный для дизайнеров</p>
                        <figcaption class="w-lg center-block">
                            <small>
                                Мы формируем в особых экономических зонах новые территории экономического развития и социального
                                роста для последующего масштабирования в рамках всей страны.
                            </small>
                        </figcaption>
                    </figure>
                </article>
                <article class="col-md-4">
                    <figure class="text-center padder-v">
                        <p class="text-primary"> Идеальный для дизайнеров</p>
                        <figcaption class="w-lg center-block">
                            <small>
                                Мы формируем в особых экономических зонах новые территории экономического развития и социального
                                роста для последующего масштабирования в рамках всей страны.
                            </small>
                        </figcaption>
                    </figure>
                </article>
            </div>

            <div class="row m-t-xl m-b-xxl">
                <div class="col-sm-6 fadeInLeft animated" data-ride="animated" data-animation="fadeInLeft" data-delay="300">
                    <div class="m-t-xxl">
                        <div class="m-b">
                            <a href="" class="pull-left thumb-sm avatar"><img src="https://pp.userapi.com/c840533/v840533409/492ec/Wif2-p_9zQc.jpg" alt="..."></a>
                            <div class="m-l-sm inline">
                                <div class="pos-rlt wrapper b b-light r r-2x">
                                    <span class="arrow left pull-up"></span>
                                    <p class="m-b-none">Привет, какая админка для Laravel лучшая?</p>
                                </div>
                                <small class="text-muted"><i class="fa fa-ok text-success"></i> 1 час назад</small>
                            </div>
                        </div>
                        <div class="m-b text-right">
                            <a href="" class="pull-right thumb-sm avatar"><img src="https://pp.userapi.com/c840533/v840533409/492ec/Wif2-p_9zQc.jpg" class="img-circle" alt="..."></a>
                            <div class="m-r-sm inline text-left">
                                <div class="pos-rlt wrapper bg-primary r r-2x">
                                    <span class="arrow right pull-up arrow-primary"></span>
                                    <p class="m-b-none">Привет, попробуй ORCHID</p>
                                </div>
                                <small class="text-muted">31 минуту назад</small>
                            </div>
                        </div>
                        <div class="m-b">
                            <a href="" class="pull-left thumb-sm avatar"><img src="https://pp.userapi.com/c840533/v840533409/492ec/Wif2-p_9zQc.jpg" alt="..."></a>
                            <div class="m-l-sm inline">
                                <div class="pos-rlt wrapper b b-light r r-2x">
                                    <span class="arrow left pull-up"></span>
                                    <p class="m-b-none">Вау, это здорово. Я ни ктогда не был таким продуктивным</p>
                                </div>
                                <small class="text-muted"><i class="fa fa-ok text-success"></i> 2 минуты назад</small>
                            </div>
                        </div>
                        <div class="m-b text-right">
                            <a href="" class="pull-right thumb-sm avatar"><img src="https://pp.userapi.com/c840533/v840533409/492ec/Wif2-p_9zQc.jpg" class="img-circle" alt="..."></a>
                            <div class="m-r-sm inline text-left">
                                <div class="pos-rlt wrapper bg-primary r r-2x">
                                    <span class="arrow right pull-up arrow-primary"></span>
                                    <p class="m-b-none">Не могу дождаться, чтобы увидеть результат:)</p>
                                </div>
                                <small class="text-muted">1 минуту назад</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 wrapper-xl">
                    <p class="h3 l-h-1x text-dark  font-thin m-b-lg">Экономьте свое время с лучшими инструментами</p>

                    <ul class="list-unstyled  m-t-xl">
                        <li>
                            <i class="icon-check pull-left text-lg m-r m-t-sm text-primary"></i>
                            <p class="clear m-b-lg"><strong>Минимазация затрад</strong>, значимость этих проблем настолько очевидна, что постоянное информационно-пропагандистское обеспечен.</p>
                        </li>
                        <li>
                            <i class="icon-check pull-left text-lg m-r m-t-sm text-primary"></i>
                            <p class="clear m-b-lg"><strong>Минимазация затрад</strong>, значимость этих проблем настолько очевидна, что постоянное информационно-пропагандистское обеспечен.</p>
                        </li>
                        <li>
                            <i class="icon-check pull-left text-lg m-r m-t-sm text-primary"></i>
                            <p class="clear m-b-lg"><strong>Минимазация затрад</strong>, значимость этих проблем настолько очевидна, что постоянное информационно-пропагандистское обеспечен.</p>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>



















    <div class="bg-white">

        <section  class="features b-t">
            <!--Container-->
            <div class="container m-t-xxl">
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
            <!--End container-->
        </section>
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
                    <a href="#" class="btn btn-lg btn-black btn-block center"><span class="icon-cloud-download m-r-xs"></span>Download GitHub</a>
                </div>

            </div>
        </div>
    </div>





@endsection
