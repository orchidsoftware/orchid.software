@extends('layouts.app')

@section('title',$article->getContent('title'))
@section('description',$article->getContent('description'))
@section('keywords',$article->getContent('keywords'))
@section('image',config('app.url').$article->hero('high'))


@section('content')


<div class="m-t-md m-b-md">
<div class="container bg-white b box-shadow m-b-xl">
    <div class="row">


      <div class="col-md-9">


          <main class="wrapper">


              <div class="page-header">

                  <h1 class="text-black">
                         {{ $article->getContent('name') }}
                  </h1>

              </div>

              <div>
                  <img src="{{$article->hero('medium') ?? '/img/no-image.jpg'}}" class="img-full">
              </div>

              <div>
                  {!! $article->getContent('body') !!}
              </div>


              <div class="wrapper-md b-t">

                  <div class="row v-center">


                      <div class="col-sm-6 col-xs-12">


                          <div class="meta-tags">
                              <a href="#" rel="tag">Шугар Рэй Леонард</a> / <a href="#" rel="tag">Томас
                              Хёрнс</a> / <a href="#" rel="tag">Риддик Боу</a> / <a href="#" rel="tag">Рафаэль
                              Маркез Артуро Гатти</a> / <a href="#" rel="tag">Микки Уорд</a>
                          </div>

                      </div>

                      <div class="col-sm-6 text-right hidden-xs" role="group" aria-label="Social Links">

                          <a onclick="popupCenter('http://vk.com/share.php?url=http://localhost:8001/catalog/festivals/klassicheskiy-tekst-lorem-ipsum-ispolzuemyy-s-xvi-veka-1', '',600,400);" href="javascript:void(0);" class="btn btn-icon btn-rounded btn-dark"><i class="fa fa-google"></i></a>

                          <a onclick="popupCenter('http://www.ok.ru/dk?st.cmd=addShare&amp;st.s=1&amp;st._surl=http://localhost:8001/catalog/festivals/klassicheskiy-tekst-lorem-ipsum-ispolzuemyy-s-xvi-veka-1', '',600,400);" href="javascript:void(0);" class="btn btn-icon btn-rounded btn-dark"><i class="fa fa-facebook"></i></a>

                          <a onclick="popupCenter('http://www.facebook.com/sharer.php?u=http://localhost:8001/catalog/festivals/klassicheskiy-tekst-lorem-ipsum-ispolzuemyy-s-xvi-veka-1', '',600,400);" href="javascript:void(0);" class="btn btn-icon btn-rounded btn-dark"><i class="fa fa-twitter"></i></a>

                          <a onclick="popupCenter('https://plus.google.com/share?url=http://localhost:8001/catalog/festivals/klassicheskiy-tekst-lorem-ipsum-ispolzuemyy-s-xvi-veka-1', '',600,400);" href="javascript:void(0);" class="btn btn-icon btn-rounded btn-dark"><i class="fa fa-vk"></i></a>

                          <a onclick="popupCenter('https://twitter.com/share?url=http://localhost:8001/catalog/festivals/klassicheskiy-tekst-lorem-ipsum-ispolzuemyy-s-xvi-veka-1', '',600,400);" href="javascript:void(0);" class="btn btn-icon btn-rounded btn-dark"><i class="fa fa-odnoklassniki"></i></a>
                      </div>
                  </div>
              </div>


          </main>


          <div class="wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <p class="h3 font-thin text-black m-b-lg">Смотрите <span class="text-primary">Так же</span></p>
                      <div class="row">
                          <article class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                              <div class="item">
                                  <div class="pos-rlt">
                                      <div class="top">
                                          <span class="badge bg-danger m-l-sm m-t-sm">04:10</span>
                                      </div>
                                      <div class="item-overlay bg-black-opacity r r-2x r r-2x">
                                          <div class="center text-center m-t-n w-full">
                                              <a><i class="icon-control-play text-2x text-white"></i></a>
                                          </div>
                                      </div>
                                      <a href="#">
                                          <img src="http://allboxing.ru/sites/default/files/styles/news_page_illustrate/public/102014-ufc-tonight-daniel-cormier-jw-pi_0.jpg?itok=I0-GnmBT" alt="" class="img-full r r-2x">
                                      </a>
                                  </div>
                                  <div class="padder-v">
                                      <a class="text-ellipsis" href="#">Даниэль Кормье: Стипе Миочич
                                          отправится спать в бою с Энтони Джошуа</a>
                                      <a class="text-ellipsis text-xs text-muted" href="#">Box</a>
                                  </div>
                              </div>
                          </article>
                          <article class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                              <div class="item">
                                  <div class="pos-rlt">
                                      <div class="top">
                                          <span class="badge bg-danger m-l-sm m-t-sm">04:10</span>
                                      </div>
                                      <div class="item-overlay bg-black-opacity r r-2x r r-2x">
                                          <div class="center text-center m-t-n w-full">
                                              <a><i class="icon-control-play text-2x text-white"></i></a>
                                          </div>
                                      </div>
                                      <a href="#">
                                          <img src="http://allboxing.ru/sites/default/files/styles/news_page_illustrate/public/hi-res-d4535e07edcc10a0e26c7bd35542fe9b_crop_north.jpg?itok=F8jlypjd" alt="" class="img-full r r-2x">
                                      </a>
                                  </div>
                                  <div class="padder-v">
                                      <a class="text-ellipsis" href="#">Хорхе Масвидал хочет реванш против
                                          Демиана Майи</a>
                                      <a class="text-ellipsis text-xs text-muted" href="#">Бои по смешанным
                                          правилам</a>
                                  </div>
                              </div>
                          </article>
                          <article class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                              <div class="item">
                                  <div class="pos-rlt">
                                      <div class="top">
                                          <span class="badge bg-danger m-l-sm m-t-sm">04:10</span>
                                      </div>
                                      <div class="item-overlay bg-black-opacity r r-2x r r-2x">
                                          <div class="center text-center m-t-n w-full">
                                              <a><i class="icon-control-play text-2x text-white"></i></a>
                                          </div>
                                      </div>
                                      <a href="#">
                                          <img src="http://allboxing.ru/sites/default/files/styles/news_page_illustrate/public/cirkunov.jpg?itok=cqqRNpY9" alt="" class="img-full r r-2x">
                                      </a>
                                  </div>
                                  <div class="padder-v">
                                      <a class="text-ellipsis" href="#">Миша Циркунов: Никита Крылов
                                          заслуживает места в топ-10</a>
                                      <a class="text-ellipsis text-xs text-muted" href="#">Бои по смешанным
                                          правилам</a>
                                  </div>
                              </div>
                          </article>
                      </div>
                  </div>
              </div>
          </div>


      </div>
      <div class="col-md-3">

          <div class="padder-v">


              <div class="panel wrapper b">
                  <p class="h4 font-thin text-black">Последнии <span class="text-primary">Видео</span></p>
                  <div class="row">
                      <article class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 padder-v">

                          <a href="#448" title="5 величайших реваншей в истории бокса">
                              <img src="http://mmaboxing.ru/images/cache/44353f82de7c75b1e2a5dc0fab857a81_728xx415x1.JPG" class="img-responsive" alt=""> </a>

                          <div>


                              <h4 class="m-b-xs">
                                  <a href="#">
                                      5 величайших реваншей в истории бокса
                                  </a>
                              </h4>
                              <small>4 дня назад</small>
                          </div>

                      </article>

                      <article class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 padder-v">

                          <a href="#448" title="5 величайших реваншей в истории бокса">
                              <img src="http://allboxing.ru/sites/default/files/styles/news_page_illustrate/public/georges-st-pierre_1.jpg?itok=zyi7w47G" class="img-responsive" alt=""> </a>

                          <div>


                              <h4 class="m-b-xs">
                                  <a href="#">
                                      Уайт: Сент-Пьер выйдет на бой с чемпионом в полусреднем весе
                                  </a>
                              </h4>
                              <small>4 дня назад</small>
                          </div>

                      </article>

                      <article class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 padder-v">

                          <a href="#448" title="5 величайших реваншей в истории бокса">
                              <img src="http://allboxing.ru/sites/default/files/styles/news_page_illustrate/public/aleksandr_gustafsson_2.jpg?itok=qn503xh6" class="img-responsive" alt=""> </a>

                          <div>


                              <h4 class="m-b-xs">
                                  <a href="#">
                                      Александр Густафссон: Я могу побить Дэниэля Кормье и Джона Джонса
                                  </a>
                              </h4>
                              <small>4 дня назад</small>
                          </div>

                      </article>


                  </div>


              </div>


              <img src="http://www.sostav.ru/articles/rus/2011/23.05/news/images/1mts1.jpg" class="img-responsive">


              <div id="vk_widget" class="m-t-xl" style="width:100%;">
                  <div id="vk_groups" style="width: 262px; height: 222px; background: none;"><iframe name="fXD8481f" frameborder="0" src="https://vk.com/widget_community.php?app=0&amp;width=262px&amp;_ver=1&amp;gid=115697372&amp;mode=3&amp;color1=&amp;color2=001D2E&amp;color3=c92a2a&amp;class_name=&amp;height=400&amp;url=http%3A%2F%2Flocalhost%3A8001%2Fpage.php&amp;referrer=&amp;title=MMA%3F%20No%20MMA!&amp;15e3d6ae343" width="262" height="185" scrolling="no" id="vkwidget2" style="overflow: hidden; height: 222px;"></iframe></div>
              </div>


              <script type="text/javascript" async="" src="//vk.com/js/api/openapi.js?144"></script>
              <script>
                  function VK_Widget_Init() {
                      document.getElementById('vk_groups').innerHTML = "";
                      var vk_width = document.getElementById('vk_widget').clientWidth;
                      VK.Widgets.Group("vk_groups", {
                          mode: 3,
                          width: vk_width,
                          height: "400",
                          color2: "001D2E",
                          color3: "c92a2a"
                      }, 115697372);
                  };
                  window.addEventListener('load', VK_Widget_Init, false);
                  window.addEventListener('resize', VK_Widget_Init, false);
              </script>

          </div>

      </div>


    </div>
</div>
</div>

@endsection
