@extends('layouts.app')


@section('content')


<div class="m-t-md m-b-md">
<div class="container bg-white b box-shadow m-b-xl">



    <div class="row">
      <div class="col-md-7">
        <h3 class="font-thin m-b-md">New Package</h3>
        <div class="row row-sm">
          @for($i = 1; $i < 10; $i++)
            <div class="col-xs-6 col-sm-3">
                <div class="item">
                  <div class="pos-rlt">
                    <div class="item-overlay bg-black-opacity r r-2x">
                      <div class="center text-center m-t-n w-full">
                        <a ui-sref="music.detail" href="#/music/detail"><i class="fa fa-2x fa-github-alt text-white"></i></a>
                      </div>
                    </div>
                    <a ui-sref="music.detail" href="#/music/detail"><img src="https://orchid.software/img/cms/{{$i}}.png" alt="" class="img-full r r-2x"></a>
                  </div>
                  <div class="padder-v">
                    <a ui-sref="music.detail" class="text-ellipsis" href="#/music/detail">Spring rain</a>
                    <a ui-sref="music.detail" class="text-ellipsis text-xs text-muted" href="#/music/detail">Miaow</a>
                  </div>
            </div>
            </div>
          @endfor
        </div>
      </div>
      <div class="col-md-5">
        <h3 class="font-thin m-b-md">Top Package</h3>
        <div class="list-group bg-white list-group-lg no-bg auto">
          <a ui-sref="music.detail" class="list-group-item clearfix" href="#/music/detail">
            <span class="pull-right h2 text-muted m-l">1</span>
            <span class="pull-left thumb-sm avatar m-r">
              <img src="http://flatfull.com/themes/angulr/angular/img/a4.jpg" alt="..." class="r">
            </span>
            <span class="clear">
              <span>Little Town</span>
              <small class="text-muted clear text-ellipsis">by Chris Fox</small>
            </span>
          </a>
          <a ui-sref="music.detail" class="list-group-item clearfix" href="#/music/detail">
            <span class="pull-right h2 text-muted m-l">2</span>
            <span class="pull-left thumb-sm avatar m-r">
              <img src="http://flatfull.com/themes/angulr/angular/img/a5.jpg" alt="..." class="r">
            </span>
            <span class="clear">
              <span>Lementum ligula vitae</span>
              <small class="text-muted clear text-ellipsis">by Amanda Conlan</small>
            </span>
          </a>
          <a ui-sref="music.detail" class="list-group-item clearfix" href="#/music/detail">
            <span class="pull-right h2 text-muted m-l">3</span>
            <span class="pull-left thumb-sm avatar m-r">
              <img src="http://flatfull.com/themes/angulr/angular/img/a6.jpg" alt="..." class="r">
            </span>
            <span class="clear">
              <span>Aliquam sollicitudin venenatis</span>
              <small class="text-muted clear text-ellipsis">by Dan Doorack</small>
            </span>
          </a>
          <a ui-sref="music.detail" class="list-group-item clearfix" href="#/music/detail">
            <span class="pull-right h2 text-muted m-l">4</span>
            <span class="pull-left thumb-sm avatar m-r">
              <img src="http://flatfull.com/themes/angulr/angular/img/a7.jpg" alt="..." class="r">
            </span>
            <span class="clear">
              <span>Aliquam sollicitudin venenatis ipsum</span>
              <small class="text-muted clear text-ellipsis">by Lauren Taylor</small>
            </span>
          </a>
          <a ui-sref="music.detail" class="list-group-item clearfix" href="#/music/detail">
            <span class="pull-right h2 text-muted m-l">5</span>
            <span class="pull-left thumb-sm avatar m-r">
              <img src="http://flatfull.com/themes/angulr/angular/img/a8.jpg" alt="..." class="r">
            </span>
            <span class="clear">
              <span>Vestibulum ullamcorper</span>
              <small class="text-muted clear text-ellipsis">by Dan Doorack</small>
            </span>
          </a>
        </div>
      </div>
    </div>

    <div class="row">
         <div class="row row-sm">
        @foreach($plugins as $plugin)


        <div class="col-xs-6 col-sm-2"> <div class="item"> <div class="pos-rlt"> <div class="item-overlay bg-black-opacity r r-2x"> <div
                                class="center text-center m-t-n w-full"> <a ui-sref="music.detail"
                                                                            href="#/music/detail"><i class="fa fa-2x fa-play-circle text-white"></i></a> </div> </div> <a
                            ui-sref="music.detail"
                            href="#/music/detail"><img src="{{$plugin->content['info']['extra']['orchid']['image'] or ''}}"
                                                       alt=""
                                                       class="img-responsive r r-2x"></a> </div> <div class="padder-v"> <a
                            ui-sref="music.detail"
                            class="text-ellipsis"
                            href="#/music/detail">{{$plugin->content['description'] or ''}}</a> <a ui-sref="music.detail"
                                                                     class="text-ellipsis text-xs text-muted"
                                                                     href="#/music/detail">{{$plugin->content['name'] or ''}}</a> </div> </div> </div>

        @endforeach
         </div>
    </div>


</div>
</div>

@endsection
