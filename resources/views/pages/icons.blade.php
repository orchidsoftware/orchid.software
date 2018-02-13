@extends('layouts.app')

@section('title','Icons')
@section('description','Icons')


@section('content')


    <div class="bg-white-only">

        <div class="container">
            <div class="row m-t-md m-b-md">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                        <h1 class="font-thin l-h-1x text-black">
                            Icons Preview
                        </h1>
                        <p class="text-muted m-b-lg">
                            Click on the icons to get the icon class name<br>
                            The source code is located on <a href="https://github.com/orchidsoftware/icons" target="_blank">github</a>
                        </p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group form-group-default m-t-xl">
                                <label>Search Icons</label>
                                <div class="controls">
                                    <input type="text"   id="quick-search"  placeholder="Search..." class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>


                @foreach(config('icons') as $icon)
                    <div class="icon-preview-box col-xs-6 col-md-3 col-lg-3">
                        <div class="preview">
                            <a href="#" class="show-code" title="click to show css class name"><i
                                        class="icon-{{$icon}} icons"></i><span class="name">{{$icon}}</span> <code
                                        class="code-preview">.icon-{{$icon}}</code></a>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
@endsection
