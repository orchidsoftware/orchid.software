@extends('layouts.app')

@section('title',$article->getContent('title'))
@section('description',$article->getContent('description'))
@section('keywords',$article->getContent('keywords'))
@section('image',config('app.url').$article->getContent('picture'))


@section('content')


<div class="m-t-md m-b-md">
<div class="container m-b-xl">
    <div class="row">


      <div class="col-md-8 bg-white b box-shadow">


          <main class="wrapper">


              <div class="page-header">

                  <h1 class="text-black">
                         {{ $article->getContent('name') }}
                  </h1>
                  <small>{{$article->publish_at->formatLocalized('%d %b %Y')}}</small>

              </div>

              <div>
                  <img src="{{$article->getContent('picture') ?? '/img/no-image.jpg'}}" class="img-full">
              </div>

              <div class="padder-v">
                  {!! $article->getContent('body') !!}
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
      <div class="col-md-4">


      </div>


    </div>
</div>
</div>

@endsection
