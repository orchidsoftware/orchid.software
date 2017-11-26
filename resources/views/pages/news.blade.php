@extends('layouts.app')

@section('content')


    <div class="bg-white  b-b">
        <div class="container">
            <div class="row v-center m-t-lg m-b-md padder-v">

                <div class="col-md-2">
                    <p class="h3 text-black font-bold">Разработка</p>
                </div>

                <div class="col-md-6">
                    <ul class="list-inline m-n">
                        <li class="m-r-md"><a href="#">PHP</a></li>
                        <li class="m-r-md"><a href="#">Базы данных</a></li>
                        <li class="m-r-md"><a href="#">Docker</a></li>
                        <li class="m-r-md"><a href="#">CSS</a></li>
                        <li class="m-r-md"><a href="#">HTML</a></li>
                        <li class="m-r-md"><a href="#">JavaScript</a></li>
                    </ul>
                </div>

                <div class="col-md-4">
                </div>


            </div>

              <div class="row m-t-lg b-b">

                   <div class="col-sm-3">
                       <div class="item">
                           <div class="pos-rlt">
                               <div class="top">
                                   <span class="badge bg-info m-l-sm m-t-sm">04:10</span>
                               </div>
                               <div class="item-overlay bg-black-opacity">
                                   <div class="center text-center m-t-n w-full">
                                       <a><i class="icon-control-play text-2x text-white"></i></a>
                                   </div>
                               </div>
                               <a href="#"><img
                                           src="https://i2.wp.com/wp.laravel-news.com/wp-content/uploads/2017/07/roles-permissions.png?resize=450%2C350" alt=""
                                           class="img-full"></a>
                           </div>
                           <div class="padder-v">
                               <a class="" href="#">Two Best Laravel Packages to Manage Roles/Permissions</a>
                               <a class="text-ellipsis text-xs text-muted" href="#">Package</a>
                           </div>
                       </div>
                   </div>
                   <div class="col-sm-3">
                       <div class="item">
                           <div class="pos-rlt">
                               <div class="top">
                                   <span class="badge bg-info m-l-sm m-t-sm">04:10</span>
                               </div>
                               <div class="item-overlay bg-black-opacity">
                                   <div class="center text-center m-t-n w-full">
                                       <a><i class="icon-control-play text-2x text-white"></i></a>
                                   </div>
                               </div>
                               <a href="#"><img
                                           src="https://i0.wp.com/wp.laravel-news.com/wp-content/uploads/2017/07/blade-if.png?resize=450%2C350" alt=""
                                           class="img-full"></a>
                           </div>
                           <div class="padder-v">
                               <a class="text-ellipsis" href="#">Blade::if() Directives</a>
                               <a class="text-ellipsis text-xs text-muted" href="#">Package</a>
                           </div>
                       </div>
                   </div>
                   <div class="col-sm-3">
                       <div class="item">
                           <div class="pos-rlt">
                               <div class="top">
                                   <span class="badge bg-info m-l-sm m-t-sm">04:10</span>
                               </div>
                               <div class="item-overlay bg-black-opacity">
                                   <div class="center text-center m-t-n w-full">
                                       <a><i class="icon-control-play text-2x text-white"></i></a>
                                   </div>
                               </div>
                               <a href="#"><img
                                           src="https://i1.wp.com/wp.laravel-news.com/wp-content/uploads/2017/02/laravel-collection-tap.png?resize=450%2C350" alt=""
                                           class="img-full"></a>
                           </div>
                           <div class="padder-v">
                               <a class="text-ellipsis" href="#">Laravel Collection “tap” Method</a>
                               <a class="text-ellipsis text-xs text-muted" href="#">Package</a>
                           </div>
                       </div>
                   </div>
                   <div class="col-sm-3">
                       <div class="item">
                           <div class="pos-rlt">
                               <div class="top">
                                   <span class="badge bg-info m-l-sm m-t-sm">04:10</span>
                               </div>
                               <div class="item-overlay bg-black-opacity">
                                   <div class="center text-center m-t-n w-full">
                                       <a><i class="icon-control-play text-2x text-white"></i></a>
                                   </div>
                               </div>
                               <a href="#"><img
                                           src="https://i0.wp.com/wp.laravel-news.com/wp-content/uploads/2017/06/codeship-forge.png?resize=450%2C350" alt=""
                                           class="img-full"></a>
                           </div>
                           <div class="padder-v">
                               <a class="text-ellipsis" href="#">Docker Simple</a>
                               <a class="text-ellipsis text-xs text-muted" href="#">Docker</a>
                           </div>
                       </div>
                   </div>

               </div>

              <div class="row">
                  <div class="col-md-9 b-r">

                      @foreach($news->slice(0,5) as $key => $new)
                      <article class="m-t-lg m-b-lg">
                          <div class="row">
                              <div class="col-md-5">

                                  <div class="item">
                                      <div class="pos-rlt">
                                          <div class="bottom">
                                              <span class="badge bg-danger m-l-sm m-b-sm">Новость</span>
                                          </div>
                                          <div class="item-overlay bg-black-opacity r r-2x">
                                              <div class="center text-center m-t-n w-full">
                                                  <a href="{{route('news.show',$new->slug)}}"><i class="icon-control-play text-2x text-white"></i></a>
                                              </div>
                                          </div>
                                          <a href="{{route('news.show',$new->slug)}}"><img src="{{$new->hero('medium') ?? 'http://localhost:8000/storage/2017/10/23/ca7610aadad309341eb1410be4b188a921c13030_medium.jpg'}}" alt="" class="img-full img-responsive r r-2x"></a>
                                      </div>

                                  </div>

                              </div>
                              <div class="col-md-7">

                                  <div class="">

                                      <h3 class="h3"><a href="{{route('news.show',$new->slug)}}">{{$new->getContent('name')}}</a></h3>
                                      <div class="small">
                                          <div class="meta-item meta-date"><p class="m-t-sm">{{$new->publish_at->formatLocalized('%d %b %Y')}}</p>
                                          </div>

                                      </div>

                                  </div>

                                  <div class="">
                                      <p>
                                       {{str_strip_limit_words($new->getContent('body'))}}
                                      </p>
                                  </div>


                              </div>
                          </div>
                      </article>
                      @endforeach

                  </div>

                  <div class="col-md-3">
                      @foreach($news->slice(5,10) as $key => $new)
                      <article class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 padder-v">

                          <a href="{{route('news.show',$new->slug)}}">
                              <img src="{{$new->hero('medium') ?? 'http://localhost:8000/storage/2017/10/23/ca7610aadad309341eb1410be4b188a921c13030_medium.jpg'}}" class="img-responsive" alt=""> </a>

                          <div>
                              <h5 class="m-b-xs">
                                  <a href="{{route('news.show',$new->slug)}}">
                                    {{$new->getContent('name')}}
                                  </a>
                              </h5>
                          </div>

                      </article>
                      @endforeach
                  </div>

              </div>

            </div>
    </div>




@endsection


@section('footer')

    <div class="bg-white ">
        <div class="container">
            <div class="row m-t-xxl m-b-lg">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <p class="h2 text-black font-thin">Спонсоры</p>
                            <p class="text-muted">
                                Компании, которые нас поддерживают
                            </p>
                        </div>
            </div>

            <div class="row m-b-xxl v-center">
                        <div class="col-sm-3">
                            <a href="https://m.do.co/c/16c90d96a00c" target="_blank"><img src="/img/sponsors/do.png" class="img-responsive"></a>
                        </div>
                        <div class="col-sm-3">
                            <a href="https://m.do.co/c/16c90d96a00c" target="_blank"><img src="/img/sponsors/JetBrains.png" class="img-responsive"></a>
                        </div>
                        <div class="col-sm-3">
                            <a href="http://laravel.su" target="_blank"><img src="https://new.laravel.su/img/welcome/developer.png"  style="height: 80px" class="img-responsive"></a>
                        </div>

            </div>

        </div>
    </div>

@stop
