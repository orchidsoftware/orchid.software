@extends('layouts.app')

@section('title','Developer')
@section('description','Developer')


@section('content')

    <div class="bg-white">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <div class="padder-v m-t-xxl">
                        <h2 class="font-thin m-t-n l-h-1x m-b-sm text-black">
                           Помощь и обсуждение
                        </h2>
                        <p class="text-muted">
                            Single API for all supported platforms
                        </p>
                    </div>

                </div>
            </div>

            <div class="row m-t-md m-b-xl text-center">
                <div class="col-sm-3 "><p class="h3 m-b-xl inline b b-dark r-3x wrapper-lg"><i
                                class=" w-1x icon-book-open text-primary"></i></p>
                    <div class="m-b-xl">
                        <h3 class="m-t-none font-thin l-h-1x">
                            Documentation
                        </h3>
                        <p class="text-muted m-t-lg">
                            Get a basic app running, built, and ready for distribution with our Getting Started guide
                        </p>
                    </div>
                </div>
                <div class="col-sm-3"><p class="h3 m-b-xl inline b b-dark r-3x wrapper-lg"><i
                                class="w-1x icon-layers text-primary"></i></p>
                    <div class="m-b-xl">
                        <h3 class="m-t-none font-thin l-h-1x">
                            Design
                        </h3>
                        <p class="text-muted m-t-lg">Learn about the design principles that make up apps on Lorem ipsum dolor sit amet consectetur.</p></div>
                </div>
                <div class="col-sm-3"><p class="h3 m-b-xl inline b b-dark r-3x wrapper-lg"><i
                                class="w-1x icon-question text-primary"></i></p>
                    <div class="m-b-xl"><h3 class="m-t-none font-thin l-h-1x">
                            Reference
                        </h3>
                        <p class="text-muted m-t-lg">Get more info about code style, reporting issues, and proposing design changes</p></div>
                </div>
                <div class="col-sm-3"><p class="h3 m-b-xl inline b b-dark r-3x wrapper-lg"><i
                                class="w-1x icon-bubbles text-primary"></i></p>
                    <div class="m-b-xl">
                        <h3 class="m-t-none font-thin l-h-1x text-black">
                            Chat
                        </h3>
                        <p class="text-muted m-t-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam porta eget nulla sit amet convallis.</p></div>
                </div>
            </div>
        </div>
    </div>

@endsection
