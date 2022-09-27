<section class="jumbotron jumbotron-fluid position-relative asd" id="slideshow">
		        <div class="owl-carousel owl-theme" data-dots="true" data-nav="true" data-drag="true" data-nav-container=".owl-nav-buttons" data-items="1">
                    @foreach($slider as $s)
                    <div class="slider-item">
					    <div class="slider-item__img" style="background-color:#f2f2f2"></div>
					    <div class="container container-slider">
						    <div class="h-100">
							    <div class="slider-item__content h-100 pt-3 pl-1 d-flex flex-column justify-content-between">
                                    <div class="">
                                        <div class="title-1 col-12 slide-1-title mt-5 mb-2 fw-bold" style="font-size:1.2rem;">{!! $s->title !!}</div>
                                        @isset($s->text1)<div class="text-1 col-12 subtitle-h3 slide-1-subtitle mb-2 font-weight-normal">{!! $s->text1 !!}</div>@endisset
                                        @isset($s->text2)<div class="text-2 col-12 slide-1-subtitle mb-2 font-weight-normal">{!! $s->text2 !!}</div>@endisset
                                    </div>
                                    <div class="slider-item__bottom d-flex row mx-0">
                                        <div class="text-2 col-md-7 col-12" style="justify-content: flex-start; padding-top: 0px; font-size:16px;">
                                            @isset($s->text3)<div class="text-3 slide-1-subtitle mb-2 font-weight-normal">{!! $s->text3 !!}</div>@endisset
                                            <a href="{{ $s->url }}" id="btn_slider" class="btn btn-md mt-lg-1 btn-atknin-white">Подробнее</a>
                                        </div>
                                        <div class="img-1 col-md-5 col-12" style="">
                                            <img src="{{ $s->image }}" class="w-100 slider-img d-block" alt="">
                                        </div>
                                    </div>
								</div>
						    </div>
					    </div>
			        </div>
                    @endforeach
				</div>

                <div class="owl-nav-container d-flex justify-content-center">
                    <div class="owl-nav-buttons__left"><i class="icon icon-left"></i></div>
                    <div class="owl-dots"></div>
                    <div class="owl-nav-buttons__right"><i class="icon icon-right"></i></div>
                </div>
            </section>