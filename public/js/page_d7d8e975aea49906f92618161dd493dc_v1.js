
; /* Start:"a:4:{s:4:"full";s:51:"/local/templates/pnk/js/ajax-form.js?16172134142463";s:6:"source";s:36:"/local/templates/pnk/js/ajax-form.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
jQuery(function ($) {
    function initScript() {
        let form = $('form.pnk-form');
        $('input[type=checkbox]').on('click', function () {
            $(this).prop('checked') ? $(this).val('Да') : '';
        })

        $('input[name~="PHONE"]').mask(
            '+7 000 000-00-00',
            {placeholder: "+7 ___ ___-__-__"}
        );

        $('button[type=submit]').on('click', function (event) {
            form.addClass('was-validated');
        });

        $('button[type=reset]').on('click', function (event) {
            form.removeClass('was-validated');
        });

        form.on('submit', function (event) {
            event.preventDefault();
            $(this).find('#chekSpam').val('goodCheck');
            let formData = $(this).serialize();
            sendAjax(formData);
        });

        function sendAjax(formData) {
            $.ajax({
                url: '/ajax/send/',
                type: 'post',
                data: formData,
                beforeSend: function () {
                    $("form.pnk-form").find('button').prop("disabled", true);
                    $('#formModal .modal-body').hide();
                },
                complete: function () {
                    $("form.pnk-form").find('button').prop("disabled", false);
                },
                success: function(response) {
                    console.log(response);
                    if (response.status === 'good') {
                        $('#formModal .modal-body-good').show();
                        $('#formEventModal').modal('hide');
                    } else {
                        $('#formModal .modal-body-bad').hide();
                    }

                    if (response.responseError) {
                        $('#formModal .modal-body-good').hide();
                        $('#formModal .modal-body-bad p').html(response.responseError);
                        $('#formModal .modal-body-bad').show();
                    }
                }
            }).done(function (){
                $('form.pnk-form').trigger("reset");
                $('#formModal').modal({keyboard: false})
                $('#formModal').on('hidden.bs.modal', function (e) {
                    $('#formModal .modal-body').hide();
                })
                $('form.pnk-form').removeClass('was-validated');
            });
        }
    }

    $(document).ready(function() {
        initScript();
    });
});
/* End */
;
; /* Start:"a:4:{s:4:"full";s:59:"/local/templates/pnk/js/form-events-script.js?1613139334509";s:6:"source";s:45:"/local/templates/pnk/js/form-events-script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
jQuery(function ($) {
    $(document).ready(function() {
        $('#formEventModal').on('show.bs.modal', function (e) {
            let formTarget = $(e.relatedTarget);
            let eventName = formTarget.data('event-name');
            let eventId = formTarget.data('event-id');

            let modal = $(e.currentTarget);
            modal.find('.event-title').html(eventName);
            modal.find('#eventId').val(eventId);
            modal.find('#eventName').val(eventName);
        })
    });
});
/* End */
;
; /* Start:"a:4:{s:4:"full";s:51:"/local/templates/pnk/js/news-share.js?1597330119380";s:6:"source";s:37:"/local/templates/pnk/js/news-share.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
$(document).ready(function() {
    $('.news-share__link').click(function(e){
        e.preventDefault();
        $(this).find('.news-share__social-icons').toggle();
    });
    $(document).on('click', function(e) {
        if (!$(e.target).closest(".news-share__link").length) {
            $('.news-share__social-icons').hide();
        }
        e.stopPropagation();
    });
});
/* End */
;; /* /local/templates/pnk/js/ajax-form.js?16172134142463*/
; /* /local/templates/pnk/js/form-events-script.js?1613139334509*/
; /* /local/templates/pnk/js/news-share.js?1597330119380*/
