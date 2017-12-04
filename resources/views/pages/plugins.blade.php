@extends('layouts.app')


@section('content')


<div class="bg-white b-b box-shadow">


    <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h3 class="font-thin m-b-md">New Package</h3>
        <div class="row row-sm">
        @foreach($plugins as $plugin)

            <div class="col-xs-6 col-sm-3">
              <div class="item">
                <div class="pos-rlt">
                  <div class="item-overlay bg-black-opacity r r-2x">
                    <div class="center text-center m-t-n w-full">
                      <a href="{{$plugin->content['repository']}}" target="_blank">
                        <i class="fa fa-2x fa-github text-white"></i>
                      </a>
                    </div>
                  </div>
                  <a href="{{$plugin->content['repository']}}" target="_blank">
                    <img src="{{$plugin->content['info']['extra']['orchid']['image'] or ''}}" alt="" class="img-responsive r r-2x">
                  </a>
                </div>
                <div class="padder-v">
                  <a class="text-ellipsis" href="{{route('plugins.show',$plugin->slug)}}" target="_blank">
                    {{$plugin->content['description'] or ''}}
                  </a>
                  <a class="text-ellipsis text-xs text-muted" href="{{$plugin->content['repository']}}" target="_blank">
                    {{$plugin->content['name'] or ''}}
                  </a>
                </div>
              </div>
            </div>

          @endforeach
        </div>
      </div>
      <div class="col-md-5">
        <h3 class="font-thin m-b-md">Top Package</h3>
        <div class="list-group bg-white list-group-lg no-bg auto">
            @foreach($top as $key => $plugin)
              <a class="list-group-item clearfix" href="{{$plugin->content['repository']}}" target="_blank">
                <span class="pull-right h2 text-muted m-l">{{$key + 1}}</span>
                <span class="pull-left thumb-sm m-r">
                  <img src="{{$plugin->content['info']['extra']['orchid']['image'] or ''}}" class="r">
                </span>
                <span class="clear">
                  <span>{{$plugin->content['name'] or ''}}</span>
                  <small class="text-muted clear text-ellipsis"> {{$plugin->content['description'] or ''}}</small>
                </span>
              </a>
            @endforeach
        </div>
      </div>
    </div>
    </div>

</div>



<section class="bg-white">
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
