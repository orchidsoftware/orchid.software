@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row m-t-lg">
            <div class="col-md-8 col-md-offset-2">


                <div class="panel wrapper-xl  b box-shadow-lg  padder-lg">


                    <div class="row">

                        <form class="form  col-md-7" role="form" method="POST"
                              action="{{ url('/'.App::getLocale().'/register') }}">
                            {{ csrf_field() }}


                            <div data-mh="auth">

                                <p class="h4 font-thin text-center">Регистрация на веб-сайте</p>
                                <div class="form-group form-group-default m-t-md {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="text-sm text-left">Ваше имя</label>
                                    <input type="text" maxlength="200" min="3" name="name" value="{{ old('name') }}"
                                           required="" placeholder="Ваше имя" class="form-control">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <div class="form-group form-group-default m-t-md {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="text-sm text-left">Адрес электронной почты</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required=""
                                           placeholder="Введите Email" class="form-control">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <div class="form-group form-group-default m-t-md {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label class="text-sm text-left">Пароль</label>
                                    <input type="password" name="password" value="" required="" placeholder="Пароль"
                                           class="form-control">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <div class="form-group form-group-default m-t-md">
                                    <label class="text-sm text-left">Повторите пароль</label>
                                    <input type="password" name="password_confirmation" value="" required=""
                                           placeholder="Пароль" class="form-control">
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label class="i-checks">
                                            <input type="checkbox" name="remember" checked=""><i></i> Я принимаю правила
                                            сервиса
                                        </label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-4 text-right">
                                            <button type="submit" class="btn btn-danger btn-rounded">
                                                Зарегистрироваться
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <div class="col-md-5 b-l b-light">

                            <div data-mh="auth">


                                <i class="icon-home text-danger icon-title"></i>
                                <p class="h4 font-thin padder-v text-center">Зарегистрируйся сейчас бесплатно</p>

                                <div class="padder">
                                    <ul class="list-unstyled">
                                        <li class="m-xs"><span class="fa fa-check text-success m-r-xs"></span> Читай
                                            историю региона
                                        </li>
                                        <li class="m-xs"><span class="fa fa-check text-success m-r-xs"></span> Общайся
                                            с единомышленниками
                                        </li>
                                        <li class="m-xs"><span class="fa fa-check text-success m-r-xs"></span> Строй
                                            свои маршруты
                                        </li>
                                        <li class="m-xs"><span class="fa fa-check text-success m-r-xs"></span> Получай
                                            новости
                                        </li>
                                    </ul>
                                </div>


                            </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
