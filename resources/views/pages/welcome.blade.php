@extends('layouts.app')

@section('title','Laravel Admin Panel')
@section('description','Simple Laravel Admin panel and CMS')


@section('content')


<section id="about" class="bg-white-only">
    <!--Container-->
    <div class="container">




        <div class="m-t-xxl m-b-xl">
            <h5 class="text-light">
               For Laravel Framework
            </h5>
            <div class="row v-center">
                <div class="col-md-5">
                    <h1 class="m-t-xs text-dark font-thin">
                        {!! trans('welcome.title')  !!}
                    </h1>
                </div>
                <div class="col-md-7 no-padder hidden-xs">
                    <div class="font-thin">
                        <p>
                            {!! trans('welcome.descriptions')  !!}
                        </p>
                        <div class="small col-md-8 no-padder">

                        <ul class="list-inline text-black text-right">
                            <li class="m-r-sm">
                                <i class="icon-eye m-r-xs"></i> {{$stats['github_watchers'] or '-'}}
                            </li>
                            <li class="m-r-sm">
                                <i class="icon-star m-r-xs"></i> {{$stats['github_stars'] or '-'}}
                            </li>
                            <li class="m-r-sm">
                                <i class="icon-cloud-download m-r-xs"></i> {{$stats['download'] or '-'}}
                            </li>
                        </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!--Row-->
        <div class="row m-t-xl m-b-xxl">
            <div class="col-md-4 col-sm-4">
                <div class="m-t-md m-b-md wrapper-lg  b">
                    <div class="ico column text-primary"><i class="icon-cloud-download"></i></div>
                    <div class="desc">
                        <h4 class="font-thin">{!! trans('welcome.promo.list_1.title') !!}</h4>
                        <p>
                            {!! trans('welcome.promo.list_1.descriptions') !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="m-t-md m-b-md wrapper-lg  b">
                    <div class="ico column text-primary"><i class="icon-layers"></i></div>
                    <div class="desc">
                        <h4 class="font-thin">{!! trans('welcome.promo.list_2.title') !!}</h4>
                        <p>
                            {!! trans('welcome.promo.list_2.descriptions') !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="m-t-md m-b-md wrapper-lg  b">
                    <div class="ico column text-primary"><i class="icon-server"></i></div>
                    <div class="desc">
                        <h4 class="font-thin">{!! trans('welcome.promo.list_3.title') !!}</h4>
                        <p>
                            {!! trans('welcome.promo.list_3.descriptions') !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--End row-->

    </div>
    <!--End container-->
</section>

{{--
<div class="bg-white hidden">
    <section  class="features b-t">
        <!--Container-->
        <div class="container">



            <!--feature border box start-->
            <div class="row m-b-xxl m-t-xxl">

                <div class="col-md-2">
                    <div class="padder-v text-right m-b-xl">
                        <div class="text-muted">
                            <i class="fa fa-user fa-3x"></i>
                        </div>
                        <div class="text-uppercase">
                            <h4 class="text-black font-thin">Экономия времени</h4>
                        </div>
                        <div class="text-muted font-thin">
                            Не беспокойтесь о стандартных функциях приложений
                        </div>
                    </div>
                    <div class="padder-v text-right">
                        <div class="text-muted">
                            <i class="fa fa-user fa-3x"></i>
                        </div>
                        <div class="text-uppercase">
                            <h4 class="text-black font-thin">Light Design</h4>
                        </div>
                        <div class="text-muted font-thin">
                            Простой внешний вид, построенный на готовых компонентах
                        </div>
                    </div>
                </div>
                <div class="col-md-8 text-center">
                    <div class="center   m-b-xxs">
                        <img src="https://user-images.githubusercontent.com/5102591/32980416-22ad653e-cc77-11e7-9fb9-4747b241270f.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="padder-v text-left m-b-xl">
                        <div class="text-muted">
                            <i class="fa fa-user fa-3x"></i>
                        </div>
                        <div class="text-uppercase">
                            <h4 class="text-black font-thin">Lorem ipsum</h4>
                        </div>
                        <div class="text-muted font-thin">
                            Самый простой и быстрый
                            способ создания веб-интерфейса для вашего
                            приборной панели или приложения.
                        </div>
                    </div>
                    <div class="padder-v text-left ">
                        <div class="text-muted">
                            <i class="fa fa-user fa-3x"></i>
                        </div>
                        <div class="text-uppercase">
                            <h4 class="text-black font-thin">Lorem ipsum</h4>
                        </div>
                        <div class="text-muted font-thin">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </div>
                    </div>
                </div>
            </div>
            <!--feature border box end-->
        </div>
    </section>
</div>
<div class="bg-white hidden">

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
                            <p class="h3 l-h-1x text-dark  font-thin m-b-lg">Экономьте свое время с лучшими инструментами</p>
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
                                <h4 class="m-b-md text-black">Сколько это стоит?</h4>
                                <p style="line-height: 25px;">ORCHID бесплатна, но мы ценим пожертвования.</p>
                            </div>

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
                <!--End row-->
            </div>
            <!--End container-->
        </section>
    </div>
--}}




<div class="bg-dark b-t">
    <div class="container">
        <div class="row m-t-xxl m-b-xxl v-center">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h3 class="text-white font-thin">{!! trans('welcome.feature.title') !!}</h3>
                        <p class="text-muted m-b-lg">
                            {!! trans('welcome.feature.descriptions') !!}
                        </p>
                    </div>
                </div>
                <div class="row">

                    <div class="wrapper">
                    <ul class="list-unstyled">
                        <li>
                            <i class="icon-check pull-left text-lg m-r m-t-sm text-primary"></i>
                            <p class="clear m-b-lg">
                                <strong class="text-white">{!! trans('welcome.feature.list_1.title') !!}</strong>
                                {!! trans('welcome.feature.list_1.descriptions') !!}
                            </p>
                        </li>
                        <li>
                            <i class="icon-check pull-left text-lg m-r m-t-sm text-primary"></i>
                            <p class="clear m-b-lg">
                                <strong class="text-white">{!! trans('welcome.feature.list_2.title') !!}</strong>
                                {!! trans('welcome.feature.list_2.descriptions') !!}
                            </p>
                        </li>
                        <li>
                            <i class="icon-check pull-left text-lg m-r m-t-sm text-primary"></i>
                            <p class="clear m-b-lg">
                                <strong class="text-white">{!! trans('welcome.feature.list_3.title') !!}</strong>
                                {!! trans('welcome.feature.list_3.descriptions') !!}
                            </p>
                        </li>
                        <li>
                            <i class="icon-check pull-left text-lg m-r m-t-sm text-primary"></i>
                            <p class="clear m-b-lg">
                                <strong class="text-white">{!! trans('welcome.feature.list_4.title') !!}</strong>
                                {!! trans('welcome.feature.list_4.descriptions') !!}
                            </p>
                        </li>

                    </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 hidden-xs"><pre class="bg-black"><code class="language-php">class Blog extends Many
{
    /**
     * @var string
     */
    public $name = 'Blog post';

    /**
     * @return array
     */
    public function fields() : array
    {
        return [
                    Field::tag('input')
                        ->type('text')
                        ->name('name')
                        ->max(255)
                        ->required()
                        ->title('Name Articles')
                        ->help('Article title'),
                ];
    }

}</code></pre>
            </div>
        </div>
    </div>
</div>



<div class="bg-white b-t hidden-xs">
    <div class="container">

        <div class="col-md-7">

            <div class="row m-t-xxl m-b-lg">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <p class="h2 text-black font-thin">  {!! trans('welcome.sponsor.title') !!}</p>
                    <p class="text-muted">
                        {!! trans('welcome.sponsor.descriptions') !!}
                    </p>
                </div>
            </div>

            <div class="row m-b-xxl v-center">
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
            <div class="row  m-t-xxl m-b-lg">
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
</div>


<section class="github pos-rlt no-overflow b-t hidden-xs">
    <div class="container h-full v-center">
        <div class="row w-full m-t-xxl m-b-xxl">
            <div class="col-lg-5">
                <div class="">
                    <img src="/img/github_logo.png" alt="" class="m-b-lg">
                    <p class="h3 l-h-1x text-dark font-thin m-b-lg"> {!! trans('welcome.github.title') !!}</p>
                    <p>
                        {!! trans('welcome.github.descriptions') !!}
                    </p>

                    <p class="padder-v">
                        <a href="https://github.com/orchidsoftware/platform" class="btn btn-lg btn-primary btn-rounded">
                            {{ trans('welcome.view_on_github') }}
                            <i class="icon-book-open m-l-xs" aria-hidden="true"></i>
                        </a>
                    </p>

                    <p class="text-muted m-t">
                        {!! trans('welcome.github.action') !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
        <img src="/img/github_browser.png" alt="" class="github_screenshot">
</section>




@endsection
