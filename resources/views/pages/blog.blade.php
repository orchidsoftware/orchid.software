@extends('layouts.app')

@section('content')



  <div class="m-t-md m-b-md">

    <div class="container bg-white b box-shadow m-b-xl">
        <div class="row m-t-md m-b-md">
            <div class="col-sm-9">
              <div class="blog-post">

                @foreach($articles as $article)
                <div class="panel">
                  <div>
                    <img src="{{$article->hero('medium') ?? '/img/no-image.jpg'}}" class="img-full">
                  </div>
                  <div class="wrapper-lg">
                    <h2 class="m-t-none"><a href="{{route('article',[$article->slug])}}">{{$article->getContent('name')}}</a></h2>
                    <div>
                      {{str_strip_limit_words($article->getContent('body'))}}
                    </div>
                    <div class="line line-lg b-b b-light"></div>
                    <div class="text-muted">
                      <i class="fa fa-clock-o text-muted"></i> {{$article->publish_at->formatLocalized('%d %B %Y')}}
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="text-center m-t-lg m-b-lg">
                  {{ $articles->links() }}
              </div>
            </div>
            <div class="col-sm-3">
              <h5 class="font-bold">Categories</h5>
              <ul class="list-group">
                <li class="list-group-item">
                  <a href="">
                    <span class="badge pull-right">15</span>
                    Photograph
                  </a>
                </li>
                <li class="list-group-item">
                  <a href="">
                    <span class="badge pull-right">30</span>
                    Life style
                  </a>
                </li>
                <li class="list-group-item">
                  <a href="">
                    <span class="badge pull-right">9</span>
                    Food
                  </a>
                </li>
                <li class="list-group-item">
                  <a href="">
                    <span class="badge pull-right">4</span>
                    Travel world
                  </a>
                </li>
              </ul>
              <div class="tags m-b-lg l-h-2x">
                <a href="" class="label bg-primary">Bootstrap</a> <a href="" class="label bg-primary">Application</a> <a href="" class="label bg-primary">Apple</a> <a href="" class="label bg-primary">Less</a> <a href="" class="label bg-primary">Theme</a> <a href="" class="label bg-primary">Wordpress</a>
              </div>
              <h5 class="font-bold">Recent Posts</h5>
              <div>
                <div>
                  <a class="pull-left thumb thumb-wrapper m-r">
                    <img src="img/b0.jpg">
                  </a>
                  <div class="clear">
                    <a href="" class="font-semibold text-ellipsis">Bootstrap 3: What you need to know</a>
                    <div class="text-xs block m-t-xs"><a href="">Travel</a> 2 minutes ago</div>
                  </div>
                </div>
                <div class="line"></div>
                <div>
                  <a class="pull-left thumb thumb-wrapper m-r">
                    <img src="img/b1.jpg">
                  </a>
                  <div class="clear">
                    <a href="" class="font-semibold text-ellipsis">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                    <div class="text-xs block m-t-xs"><a href="">Design</a> 2 hours ago</div>
                  </div>
                </div>
                <div class="line"></div>
                <div>
                  <a class="pull-left thumb thumb-wrapper m-r">
                    <img src="img/b2.jpg">
                  </a>
                  <div class="clear">
                    <a href="" class="font-semibold text-ellipsis">Sed diam nonummy nibh euismod tincidunt ut laoreet</a>
                    <div class="text-xs block m-t-xs"><a href="">MFC</a> 1 week ago</div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

</div>

@endsection
