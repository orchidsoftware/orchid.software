@extends('layouts.app')


@section('content')

<header class="bg-dark text-white">
    <div class="container text-center">
    <div class="padder-v m-b-lg">
        <h1 class="font-thin padder-v">Packages for Laravel</h1>

            <p class="">
                Extend your ORCHID experience with {{$count}} packages.
            </p>


        <form class="search-navbar-search smallsearch w-xxl center" action="{{route('packages.search')}}">
                <div class="row text-left">
                    <input class="search-navbar-input col-xs-10 text-black" type="text" required
                           placeholder="Search..." name="query">
                    <button class="search-navbar-button btn btn-primary col-xs-2">
                        <i class="icon-magnifier"></i>
                    </button>
                </div>
        </form>
        </div>


    </div>
</header>



<div id="packages-list" class="bg-white box-shadow">

    <div class="container">
        <div class="row m-b-lg m-t-lg">

        <h3 class="font-thin text-black m-b-md">Most Popular</h3>

        <div class="row ">
             @foreach($top as $plugin)

            <div class="col-xs-12 col-sm-4">
              <div class="b box-shadow wrapper-md m-t-md m-b-md">
                    <p style="height: 50px; overflow: hidden">
                      <a href="{{route('packages.show',$plugin->slug)}}">
                        {{$plugin->content['description']}}
                      </a>
                    </p>
                  <a class="text-ellipsis text-xs text-muted" href="{{$plugin->content['repository']}}">
                    {{$plugin->content['name']}}
                  </a>
                  <p class="m-t-sm">
                      <span class="m-r-md"><i class="icon-star m-r-xs"></i>{{number_format($plugin->content['github_stars'])}}</span>
                      <span><i class="icon-cloud-download m-r-xs"></i>{{number_format($plugin->content['downloads']['total'])}}</span>
                  </p>
              </div>
            </div>

            @endforeach
        </div>
        </div>

    </div>

</div>






<section class="text-center b-t bg-white hidden">
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
