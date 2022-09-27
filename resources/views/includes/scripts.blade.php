<script type="text/javascript"  src="/js/scripts.js?1628417312255228"></script>
<script type="text/javascript"  src="/js/page_d7d8e975aea49906f92618161dd493dc_v1.js?16284173124143"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.maskedinput.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>
<script>
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl, {
     html: true
  })
})
</script>
<script type="text/javascript">
	var onloadCallback = function() {
        var mysitekey = '';

		$('.card').find('.header-link').on('click', function(e){
            e.preventDefault();
        });

        $('.btn-modal').on('click', function(e){
            var modal = $('.form-modal');
            var card = $(this).closest('.card');
            var card_title = card.find('.header-link').prop('title');
            var card_date = card.find('.event-date').data('date');
			let this_header = $(this).data('header');
			let this_title = $(this).data('title');
            modal.find('.form__card-title').text(card_title);
            modal.find('input[name=title]').val(card_title);
            modal.find('input[name=date]').val(card_date);
			if(this_header) modal.find('input[name=header]').val(this_header);
			if(this_title) modal.find('input[name=title]').val(this_title);
            modal.children('div').children('.modal-header').remove();
            modal.find('form').show();
            modal.find('form')[0].reset();
			let recaptchaId = $(this).data('recaptcha-id');
			let recaptchaRender = grecaptcha.render(recaptchaId, {
				'sitekey' : mysitekey
			});
			let form_type = "modal";
			sendForm(recaptchaRender, form_type);
			grecaptcha.reset();
        });

		$('.btn-form-modal').on('click', function(e){
			let recaptchaId = $(this).data('recaptcha-id');
			let recaptchaRender = grecaptcha.render(recaptchaId, {
				'sitekey' : mysitekey
			});
			let form_type = "modal";
			sendForm(recaptchaRender, form_type);
			grecaptcha.reset();
		});

		$('.btn-modal-video').on('click', function(e){
            let modal = $('.form-modal');
            let video_title = $(this).data('title');
            modal.find('input[name=title]').val(video_title);
			let recaptchaId = $(this).data('recaptcha-id');
			let recaptchaRender = grecaptcha.render(recaptchaId, {
				'sitekey' : mysitekey
			});
			let form_type = "modal";
			sendForm(recaptchaRender, form_type);
			grecaptcha.reset();
        });

		if($('.form-static').length > 0){
			let recaptchaId = $('.form-static').find('.g-recaptcha').data('recaptcha-id');
			let recaptchaRender = grecaptcha.render(recaptchaId, {
				'sitekey' : mysitekey
			});
			sendForm(recaptchaRender);
			grecaptcha.reset();
		}

		function sendForm(captcha_id, form_type = "static"){
			$(".send_form").on('click', function(e){
				var t = $(this);

				e.preventDefault();

				var captcha = grecaptcha.getResponse(captcha_id);

				var form = t.closest('form');

				var formData = new FormData(form.get(0));
				

				if (!captcha.length) {
					$('#recaptchaError').html('<div class="text-center mb-3">* Вы не прошли проверку "Я не робот"</div>');
				} else {
					$('#recaptchaError').html('');
				}

				if (captcha.length) {

					formData.append('g-recaptcha-response', captcha);
				
					$.ajax({
						type: 'POST',
						url: '/api/feedback',
						contentType: false,
						processData: false,
						data: formData,
						dataType: 'json',
						beforeSend: function(xhr){
							t.find('.spinner-border').show();
						},
						success: function(data) {
							
							// console.log(data);

							t.find('.spinner-border').hide();
							
							if(data.captcha == 'success'){
							
								let mess = '<div class="modal-header justify-content-center border-0"><div class="text-success text-center fs-3 col-12 py-5">Заявка отправлена</div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';

								let mess_modal = '<div class="modal fade form-modal" id="modalSuccess" aria-hidden="true">'+
												   '<div class="modal-dialog modal-dialog-centered">'+
    											  '<div class="tab-pane modal-content modal-dialog modal_form px-4 py-5">'+
												  '<div class="text-success text-center fs-3 col-12 py-5">Заявка отправлена</div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
												  '</div></div></div>';

								form.find('.form-control').removeClass('border border-danger');
								form.find('.invalid-feedback').hide();

								if(data.status == 'error'){
									if(data.error_input) {
										$('input[name="'+data.error_input+'"]').addClass('border border-danger');
										$('input[name="'+data.error_input+'"]').next('.invalid-feedback').show();
									}
									if(data.error_info){
										let mess_modal_error = '<div class="modal fade form-modal" id="modalSuccess" aria-hidden="true">'+
												   		'<div class="modal-dialog modal-dialog-centered">'+
    											  		'<div class="tab-pane modal-content modal-dialog modal_form px-4 py-5">'+
												  		'<div class="text-danger text-center fs-3 col-12 py-5">Ошибка отправки</div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
												  		'</div></div></div>';
										$('body').append(mess_modal_error);
									}
								}else{
									if(form_type == "modal"){
										form.hide();
										form.closest('div').append(mess);
									}else{
										$('body').append(mess_modal);
										var myModal = new bootstrap.Modal(document.getElementById('modalSuccess'), {
											keyboard: false
										})
										myModal.show();
										form[0].reset();
										// grecaptcha.reset();
									}
								}

							}else{
								
								$('#recaptchaError').text(data.msg);
							}
							grecaptcha.reset();
						},
						error:  function(xhr, str){
							t.find('.spinner-border').hide();

							let mess_modal_error = '<div class="modal fade form-modal" id="modalSuccess" aria-hidden="true">'+
												   '<div class="modal-dialog modal-dialog-centered">'+
    											  '<div class="tab-pane modal-content modal-dialog modal_form px-4 py-5">'+
												  '<div class="text-danger text-center fs-3 col-12 py-5">Ошибка отправки</div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'+
												  '</div></div></div>';
							
							$('body').append(mess_modal_error);

							// console.log('Возникла ошибка: ' + xhr.responseCode);
						}
					});

				}

			});
		}
		
    };
</script>
<script>
    $(function(){
        $(".mask-input").mask("+7(999) 999-9999");
    });
</script>
<script src="/js/datepicker.min.js"></script>
<script>
$(function(){
	$('a.scrollto').on('click', function() {

		let href = $(this).attr('href');
	
		$('html, body').animate({
			scrollTop: $(href).offset().top
		}, {
			duration: 370
		});
	
		return false;
	});
});
</script>