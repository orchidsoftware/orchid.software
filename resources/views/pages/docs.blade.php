@extends('layouts.app')

@section('title',$title)
@section('description',$description)


@section('content')

<div class="bg-white-only">

    <div class="container">
                <div class="row m-t-md m-b-md">

                    <div class="col-md-3 b-r b-light hidden-xs">

                    <nav class="nav-docs">
                            {!! $menu !!}
                    </nav>

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
