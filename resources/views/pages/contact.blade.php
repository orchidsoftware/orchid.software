@extends('layouts.app')

@section('content')



    <div class="bg-white box-shadow-lg">


        <section class="container">
            <div class="row wrapper-md  m-t-md m-b-xs">
                <div id="helpletter" class="col-md-6 hidden-xs hidden-sm">
                    <p class="h3 font-thin m-b-md">Вам нужна <span class="text-primary">помощь</span>?</p>


                    <p class="semi-bold no-margin">Заполните эту форму, чтобы связаться с нами, если у вас есть
                        какие-либо дополнительные вопросы</p>

                    <form role="form" id="helpletter-form" class="m-t-md" v-on:submit.prevent="send">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label class="small">Ваше имя</label>
                                    <input type="text" required class="form-control" placeholder="Иван">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group  form-group-default">
                                    <label class="small">Ваша фамилия</label>
                                    <input type="text" required class="form-control" placeholder="Иванович">
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-xs">
                            <div class="col-sm-6">
                                <div class="form-group  form-group-default">
                                    <label for="email" class="small">Ваш электронный адрес</label>
                                    <input type="email" class="form-control" name="email" required
                                           placeholder="ivanov@ivan.com">
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group form-group-default">
                                    <label for="phone" class="small">Ваш номер телефона</label>
                                    <input type="text" data-mask="+ 9-999-999-99-99" class="form-control" name="phone"
                                           required placeholder="+795554545">
                                </div>
                            </div>
                        </div>


                        <div class="form-group form-group-default  m-t-xs">
                            <label class="small">Ваше сообщение</label>
                            <textarea placeholder="Введите сообщение, которое вы хотите отправить" required rows="5"
                                      class="form-control  no-resize"></textarea>
                        </div>


                        <div class="m-t-md clearfix">
                            <p class="pull-left small m-t-xs">Настоящим я подтверждаю, что даю согласие на обработку
                                персональных данных </p>
                            <button form="helpletter-form" type="submit" class="btn btn-info btn-rounded pull-right">
                                Отправить сообщение
                            </button>
                        </div>


                        <div class="clearfix"></div>
                    </form>

                </div>
                <div class="col-md-6 col-xs-12 col-sm-12">

                    <p class="h3 font-thin m-b-md"><span class="text-primary">Контакты</span> для связи</p>

                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="block-title font-bold hint-text m-b-0">ОКУ «Центр кластерного развития туризма
                                Липецкой области» </h5>
                            <address class="m-t-10">
                                398059 г. Липецк,
                                <br> улица Фрунзе, 10
                            </address>
                            <br>

                            <p class=""><span class="font-bold">Телефон:</span>
                                <span class="font-thin"><a href="tel:+74742220360">+7(4742) 22-03-60</a></span>
                                <span class="font-thin block text"><a href="tel:88001003048">
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       8-800-100-30-48</a></span>
                            </p>
                            <p class=""><span class="font-bold">Факс:</span>
                                <span class="font-thin"><a href="tel:+74742220358">+7(4742) 22-03-58</a></span></p>
                            <br>

                            <p class=""><span class="font-bold">Электронная почта</span>
                                <span class="font-thin"><a href="mailto:tourclaster@liptur.ru ">tourclaster@liptur
                                        .ru</a></span></p>

                        </div>
                        <div class="col-sm-6">
                            <h5 class="block-title font-bold hint-text m-b-0">ОАУ «Областной Центр событийного
                                туризма» </h5>
                            <br>
                            <address class="m-t-10">
                                398024 г. Липецк,
                                <br> проспект Победы, д. 67а
                            </address>
                            <br>


                            <p class=""><span class="font-bold">Телефон:</span>
                                <span class="font-thin">+7(4742) 47-82-92</span>
                                <span class="font-thin block text"><a href="tel:88001003048">
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       8-800-200-81-20</a></span>
                            </p>

                        </div>
                    </div>


                    <div class="row">
                        <hr>
                        <div class="col-sm-6">
                            <h5 class="block-title font-bold hint-text m-b-0">Начальник управления культуры и туризма
                                Липецкой области</h5>

                            <p>Волков Вадим Геннадьевич</p>

                            <br>
                            <p class=""><span class="font-bold">Телефон:</span>
                                <span class="font-thin"><a href="tel:+74742724618">+7(4742) 72-46-18</a></span></p>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="block-title font-bold hint-text m-b-0">Заместитель начальника - начальник отдела
                                по развитию туризма</h5>

                            <p>Тимохин Андрей Николаевич</p>

                            <br>
                            <p class=""><span class="font-bold">Телефон:</span>
                                <span class="font-thin"><a href="tel:+74742272360">+7(4742) 27-23-60</a></span></p>
                        </div>
                    </div>

                </div>
            </div>
        </section>


    </div>

@endsection
