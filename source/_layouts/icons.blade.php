@extends('_layouts.documentation')

@section('main')
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group form-group-default">
                <label>Search Icons</label>
                <div class="controls">
                    <input type="text"   id="quick-search"  placeholder="Search..." class="form-control">
                </div>
            </div>
        </div>

        <div class="row mt-3 text-black">
            @foreach($page->icons() as $icon)
                <div class="icon-preview-box col-6 col-md-3 col-lg-3">
                    <div class="preview">
                        {!! $page->getIcon($icon) !!}
                        <small class="ml-2 name ">{{$icon}}</small>
                    </div>
                </div>
            @endforeach
        </div>

        <p class="mt-5 text-muted">
            The source code is located on <a href="https://github.com/orchidsoftware/icons" target="_blank">github</a>
        </p>

        @yield('sub-main')

    </div>
@endsection

