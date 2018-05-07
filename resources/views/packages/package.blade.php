@extends('layouts.app')

@section('title',$package->content['info']['name'])
@section('description',$package->content['info']['description'])


@section('content')
    <div class="bg-white-only">

    <div class="container">
        <div class="row m-t-md m-b-md">

                    <div class="col-md-3 b-r b-light">

                        <p class="h4 font-thin text-black m-t-xl">Description:</p>
                        <p class="padder-v small">{{$package->content['description']}}</p>
                        <p class="text-center">
                            <a href="{{$package->content['repository']}}" target="_blank" class="btn btn-xs btn-primary btn-rounded m-l m-t-sm"><i class="icon-social-github m-r-xs"></i> Show repository</a>
                        </p>


                        <p class="h4 font-thin text-black m-t-md">Statistics:</p>
                        <ul class="list-inline m-t-md">
                            <li class="m-r-sm">
                                <i class="icon-eye m-r-xs"></i> {{number_format($package->content['github_watchers'])}}
                            </li>
                            <li class="m-r-sm">
                                <i class="icon-star m-r-xs"></i> {{number_format($package->content['github_stars'])}}
                            </li>
                            <li class="m-r-sm">
                                <i class="icon-cloud-download m-r-xs"></i> {{number_format($package->content['downloads']['total'])}}
                            </li>
                        </ul>

                        @empty($package->tags)
                        <p class="h4 font-thin text-black m-t-md">Tags:</p>
                        <ul class="list-inline m-t-md">
                            @foreach($package->tags as $tag)
                                <li class="m-r-xs m-t-xs">
                                    <a href="#" class="label bg-dark text-white">{{$tag->name}} ({{$tag->count}})</a>
                                </li>
                            @endforeach
                        </ul>
                        @endempty

                        @empty($package->content['info']['require'])
                        <p class="h4 font-thin text-black m-t-md">Require:</p>
                        <ul class="m-t-md small list-inline">
                            @foreach($package->content['info']['require'] as $name => $version)
                                <li class="w-full">
                                    {{$name}} : <span class="pull-right">{{$version}}</span>
                                </li>
                            @endforeach
                        </ul>
                        @endempty

                        @empty($package->content['info']['authors'])
                        <p class="h4 font-thin text-black m-t-md">Author:</p>
                        <p class="padder-v">
                            @foreach($package->content['info']['authors'] as $author)
                                <a href="mailto:{{$author['email'] or 'unknown'}}" title="{{$author['name'] or 'unknown'}}">
                                    {{$author['name'] or 'unknown'}}
                                </a>
                            @endforeach
                        </p>
                        @endempty

                        @empty($package->content['maintainers'])
                        <p class="h4 font-thin text-black m-t-md">Maintainers:</p>
                        <ul class="list-inline m-t-md">
                            @foreach($package->content['maintainers'] as $maintainer)
                                <li>
                                    <a href="{{$package->content['repository']}}/graphs/contributors"
                                       title="{{$maintainer['name']}}"
                                       target="_blank" class="pull-left thumb-sm avatar">
                                        <img src="{{$maintainer['avatar_url']}}" alt="..." class="img-circle">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        @endempty


                        <p class="h4 font-thin text-black m-t-md">Share:</p>
                        <ul class="list-inline m-t-md">
                            <li>
                                <a onclick="popupCenter('http://vk.com/share.php?url={{url()->current()}}', '',600,400);"
                                   href="javascript:void(0);" class="btn btn-icon btn-rounded b"><i
                                            class="icon-social-vkontakte"></i></a>
                            </li>

                            <li>
                                <a onclick="popupCenter('http://www.facebook.com/sharer.php?u={{url()->current()}}', '',600,400);"
                                   href="javascript:void(0);" class="btn btn-icon btn-rounded b"><i
                                            class="icon-facebook"></i></a>
                            </li>

                            <li>
                                <a onclick="popupCenter('https://plus.google.com/share?url={{url()->current()}}', '',600,400);"
                                   href="javascript:void(0);" class="btn btn-icon btn-rounded b"><i
                                            class="icon-social-google"></i></a>
                            </li>

                            <li>
                                <a onclick="popupCenter('https://twitter.com/share?url={{url()->current()}}', '',600,400);"
                                   href="javascript:void(0);" class="btn btn-icon btn-rounded b"><i
                                            class="icon-social-twitter"></i></a>
                            </li>
                        </ul>




                    </div>

                    <div class="col-md-9 col-xs-12 wrapper-lg">

                        <main>

                            {!! $content !!}

                        </main>


                    </div>
                </div>

        @if(count($similars) > 0)
        <div class="row m-b-lg m-t-lg b-t">

            <h3 class="font-thin text-black m-b-md">See also</h3>

            <div class="row">
                @foreach($similars as $simular)

                    <div class="col-xs-12 col-sm-4">
                        <div class="b box-shadow wrapper-md">
                            <p style="height: 50px; overflow: hidden">
                                <a href="{{route('packages.show',$simular->slug)}}">
                                    {{$simular->content['description']}}
                                </a>
                            </p>
                            <a class="text-ellipsis text-xs text-muted" href="{{$simular->content['repository']}}">
                                {{$simular->content['name']}}
                            </a>
                            <p class="m-t-sm">
                                <span class="m-r-md"><i class="icon-star m-r-xs"></i>{{number_format($simular->content['github_stars'])}}</span>
                                <span><i class="icon-cloud-download m-r-xs"></i>{{number_format($simular->content['downloads']['total'])}}</span>
                            </p>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
        @endif

    </div>

</div>
@endsection
