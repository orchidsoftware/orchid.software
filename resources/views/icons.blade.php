@extends('docs')

@section('sub-main')
    <div class="row text-black">
        @foreach($icons as $name => $svg)
            <div class="icon-preview-box col-6 col-md-3 col-lg-3">
                <div class="preview">
                    {!! $svg !!}
                    <small class="ml-2 name ">{{$name}}</small>
                </div>
            </div>
        @endforeach
    </div>

    <p class="mt-4 text-muted">
        The source code is located on <a href="https://github.com/orchidsoftware/icons" target="_blank">github</a>
    </p>
@endsection
