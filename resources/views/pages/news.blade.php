@extends('layouts.app')

@section('content')



    <div class="m-t-md m-b-md">
<div class="container m-b-xl">
    <div class="row">


      <div class="col-md-8 bg-white b box-shadow">


      <div class="blog-post">
          @foreach($articles as $article)
              <div class="panel">
          <div class="wrapper-lg">
            <h2 class="m-t-none text-black font-thin">
                <a href="{{route('blog.show',$article->slug)}}">{{$article->getContent('name')}}</a>
            </h2>
              <small> {{$article->publish_at->formatLocalized('%d %b %Y')}}</small>
          <div class="padder-v">
              <a href="{{route('blog.show',$article->slug)}}"><img src="{{$article->getContent('picture')}}"
                                                                   class="img-full"></a>
          </div>
            <div class="padder-v">
                <p> {{str_strip_limit_words($article->getContent('body'),600)}}</p>
            </div>
          </div>
        </div>
          @endforeach
      </div>
      <div class="text-center m-t-lg m-b-lg">
            {!! $articles->links() !!}
      </div>



      </div>
      <div class="col-md-4">


      </div>


    </div>
</div>
</div>





@endsection


@section('footer')

    <div class="bg-white b-t">
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
                            <a href="https://m.do.co/c/16c90d96a00c" target="_blank"><img src="/img/sponsors/do.png"
                                                                                          class="img-responsive"></a>
                        </div>
                        <div class="col-sm-3">
                            <a href="https://m.do.co/c/16c90d96a00c"
                               target="_blank"><img src="/img/sponsors/JetBrains.png" class="img-responsive"></a>
                        </div>
                        <div class="col-sm-3">
                            <a href="http://laravel.su"
                               target="_blank"><img src="https://new.laravel.su/img/welcome/developer.png"
                                                    style="height: 80px"
                                                    class="img-responsive"></a>
                        </div>

            </div>

        </div>
    </div>

@stop
