@extends('docs')

@section('sub-main')
    <div class="icon-grid">
        @foreach($icons as $name => $svg)
            <div class="icon">
                <div class="content">
                    {!! $svg !!}
                    <small class="name">{{$name}}</small>
                </div>
            </div>
        @endforeach
    </div>

    <p class="icon-source">
        The source code is located on <a href="https://github.com/orchidsoftware/icons" target="_blank">github</a>
    </p>
@endsection
