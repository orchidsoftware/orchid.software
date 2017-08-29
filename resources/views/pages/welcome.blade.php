@extends('layouts.app')

@section('content')


    <div class="bg-black-opacity">

        <section class="container-fluid hidden-xs">
            <div class="row">
                <div style="background:url(/img/hero10.jpg) center center; background-size:cover">
                    <div class="wrapper-xl bg-black-opacity bg-dark min-h-h pos-rlt  text-ellipsis">
                        <div class="row  m-t-xxl m-b-xxl">
                            <div class="container m-t-md top-desc-block">

                                <div class="col-xs-12">
                                    <div class="page-hero-content">
                                        <h1 class="text-white">
                                            ORCHID - {{trans('welcome.this')}} <span class="text-primary">Laravel </span> <span class="main-typed-element"></span> <br>
                                          {!! trans('welcome.tagline') !!}
                                        </h1>
                                        <p class="text-white">
                                          {!! trans('welcome.tagline_sub') !!}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>



        <div class="bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <div class="padder-v m-t-md">
                            <h4 class="m-b-n ">{{trans('welcome.head')}}</h4>
                            <h1 class="font-thin m-t-n l-h-1x padder-v text-black">
                             {{trans('welcome.head_desc')}}
                            </h1>
                            <p class="text-muted wow fadeInDown" data-wow-offset="200" data-wow-delay="600">
                                {!! trans('welcome.head_sup')  !!}
                            </p>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="#registation" data-ride="scroll">
                        <i class="m-t-md m-b-xl icon-arrow-down-circle fa-2x text-muted"></i>
                        </a>
                    </div>
                </div>


                <div class="row m-b-xl m-t-xl v-center">
                    <div class="col-md-6 col-xs-12 ">
                        <p class="h1 font-thin text-black">
                            <span class="text-primary">01</span>
                            <br>
                            {!! trans('welcome.01.title')  !!}
                        </p>


                        <ul class="list-group no-bg no-borders pull-in m-t-lg basic-list-blue">
                            <li class="list-group-item fadeInUp wow" data-wow-offset="200" data-wow-delay="600">
                                <i class="icon-check pull-left text-lg m-r text-primary"></i>
                                {!! trans('welcome.01.li1')  !!}
                            </li>
                            <li class="list-group-item fadeInUp wow" data-wow-offset="200" data-wow-delay="900">
                                <i class="icon-check pull-left text-lg m-r text-primary"></i>
                                {!! trans('welcome.01.li2')  !!}
                            </li>
                            <li class="list-group-item fadeInUp wow"  data-wow-offset="200"  data-wow-delay="1100">
                                <i class="icon-check pull-left text-lg m-r text-primary"></i>
                                {!! trans('welcome.01.li3')  !!}
                            </li>
                        </ul>


                    </div>
                    <div class="col-md-6 hidden-xs text-center">
                        <img src="/img/cms/7.png" alt="" class="img-responsive center"  style="max-height: 350px;">
                    </div>
                </div>


                <div class="row m-b-xl m-t-xxl v-center">
                    <div class="col-md-6 hidden-xs text-center">
                        <img src="/img/cms/1.png" alt="" class="img-responsive center"  style="max-height: 350px;">
                    </div>
                    <div class="col-md-6 col-xs-12 ">
                        <p class="h1 font-thin text-black">
                            <span class="text-primary">02</span>
                            <br>
                            {!! trans('welcome.02.title')  !!}
                        </p>


                        <ul class="list-group no-bg no-borders pull-in m-t-lg">
                            <li class="list-group-item fadeInUp wow" data-wow-offset="200"  data-wow-delay="600">
                                <i class="icon-check pull-left text-lg m-r text-primary"></i>
                                {!! trans('welcome.02.li1')  !!}
                            </li>
                            <li class="list-group-item fadeInUp wow" data-wow-offset="200"  data-wow-delay="900">
                                <i class="icon-check pull-left text-lg m-r text-primary"></i>
                                {!! trans('welcome.02.li2')  !!}
                            </li>
                            <li class="list-group-item fadeInUp wow" data-wow-offset="200" data-wow-delay="1100">
                                <i class="icon-check pull-left text-lg m-r text-primary"></i>
                                {!! trans('welcome.02.li3')  !!}
                            </li>
                        </ul>

                    </div>
                </div>


                <div class="row m-b-xxl m-t-xxl v-center">
                    <div class="col-md-6 col-xs-12">
                        <p class="h1 font-thin text-black">
                            <span class="text-primary">03</span>
                            <br>
                            {!! trans('welcome.03.title')  !!}
                        </p>


                        <ul class="list-group no-bg no-borders pull-in m-t-lg">
                            <li class="list-group-item fadeInUp wow" data-wow-offset="200"  data-wow-delay="600">
                                <i class="icon-check pull-left text-lg m-r text-primary"></i>
                                {!! trans('welcome.03.li1')  !!}
                            </li>
                            <li class="list-group-item fadeInUp wow" data-wow-offset="200"  data-wow-delay="900">
                                <i class="icon-check pull-left text-lg m-r text-primary"></i>
                                {!! trans('welcome.03.li2')  !!}
                            </li>
                            <li class="list-group-item fadeInUp wow" data-wow-offset="200"  data-wow-delay="1100">
                                <i class="icon-check pull-left text-lg m-r text-primary"></i>
                                {!! trans('welcome.03.li3')  !!}
                            </li>
                        </ul>


                    </div>
                    <div class="col-md-6 hidden-xs text-center">
                        <img src="/img/cms/2.png" alt="" class="img-responsive center" style="max-height: 350px;">
                    </div>
                </div>


            </div>
        </div>


    </div>

@endsection


@section('footer')
    <div id="registation" class="bg-black hidden-xs"
         style="background: url(https://static.pexels.com/photos/140945/pexels-photo-140945.jpeg)  center center; background-size: cover">
        <div class="bg-black-opacity">
            <div class="container">
                <div class="row  m-t-xxl m-b-xxl">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="col-xs-height col-middle">
                            <div class="text-center">
                                <h2 class="text-white col-sm-12 font-thin ">
                                    {!! trans('welcome.footer')  !!}
                                </h2>
                                <a href="{{url('docs')}}" class="btn btn-lg btn-primary btn-rounded m-t-md wow fadeInUp" data-wow-offset="200" data-wow-delay="600">
                                    {!! trans('welcome.get_started') !!}
                                </a>
                                <p class="text-muted m-t-md wow fadeInUp" data-wow-offset="200" data-wow-delay="900">
                                    {!! trans('welcome.footer_sub') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
