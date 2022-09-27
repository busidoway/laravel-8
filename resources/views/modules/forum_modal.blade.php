<div class="modal fade form-modal" id="forumModal"  aria-hidden="true">
    <div class="tab-pane modal-content modal-dialog modal_form px-4 py-5">
        <form class="needs-validation form_feedback mb-0" name="forum_modal" method="post">
            @csrf
            <div class="modal-header border-0 mb-0 px-3">
                <div class="h5 col-12 fw-bold mb-0 p-0">Регистрация на мероприятие</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <input type="hidden" name="header" value="Регистрация на форум">
            <!-- <input type="hidden" name="title"> -->
            <input type="hidden" name="date">
            <div class="mb-3 justify-content-center">
                <div class="col-12 mb-2">
                    <input type="text" name="last_name" class="form-control" placeholder="Фамилия ответственного лица*" autocomplete="off" required>
                    <div class="invalid-feedback">Обязательное поле</div>
                </div>
                <div class="col-12 mb-2">
                    <input type="text" name="first_name" class="form-control" placeholder="Имя ответственного лица*" autocomplete="off" required>
                    <div class="invalid-feedback">Обязательное поле</div>
                </div>
                <div class="col-12 mb-2">
                    <input type="text" name="middle_name" class="form-control" placeholder="Отчество ответственного лица*" autocomplete="off" required>
                    <div class="invalid-feedback">Обязательное поле</div>
                </div>
                <div class="col-12 mb-2">
                    <input type="text" name="field_req[Учебное заведение]" class="form-control" placeholder="Учебное заведение*" autocomplete="off" required>
                    <div class="invalid-feedback">Обязательное поле</div>
                </div>
                <div class="col-12 mb-2">
                    <input type="text" name="phone" class="form-control mask-input" placeholder="Номер телефона*" autocomplete="off" maxlength="16" required>
                    <div class="invalid-feedback">Обязательное поле</div>
                </div>
                <div class="col-12 mb-2">
                    <input type="text" name="email" class="form-control" placeholder="E-mail*" autocomplete="off" required>
                    <div class="invalid-feedback">Обязательное поле</div>
                </div>
                <div class="col-12 mb-2">
                    <select name="field_req[Количество участников]" id="count_persons" class="form-control form-select">
                        <option>Количество участников...</option>
                        @for($i=1; $i <= 50; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <div class="invalid-feedback">Обязательное поле</div>
                </div>
            </div>
            <div class="g-recaptcha d-flex justify-content-center my-3" id="recaptcha_forum"></div>
            <div class="text-danger" id="recaptchaError"></div>
            <div class="d-flex mb-0 justify-content-center">
                <button class="btn btn-primary send_form" type="submit">Зарегистрироваться</button>
            </div>
        </form>
    </div>
</div>