@extends('_layouts.master')

@include('_lang.en')

@section('content')

    <main class="bg-white-only how-to-do-it">
        <div class="container">
            <div class="row pt-5 pb-5 container">
                <div class="col-lg-8 offset-lg-2">
                    @yield('main')
                </div>
            </div>
        </div>
    </main>

@endsection