@extends('layouts.app')

<!-- Main Content -->
@section('content')
    <div class="container">
        <div class="row m-t-lg">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel wrapper-xl  b box-shadow-lg  padder-lg">
                    <div class="panel-heading">Востановить пароль</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ url('/'.App::getLocale().'/password/email') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail адрес</label>

                                <div class="col-md-7">
                                    <input id="email" type="email" class="form-control form-control-grey" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-8">
                                    <button type="submit" class="btn btn-danger btn-rounded">
                                        Отправить <i class="m-l-sm fa fa-paper-plane-o" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
