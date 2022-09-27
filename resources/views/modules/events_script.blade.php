<script>
    $(function(){

        $('.card').find('.header-link').on('click', function(e){
            e.preventDefault();
        });

        $('.btn-modal').on('click', function(e){
            let modal = $('.form-modal');
            let card = $(this).closest('.card');
            let card_title = card.find('.header-link').prop('title');
            let card_date = card.find('.event-date').data('date');
            modal.find('.form__card-title').text(card_title);
            modal.find('input[name=title]').val(card_title);
            modal.find('input[name=date]').val(card_date);
            modal.children('div').children('.modal-header').remove();
            modal.find('form').show();
            modal.find('form')[0].reset();
            grecaptcha.reset();
        });

        $('.btn-modal-video').on('click', function(e){
            let modal = $('.form-modal');
            let video_title = $(this).data('title');
            modal.find('input[name=title]').val(video_title);
        });

        $(".send_form").on('click', function(e){
            var t = $(this);
            // console.log(t);
            var send_form = sendForm(e, t, recaptchaForumReg);
        });

    });

    function sendForm(e, t, captcha_id){
        // $(".send_form").on('click', function(e){
            // var t = $(this);

            e.preventDefault();

            // var captcha_id = t.closest('form').find('.g-recaptcha').prop('id');

            // console.log(captcha_id);

            var captcha = grecaptcha.getResponse(captcha_id);

            var form = t.closest('form');
            var event_date = form.find('input[name=date]').val();
            var msg = form.serialize() + event_date;

            if (!captcha.length) {
                $('#recaptchaError').html('<div class="text-center mb-3">* Вы не прошли проверку "Я не робот"</div>');
            } else {
                $('#recaptchaError').html('');
            }

            if (captcha.length) {

                msg = msg + '&g-recaptcha-response=' + captcha;
            
                $.ajax({
                    type: 'POST',
                    url: '/api/feedback',
                    data: msg,
                    dataType: 'json',
                    success: function(data) {    
                        
                        if(data.captcha == 'success'){
                        
                            let mess = '<div class="modal-header justify-content-center border-0"><div class="text-success text-center fs-3 col-12 py-5">Заявка отправлена</div><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>';

                            form.find('.form-control').removeClass('border border-danger');
                            form.find('.invalid-feedback').hide();

                            if(data.status == 'error'){
                                $('input[name="'+data.error_input+'"]').addClass('border border-danger');
                                $('input[name="'+data.error_input+'"]').next('.invalid-feedback').show();
                            }else{
                                form.hide();
                                form.closest('div').append(mess);
                            }

                        }else{
                            grecaptcha.reset();
                            $('#recaptchaError').text(data.msg);
                        }
                    },
                    error:  function(xhr, str){
                        console.log('Возникла ошибка: ' + xhr.responseCode);
                    }
                });

            }

        // });
    }
</script> 