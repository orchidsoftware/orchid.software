@extends('layouts.app')

@section('content')



<div class="bg-white">
<div class="container">
    <div class="row m-t-md m-b-md">


      <div class="col-md-9">


      <div class="blog-post">
          @foreach($posts as $post)
              <div class="panel">
          <div class="wrapper-lg">
            <h2 class="m-t-none text-black font-thin">
                <a href="{{route('blog.show',$post->slug)}}">{{$post->getContent('name')}}</a>
            </h2>
              <small> {{$post->publish_at->formatLocalized('%d %b %Y')}}</small>
          <div class="padder-v">
              <a href="{{route('blog.show',$post->slug)}}"><img src="{{$post->getContent('picture')}}"
                                                                   class="img-full"></a>
          </div>
            <div class="padder-v">
                <p> {{str_strip_limit_words($post->getContent('body'),600)}}</p>
            </div>
          </div>
        </div>
          @endforeach
      </div>
      <div class="text-center m-t-lg m-b-lg">
            {!! $posts->links() !!}
      </div>



      </div>
      <div class="col-md-3">


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
                               target="_blank"><img src="/img/sponsors/laravelru.png"
                                                    style="height: 80px"
                                                    class="img-responsive"></a>
                        </div>

            </div>

        </div>
    </div>

@stop

