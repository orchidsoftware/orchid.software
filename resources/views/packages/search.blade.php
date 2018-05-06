@extends('layouts.app')


@section('content')

    <header class="bg-dark text-white">
        <div class="container text-center">
            <div class="padder-v m-b-lg m-t-lg">
                <form class="search-navbar-search smallsearch w-xxl center" action="{{route('packages.search')}}">
                    <div class="row text-left">
                        <input class="search-navbar-input col-xs-10 text-black" type="text" required
                               placeholder="Search..." name="query" value="{{request('query')}}">
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

                <div class="row">
                    @forelse($results as $plugin)

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

                    @empty
                        <h2>Not Found</h2>

                    @endforelse
                </div>

                <div class="row text-center">
                    {{$results->links() }}
                </div>


            </div>

        </div>

    </div>

@endsection
