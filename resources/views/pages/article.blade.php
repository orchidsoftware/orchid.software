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

                            @include('partials.social')

                      </div>
                  </div>
              </div>


          </main>


      </div>
      <div class="col-md-3">

          <div class="padder-v">


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
                      }, 53758340);
                  };
                  window.addEventListener('load', VK_Widget_Init, false);
                  window.addEventListener('resize', VK_Widget_Init, false);
              </script>



              <div class="panel wrapper b m-t-md">
                  <p class="h4 font-thin text-black">Последнии <span class="text-primary">Видео</span></p>
                  <div class="row">
                      <article class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 padder-v">

                          <a href="#448" title="5 величайших реваншей в истории бокса">
                              <img src="http://localhost:8000/storage/2017/09/02/02c1b217b2c4213060e5606f0466f96691662b00_medium.jpg" class="img-responsive" alt=""> </a>

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
                              <img src="http://localhost:8000/storage/2017/09/02/02c1b217b2c4213060e5606f0466f96691662b00_medium.jpg" class="img-responsive" alt=""> </a>

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
                              <img src="http://localhost:8000/storage/2017/09/02/02c1b217b2c4213060e5606f0466f96691662b00_medium.jpg" class="img-responsive" alt=""> </a>

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




          </div>

      </div>


    </div>
</div>
</div>

@endsection
