@extends('layouts.app')

@section('title',$post->getContent('title'))
@section('description',$post->getContent('description'))
@section('keywords',$post->getContent('keywords'))
@section('image',config('app.url').$post->getContent('picture'))


@section('content')


    <div class="bg-white">
<div class="container">
    <div class="row m-t-md m-b-md">


      <div class="col-md-9">


          <main class="wrapper">


              <div class="page-header">

                  <h1 class="text-black">
                         {{ $post->getContent('name') }}
                  </h1>
                  <small>{{$post->publish_at->formatLocalized('%d %b %Y')}}</small>

              </div>

              <div>
                  <img src="{{$post->getContent('picture') ?? '/img/no-image.jpg'}}" class="img-full">
              </div>

              <div class="padder-v">
                  {!! $post->getContent('body') !!}
              </div>


              <div class="wrapper-md b-t">

                  <div class="row v-center">


                      <div class="col-sm-6 col-xs-12">

                        {{--
                          <div class="meta-tags">
                              <a href="#" rel="tag">Шугар Рэй Леонард</a> / <a href="#" rel="tag">Томас
                              Хёрнс</a> / <a href="#" rel="tag">Риддик Боу</a> / <a href="#" rel="tag">Рафаэль
                              Маркез Артуро Гатти</a> / <a href="#" rel="tag">Микки Уорд</a>
                          </div>
                        --}}
                      </div>

                      <div class="col-sm-6 text-right hidden-xs" role="group" aria-label="Social Links">

                            @include('partials.social')

                      </div>
                  </div>
              </div>


          </main>


      </div>
      <div class="col-md-3">


      </div>


    </div>
</div>
</div>

@endsection
