@extends('layouts.app')

@section('content')


    <div class="container padder-v">

        <div class="row m-t-lg">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel wrapper-xl b box-shadow-lg  padder-lg">
                    <div class="row">
                        <div class="col-md-7">

                            <div data-mh="auth">

                                <p class="h4 font-thin padder-v text-center">Туристско-информационные
                                    центры Липецкой области</p>


                                <form role="form" method="POST" action="{{ url('/'.App::getLocale().'/login') }}">
                                    {{ csrf_field() }}
                                    <div class="m-t-md m-b-md">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} form-group-default m-t-md">
                                            <label class="text-sm text-left">Адрес электронной почты</label>
                                            <input type="email" name="email" value="{{ old('email') }}" autofocus
                                                   required placeholder="Введите Email" class="form-control">

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                            </span>
                                            @endif

                                        </div>

                                    </div>

                                    <div class="m-t-md m-b-md">
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} form-group-default m-t-md">
                                            <label class="text-sm text-left">Пароль</label>
                                            <input type="password" name="password" placeholder="Введите пароль"
                                                   required class="form-control">


                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                            </span>
                                            @endif

                                        </div>
                                    </div>


                                    <div class="btn-group btn-group-justified m-b-md m-t-md hidden">
                                        <a href="" class="btn btn-default"><i class="fa fa-vk"></i> Вконтакте</a>
                                        <a href="" class="btn btn-default"><i class="fa fa-facebook-official"></i>
                                            Facebook</a>
                                        <a href="" class="btn btn-default"><i class="fa fa-odnoklassniki"></i>
                                            Однокласники</a>
                                    </div>


                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="i-checks">
                                                <input type="checkbox" name="remember" checked=""><i></i> Запомнить
                                                меня
                                            </label>
                                        </div>
                                    </div>


                                    {!! csrf_field() !!}


                                    <div class="row">
                                        <div class="col-md-6 text-left">
                                            <p class="m-t m-b">
                                                <a class="text-muted"
                                                   href="{{ url('/'.App::getLocale().'/password/reset') }}">Забыли
                                                    пароль?</a>
                                            </p>


                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn btn-danger btn-rounded">
                                                Войти на
                                                сайт
                                            </button>
                                        </div>
                                    </div>


                                </form>

                            </div>


                        </div>
                        <div class="col-md-5 b-l b-light">

                            <div data-mh="auth">


                                <i class="icon-login text-danger icon-title"></i>
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

                                <a href="{{ url('/'.App::getLocale().'/register') }}"
                                   class="btn btn-default btn-void-primary btn-block">Регистрация
                                </a>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection
