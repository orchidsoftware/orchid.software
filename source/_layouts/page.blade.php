@extends('_layouts.master')

@include('_lang.en')

@section('content')

    <main class="bg-white-only how-to-do-it">
        <div class="container">
            <div class="row pt-5 pb-5 container">
                <div class="col-md-4">
                    @include('en.sidebar')
                </div>
                <div class="col-md-8">
                    <main>
                        @yield('main')
                    </main>
                </div>
            </div>
        </div>
    </main>

@endsection