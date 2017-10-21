@extends('layouts.app')

@section('content')



    <div class="container m-t-xxl">
<div class="panel b box-shadow wrapper-lg">
<div class="row">
<div class="col-md-3 b-r b-light">

<nav class="navi clearfix  wrapper-sm">
<ul class="nav">
<li class="hidden-folded text-danger padder m-t m-b-sm text-xs">
<span>Мой профиль</span>
</li>
<li>
<a href="https://liptur.ru/ru/profile/liked">
<i class="icon-heart"></i>
<span>Нравится</span>
</a>
</li>
<li>
<a href="https://liptur.ru/ru/profile/route">
<i class="icon-location-pin"></i>
<span>Маршруты</span>
</a>
</li>
<li>
<a href="https://liptur.ru/ru/profile/comments">
<i class="icon-speech"></i>
<span>Комментарии</span>
</a>
</li>
<li class="hidden-folded text-danger padder m-t m-b-sm text-xs">
<span class="">Общие настройки</span>
</li>
<li>
<a href="https://liptur.ru/ru/profile">
<i class="icon-wrench"></i>
<span>Настройка</span>
</a>
</li>
<li>
<a href="https://liptur.ru/ru/profile/password">
<i class="icon-lock-open"></i>
<span>Смена пароля</span>
</a>
</li>
<li class="disabled" title="Данная функция временно не доступна">
<a href="#">
<i class="icon-wallet"></i>
<span>Платежи</span>
</a>
</li>
</ul>
<ul class="nav">
</ul>
 <ul class="nav">
<li class="hidden-folded text-danger padder m-t m-b-sm text-xs">
<span class="">Управление</span>
</li>
<li>
<a href="https://liptur.ru/dashboard" title="Коммандная панель">
<i class="icon-speedometer"></i>
<span>Администрирование</span>
</a>
</li>
<li class="disabled" title="Данная функция временно не доступна">
<a href="#">
<i class="icon-support"></i>
<span>Помощь</span>
</a>
</li>
<li>
<a href="https://liptur.ru/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
<i class="icon-logout"></i>
<span>Выйти</span>
</a>
<form id="logout-form" action="https://liptur.ru/ru/logout" method="POST">
<input type="hidden" name="_token" value="FgNjegkdDHvprEhyj3o9w6ERaHnmgqJDGddU8pSt">
</form>
</li>
</ul>
</nav>

</div>
<div class="col-md-9 ">
<div class="wrapper-md">
<form class="form-horizontal" action="https://liptur.ru/ru/profile" method="POST" enctype="multipart/form-data">
<div class="row">
<div class="col-sm-9">
<div class="fileinput fileinput-exists thumb-lg pull-left m-r-md" data-provides="fileinput">
<div class="btn-file">
<div class="user-avatar fileinput-preview  thumb-lg pull-left m-r-md">
<img src="/storage/2017/06/20/0de3106db08808431f4efd416e96c4c3b12cb93d.jpg" alt="Нажмите, что бы изменить изображение" class="img-circle">
</div>
<input type="file" name="avatar" size="2MB" accept="image/jpeg,image/png,image/gif">
</div>
</div>
<div class="clear m-b">
<div class="m-b m-t-xxl">
<span class="h3 text-black">tabuna</span>
</div>
</div>
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Полное имя</label>
<div class="col-sm-9">
<input type="text" name="name" class="form-control form-control-grey" value="tabuna" placeholder="Ваше полное имя" maxlength="120">
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Электронная почта</label>
<div class="col-sm-9">
<input type="email" name="email" class="form-control form-control-grey" value="tabuna@gmail.com" placeholder="Электронная почта" maxlength="120">
</div>
</div>
<div class="form-group">
 <label class="col-sm-3 control-label">Веб-сайт</label>
<div class="col-sm-9">
<input type="url" name="website" class="form-control form-control-grey" value="" placeholder="Личный веб-сайт" maxlength="255">
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Телефон</label>
<div class="col-sm-9">
<input type="tel" name="phone" class="form-control form-control-grey" data-mask="+ 9-999-999-99-99" value="" placeholder="Номер телефона">
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Адрес</label>
<div class="col-sm-9">
<input type="text" name="address" class="form-control form-control-grey" value="" placeholder="Где вы находитесь">
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">О себе</label>
<div class="col-sm-9">
<textarea class="form-control form-control-grey no-resize" rows="6" name="about" placeholder="Небольшой рассказ о себе"></textarea>
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-3 col-sm-9">
<label class="i-checks i-checks-sm">
<input type="radio" name="sex" value="1">
<i></i>
Мужчина
</label>
<label class="i-checks i-checks-sm">
<input type="radio" name="sex" value="0" checked="">
<i></i>
Женщина
</label>
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-3 col-sm-9">
<label class="i-checks i-checks-sm">
<input type="radio" name="notification" value="1" checked="">
<i></i>
Подписаться на уведомления
</label>
<label class="i-checks i-checks-sm">
<input type="radio" name="notification" value="0">
<i></i>
Не присылать уведомления
</label>
</div>
</div>
<input type="hidden" name="_token" value="FgNjegkdDHvprEhyj3o9w6ERaHnmgqJDGddU8pSt">
<input type="hidden" name="_method" value="PUT">
<div class="form-group">
<div class="col-sm-offset-3 col-sm-9 text-right">
<button type="submit" class="btn  btn-danger btn-rounded">Сохранить</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>


    <div class="container">
        <div class="row m-t-md m-b-md">
            <div class="col-sm-2 page-sidebar">
                <aside>
                    <div class="inner-box">
                        <div class="user-panel-sidebar">

                            <h5> Hello, Александр </h5>

                            <div class="collapse-box">
                                <h5 class="collapse-title"> YOUR ACCOUNT </h5>

                                <div class="panel-collapse collapse in" id="MyAds">
                                    <ul class="acc-list">
                                        <li><a class="" href="https://falconediting.com/order/create"><i class="fa fa-plus"></i> CREATE NEW ORDER
                                            </a></li>
                                        <li><a class="active" href="https://falconediting.com/order"><i class="fa fa-cart-arrow-down"></i>
                                                ORDER HISTORY<span class="badge pull-right">10</span>
                                            </a></li>

                                        <li><a class="" href="https://falconediting.com/setting"><i class="fa fa-cog"></i>
                                                settings </a></li>

                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>

                </aside>
            </div>

            <div class="col-sm-10 page-content">
                <div class="inner-box">




    <div class="panel panel-default">
        <div class="panel-heading">Your Orders</div>
        <table class="table">

            <thead>
            <tr>
                <th><a href="https://falconediting.com/order?sort=id&amp;order=desc">#</a> <i class="fa fa-sort"></i></th>
                <th><a href="https://falconediting.com/order?sort=created_at&amp;order=desc">Order Date</a> <i class="fa fa-sort"></i></th>
                <th><a href="https://falconediting.com/order?sort=price&amp;order=desc">Total (USD)</a> <i class="fa fa-sort"></i></th>
                <th><a href="https://falconediting.com/order?sort=name&amp;order=desc">Title</a> <i class="fa fa-sort"></i></th>
                <th><a href="https://falconediting.com/order?sort=status&amp;order=desc">Status</a> <i class="fa fa-sort"></i></th>
                <th><a href="https://falconediting.com/order?sort=sold&amp;order=desc">Payment Status</a> <i class="fa fa-sort"></i></th>
            </tr>
            </thead>


            <tbody>
                            <tr>
                    <th scope="row"><a href="https://falconediting.com/en/order/421638">41d0d4b6</a></th>
                    <td>2016-09-26</td>
                    <td>0.00</td>
                    <td>тестовая запись</td>
                    <td>Cancelled</td>

                    <th>

                                            </th>

                </tr>
                            <tr>
                    <th scope="row"><a href="https://falconediting.com/en/order/421594">b0cfce4e</a></th>
                    <td>2016-08-11</td>
                    <td>0.00</td>
                    <td>Пробный заказ</td>
                    <td>Cancelled</td>

                    <th>

                                            </th>

                </tr>
                            <tr>
                    <th scope="row"><a href="https://falconediting.com/en/order/421557">8573d0f8</a></th>
                    <td>2016-06-17</td>
                    <td>0.10</td>
                    <td>octavian</td>
                    <td>Completed</td>

                    <th>

                                            </th>

                </tr>
                            <tr>
                    <th scope="row"><a href="https://falconediting.com/en/order/421556">f274e06e</a></th>
                    <td>2016-06-17</td>
                    <td>0.00</td>
                    <td>octavian</td>
                    <td>Cancelled</td>

                    <th>

                                            </th>

                </tr>
                            <tr>
                    <th scope="row"><a href="https://falconediting.com/en/order/421541">750b448c</a></th>
                    <td>2016-06-01</td>
                    <td>0.00</td>
                    <td>rgr</td>
                    <td>Cancelled</td>

                    <th>

                                            </th>

                </tr>
                            <tr>
                    <th scope="row"><a href="https://falconediting.com/en/order/421539">34915a79</a></th>
                    <td>2016-05-30</td>
                    <td>0.00</td>
                    <td>Реализация crc32b для заказа</td>
                    <td>Cancelled</td>

                    <th>

                                            </th>

                </tr>
                            <tr>
                    <th scope="row"><a href="https://falconediting.com/en/order/421538">43966aef</a></th>
                    <td>2016-05-30</td>
                    <td>0.00</td>
                    <td>Реализация crc32b для заказа</td>
                    <td>Cancelled</td>

                    <th>

                                            </th>

                </tr>
                            <tr>
                    <th scope="row"><a href="https://falconediting.com/en/order/421537">d329777e</a></th>
                    <td>2016-05-30</td>
                    <td>0.00</td>
                    <td>Реализация crc32b для заказа</td>
                    <td>Cancelled</td>

                    <th>

                                            </th>

                </tr>
                            <tr>
                    <th scope="row"><a href="https://falconediting.com/en/order/421529">2d8a6b38</a></th>
                    <td>2016-05-13</td>
                    <td>22.02</td>
                    <td>Номер заказа должен быть большим числом</td>
                    <td>Cancelled</td>

                    <th>

                                            </th>

                </tr>
                            <tr>
                    <th scope="row"><a href="https://falconediting.com/en/order/164">72403375</a></th>
                    <td>2016-04-14</td>
                    <td>1.00</td>
                    <td>reghtrhj</td>
                    <td>Cancelled</td>

                    <th>

                                            </th>

                </tr>

            </tbody>


        </table>
    </div>






                </div>
            </div>

        </div>

    </div>



@endsection
