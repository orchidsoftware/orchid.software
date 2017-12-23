@extends('layouts.app')


@section('content')
<style>

    #packages-list img{
        max-height : 200px;
        margin: 0 auto;
    }

</style>


<header class="bg-black text-white">
    <div class="container text-center">
    <div class="padder-v m-b-lg">
        <h1 class="font-thin padder-v">Packages</h1>

            <p class="">
                Extend your ORCHID experience with {{$count}} packages.
            </p>

        <div class="v-center">
        <div class="flipkart-navbar-search smallsearch w-xxl">
                <div class="row">
                    <input class="flipkart-navbar-input col-xs-10" type="text" required placeholder="Поиск..." name="">
                    <button class="flipkart-navbar-button btn btn-default col-xs-2">
                        <svg width="15px" height="15px">
                            <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>




                    </div><!-- .site-branding -->
    </div>
</header>



<div id="packages-list" class="bg-white b-b box-shadow">


    <div class="container">
        <div class="row m-b-lg m-t-lg">

        <h3 class="font-thin text-black m-b-md">Most Popular</h3>

        <div class="row">
             @foreach($top as $plugin)

            <div class="col-xs-12 col-sm-4">
              <div class="item wrapper-md">
                <div class="pos-rlt">
                  <div class="item-overlay bg-white-opacity r r-2x">
                    <div class="center text-center m-t-n w-full">
                      <a href="{{$plugin->content['repository']}}" target="_blank">
                        <i class="fa fa-2x fa-github text-black"></i>
                      </a>
                    </div>
                  </div>
                  <a href="{{$plugin->content['repository']}}" target="_blank">
                    <img src="{{$plugin->content['info']['extra']['orchid']['image'] or 'https://orchid.software/img/cms/3.png'}}" alt="" class="img-responsive r r-2x">
                  </a>
                </div>
                <div class="padder-v">
                  <a class="text-ellipsis" href="{{route('plugins.show',$plugin->slug)}}" target="_blank">
                    {{$plugin->content['description'] or ''}}
                  </a>
                  <a class="text-ellipsis text-xs text-muted" href="{{$plugin->content['repository']}}" target="_blank">
                    {{$plugin->content['name'] or ''}}
                  </a>
                                        <p>
                        {{$plugin->content['github_stars'] or ''}}
                                            {{$plugin->content['downloads']['total'] or ''}}
                    </p>
                </div>
              </div>
            </div>

            @endforeach
        </div>
    </div>

        <div class="row m-b-lg m-t-lg">

        <h3 class="font-thin text-black m-b-md">New Packages</h3>

        <div class="row">
             @foreach($last as $plugin)

                <div class="col-xs-12 col-sm-4">
              <div class="item wrapper-md">
                <div class="pos-rlt">
                  <div class="item-overlay bg-white-opacity r r-2x">
                    <div class="center text-center m-t-n w-full">
                      <a href="{{$plugin->content['repository']}}" target="_blank">
                        <i class="fa fa-2x fa-github text-black"></i>
                      </a>
                    </div>
                  </div>
                  <a href="{{$plugin->content['repository']}}" target="_blank">
                    <img src="{{$plugin->content['info']['extra']['orchid']['image'] or 'https://orchid.software/img/cms/3.png'}}" alt="" class="img-responsive r r-2x">
                  </a>
                </div>
                <div class="padder-v">
                  <a class="text-ellipsis" href="{{route('plugins.show',$plugin->slug)}}" target="_blank">
                    {{$plugin->content['description'] or ''}}
                  </a>
                  <a class="text-ellipsis text-xs text-muted" href="{{$plugin->content['repository']}}" target="_blank">
                    {{$plugin->content['name'] or ''}}
                  </a>
                                        <p>
                        {{$plugin->content['github_stars'] or ''}}
                                            {{$plugin->content['downloads']['total'] or ''}}
                    </p>
                </div>
              </div>
            </div>

            @endforeach
        </div>
    </div>


    </div>

</div>







<section class="bg-white hidden">
        <div class="container-fluid">

            <div class="row box-shadow-lg">

                <div class="container">

                    <div class="row wrapper-lg">
                        <div class="col-md-12">
                            <p class="h1 font-thin text-black">Как добавить своё <span class="text-primary">Расширение</span>?</p>

                            <div class="col-md-8 pull-in m-t-md  text-justify">
                                <small>
                                    Уважаемые исполнители - зарабатывать с нами легко и удобно. Здесь размещают любые студенческие заказы: рефераты, курсовые, дипломные, контрольные и другие работы.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row wrapper-lg">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-xs-12 col-sm-3  font-thin">
                                    <div class="h3 text-primary b-b b-primary padder-v font-thin">
                                        1. Заказать
                                    </div>
                                    <div class=" text-muted m-t-md l-h-1x">
                                        <strong>Сайт бесплатно разошлёт ваш заказ исполнителям</strong>
                                        <p>А исполнители предложат цены. Это удобнее, чем искать кого-то по интернету. Тем более если у вас срочный заказ студенческой работы. Оформите заявку и узнайте стоимость работы уже сегодня.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3  font-thin">
                                    <div class="h3 text-primary b-b b-primary padder-v font-thin">
                                        2. Выбрать
                                    </div>
                                    <div class=" text-muted m-t-md l-h-1x">
                                        Выберите исполнителя по цене и отзывам
                                        С выбранным исполнителем вы сможете связаться в любое время и узнать о ходе выполнения. Кроме того, вы сможете получать работу по частям — так вы будете уверены, что работа идёт в нужном русле.
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3  font-thin">
                                    <div class="h3 text-primary b-b b-primary padder-v font-thin">
                                        3. Оплатить
                                    </div>
                                    <div class=" text-muted m-t-md l-h-1x">
                                        Получите выполненный заказ и отправьте преподавателю
                                        На все выполненные работы мы даём гарантию. После защиты работы вы сможете оставить исполнителю отзыв. Теперь вы знаете, почему стоит заказывать студенческие работы на сайте помощи студентам.
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3  font-thin">
                                    <div class="h3 text-primary b-b b-primary padder-v font-thin">
                                        4. Скачать
                                    </div>
                                    <div class=" text-muted m-t-md l-h-1x">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis .
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                </div>


            </div>

        </div>
    </section>


@endsection
