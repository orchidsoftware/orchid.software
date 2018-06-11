@extends('layouts.app')

@section('title','Developer')
@section('description','Developer')


@section('content')


    <style>


        .has-codeshell {
            height: 520px;
            overflow: hidden;
            max-width: 780px;
            margin: auto;
            position: relative;
        }


        .codeshell {
            background: #fff;
            border-radius: 5px;
            position: absolute;
            height: 320px;
            left: 0;
            right: 0;
            font-size: 14px;
        }
        .codeshell .disc {
            width: 11px;
            border-radius: 50%;
            height: 11px;
            margin: 0 2px;
        }

        .codeshell .codeshell-header {
            border-top-right-radius: 3px;
            border-top-left-radius: 4px;
            display: flex;
            align-items: center;
            padding-left: 4px;
            height: 27px;
        }

        .codeshell .codeshell-body {
            color: #f8f8f2;
            font-family: source-code-pro,Consolas,Monaco,Andale Mono,monospace;
            padding: 20px 20px 30px;
            height: 100%;
            font-size: 1.3rem;
        }

        <!-- Удалить -->
        .codeshell .codeshell-body .codeshell-action {
            color: #52fa7c;
            font-weight: 600;
        }
        .codeshell .codeshell-body .codeshell-title {
            color: #8be8fd;
            font-weight: 600;
            margin-top: 20px;
            position: relative;
            display: inline-block;
        }

</style>


    <div class="install bg-white">
        <div class="container pos-rlt">

            <div class="row m-t-xxl m-b-xl v-center">
                <div class="col-lg-10">
                    <div class="shrinked-container has-codeshell">
                    <div class="m-b-xl">
                        <h2 class="text-dark font-thin"> Laravel <span class="main-typed-element text-primary">{{trans('welcome.title')}}</span></h2>
                        <p class="m-t-md font-thin">AdonisJs is a Node.js web framework with a breath of fresh air and drizzle of elegant syntax on top of it. We prefer <strong>developer joy</strong> and <strong>stability</strong> over anything else.</p>
                    </div>
                    <div class="codeshell">
                        <div class="codeshell-header b bg-light">
                            <div class="disc bg-danger"></div>
                            <div class="disc bg-warning"></div>
                            <div class="disc bg-success"></div>
                        </div>
                        <div class="codeshell-body bg-dark">
                            <div class="codeshell-action">$ composer require orchid/platform</div>
                            <div>Crafting new application...</div>
                            <div>Application crafted! <span class="info">Build something awesome</span></div>
                            <div class="codeshell-title">adonisjs apps are packed with</div>
                            <div>------------------------------</div>
                            <ul>
                                <li> seamless authentication </li>
                                <li> SQL ORM, migrations and seeds </li>
                                <li> inbuilt support for i18n </li>
                                <li> first class testing support </li>
                                <li> moreover, written in plain javascript </li>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-5 col-md-7 text-center wrap-feature-box pos-abt bottom-right" style="top: 30rem">
                    <div class="bg-white b box-shadow-lg">
                        <div class="wrapper-lg">
                            <h3 class="text-black font-thin">The New way of Making Your Website in mins</h3>
                            <p class="text-">You can relay on our amazing features list and also our customer services will be great experience. You will love it for sure.</p>
                            <a class="btn btn-primary btn-rounded btn-sm" href="#"><span>Explore More <i class="ti-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <div class="bg-white">
        <div class="container">
            <!--Row-->
            <div class="row m-b-xxl">

                <div class="col-md-12">
                    <h3 class="font-thin text-black text-center m-b-lg m-t-xl">What's next?</h3>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="m-t-md m-b-md wrapper-lg  b">
                        <div class="ico column text-primary"><i class="icon-energy"></i></div>
                        <div class="desc">
                            <h4 class="font-thin">Tutorials</h4>
                            <p>
                                Build a simple app in minutes. Master advanced concepts and techniques
                            </p>
                            <p class="text-right">
                                <a href="#" class="small">Start now <i class="icon-right m-l-xs"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="m-t-md m-b-md wrapper-lg  b">
                        <div class="ico column text-primary"><i class="icon-direction"></i></div>
                        <div class="desc">
                            <h4 class="font-thin">Guide</h4>
                            <p>
                                The best practices for creating applications based on the ORCHID platform
                            </p>
                            <p class="text-right">
                                <a href="#" class="small">Read now <i class="icon-right m-l-xs"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="m-t-md m-b-md wrapper-lg  b">
                        <div class="ico column text-primary"><i class="icon-notebook"></i></div>
                        <div class="desc">
                            <h4 class="font-thin">Documentation</h4>
                            <p>
                                Reference documentation to discover everything Meteor has to offer
                            </p>
                            <p class="text-right">
                                <a href="#" class="small">Explore now <i class="icon-right m-l-xs"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--End row-->
        </div>
    </div>




    <div class="bg-white">
            <div class="container">
            <div class="row m-t-xxl m-b-xxl b-b r-2x b-2x b-primary" style="box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);">
                    <div class="col-md-6 col-xs-12 sm-text-center">
                        <h3 class="text-black font-thin">Interested in new themes and discounts?</h3>
                        <p class="text-muted">We'll notify you and promise never to spam.</p>
                    </div>
                    <div class="col-md-6 col-xs-12 sm-text-center">
                        <div class="form-group form-group-default m-t-xl">
                            <label>Your email here</label>
                            <div class="controls">
                                <input type="text" placeholder="Your email here..." class="form-control">
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>



    <section class="text-center b-t bg-white">
        <!--Container-->
        <div class="container">


            <!--Row-->
            <div class="row m-t-xxl m-b-xxl">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 text-center">
                    <h3 class="font-thin text-black">Сделать вклад</h3>
                    <div class="w-xxl b-b center"></div>
                    <p class="lead not-mb m-t-md">
                        Я призываю всех внести свой вклад в проект ORCHID. <br>Вы можете найти последнюю версию кода GitHub на странице
                        <a href="https://github.com/orchidsoftware" target="_blank">https://github.com/orchidsoftware</a>.
                    </p>
                </div>
            </div>
            <!--End row-->
        </div>
        <!--End container-->
    </section>

@endsection
