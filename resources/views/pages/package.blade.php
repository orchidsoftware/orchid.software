@extends('layouts.app')

@section('title',$package->content['info']['name'])
@section('description',$package->content['info']['description'])


@section('content')

    <div class="bg-white-only">

    <div class="container">
                <div class="row m-t-md m-b-md">

                    <div class="col-md-3 b-r b-light">



                        <p class="h3 font-thin text-black">Maintainers:</p>
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


                    </div>

                    <div class="col-md-9 col-xs-12 wrapper-lg">

                        <main>

                            {!! $content !!}

                        </main>

                    </div>
                </div>
            </div>

</div>
@endsection
