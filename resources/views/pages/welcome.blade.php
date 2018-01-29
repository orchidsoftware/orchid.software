@extends('layouts.app')

@section('title','Laravel Admin Panel')
@section('description','Simple Laravel Admin panel and CMS')


@section('content')


    <div class="bg-white b-b">



        <section class="bg-white  box-shadow-lg">
            <div class="container">
                <div class="row  m-t-xxl m-b-xxl v-center">

                    <div class="col-md-7 col-sm-12 col-xs-12 display-table sm-height-auto">
                        <div class="row">
                            <!-- section title -->
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <h1 class="font-thin m-t-n l-h-1x padder-v text-black">
                                    Laravel <span class="main-typed-element text-primary">{{trans('welcome.title')}}}}</span>
                                </h1>
                                <p class="text-muted m-b-lg">
                                {{trans('welcome.descriptions')}}
                                </p>
                            </div>
                            <!-- end section title -->
                        </div>
                        <!-- feature box -->
                        <div class="row two-column no-margin m-t-md">
                            <div class="col-md-6 col-sm-6 col-xs-12 padder-v">
                                <div class="col-md-3 col-xs-12 text-center  m-b-md">
                                    <p class="h3 inline b b-dark r-3x wrapper-sm"><i class=" w-1x icon-cloud-download text-primary"></i></p>
                                </div>
                                <div class="col-md-8 col-xs-12 ">
                                    <p class="h4 text-black font-thin">{{trans('welcome.promo.list_1.title')}}</p>
                                    <div class="m-t-sm"><p class="small">{{trans('welcome.promo.list_1.descriptions')}}</p></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 padder-v">
                                <div class="col-md-3 col-xs-12 text-center m-b-md">
                                    <p class="h3 inline b b-dark r-3x wrapper-sm"><i class=" w-1x icon-rocket text-primary"></i></p>
                                </div>
                                <div class="col-md-8 col-xs-12">
                                    <p class="h4 text-black font-thin">{{trans('welcome.promo.list_2.title')}}</p>
                                    <div class="m-t-sm"><p class="small">{{trans('welcome.promo.list_2.descriptions')}}
                                        </p></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 padder-v">
                                <div class="col-md-3 col-xs-12 text-center m-b-md">
                                    <p class="h3 inline b b-dark r-3x wrapper-sm"><i class=" w-1x icon-screen-desktop  text-primary"></i></p>
                                </div>
                                <div class="col-md-8 col-xs-12 ">
                                    <p class="h4 text-black font-thin">{{trans('welcome.promo.list_3.title')}}</p>
                                    <div class="m-t-sm"><p class="small">{{trans('welcome.promo.list_3.descriptions')}}</p></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 padder-v">
                                <div class="col-md-3 col-xs-12 text-center m-b-md">

                                    <p class="h3 inline b b-dark r-3x wrapper-sm"><i class=" w-1x icon-support  text-primary"></i></p>

                                </div>
                                <div class="col-md-8 col-xs-12 ">
                                    <p class="h4 text-black font-thin">{{trans('welcome.promo.list_4.title')}}</p>
                                    <div class="m-t-sm"><p class="small">{{trans('welcome.promo.list_4.descriptions')}}</p></div>
                                </div>
                            </div>

                        </div>
                        <!-- end feature box -->


                    </div>
                    <div class="col-md-5 col-sm-5 hidden-xs">
                        <img class="img-responsive" src="/img/cms/7.png" alt="">
                    </div>

                </div>
            </div>
        </section>


    </div>

@endsection
