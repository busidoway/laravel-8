@extends('template.main')

@section('meta-title')Контакты@endsection

@section('content')
    @includeif('includes.page_title', ['page_title' => 'Контакты'])
    <div class="container page-contacts py-5">
        <div class="row">
            <div class="col-12">
                <h2 class="text-uppercase mb-6">Компания</h2>
                <div class="row">
                    <div class="col-12 col-lg-6 left-col">
                        <div class="d-flex flex-column justify-content-between h-100">
                            <div class="d-flex" style="padding-bottom: 10px;">
                                <div style="width:22px">
                                    <i class="icon icon-phone icon-2x"></i>
                                </div>
                                <div class="ps-3">
                                    <b>Телефон:</b> <a href="tel:+7 999 999-99-99<">+7 999 999-99-99</a>
                                </div>
                            </div>
                            <div class="d-flex" style="padding-bottom: 10px;">
                                <div style="width:22px">
                                    <i class="icon icon-location icon-2x"></i>
                                </div>
                                <div class="ps-3">
                                    <b>Адрес:</b> город Москва, ул. Ленина, 22
                                </div>
                            </div>
                            <div class="d-flex" style="padding-bottom: 10px;">
                                <div style="width:22px">
                                    <i class="icon icon-phone icon-2x"></i>
                                </div>
                            </div>
                            <div class="d-flex" class="contacts-worktime" style="padding-bottom: 10px;">
                                <div style="width:22px">
                                    <i class="far fa-clock" style="color:#990606; font-size: 13px; border: 1.5px solid #990606; border-radius: 100%; padding: 3px 3px 3px 4px;"></i>
                                </div> 
                                <div class="ps-3">
                                    <b>Время работы офиса:</b><br>понедельник - четверг с 10:00 до 19:00,<br class="d-block d-sm-none"> в пятницу с 10:00 до 17:00
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection