<div class="row">
    <div class="col-md-12 col-sm-12 mb-4">
        <div class="card card-module border-0 shadow components-section">
            <div class="card-body">
                @if(session('status') === true)
                <div class="py-2 mb-4 fs-5 text-success">Успешно сохранено!</div>
                @elseif(session('status') === false)
                <div class="py-2 mb-4 fs-5 text-warning">{{ $errors }}</div>
                @endif
                <form action="@if(isset($users)){{ route('users.update', $users->id) }}@else{{ route('users.store') }}@endif" method="post">
                    @csrf
                    @isset($users) @method('PUT') @endisset
                    <div class="row mb-4 mx-0">
                        <label for="name">Логин</label>
                        <div class="input-group">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Логин" value="@isset($users){{ $users->name }}@endisset" required>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="@isset($users){{ $users->email }}@endisset" required>
                        </div>
                    </div>
                    @isset($users)
                    <div class="mb-2 mx-0 row">
                        <div>
                            <input type="checkbox" name="change_password" id="changePass" class="me-2" onchange="checkPass()"><label for="changePass">Сменить пароль</label>
                        </div>
                    </div>
                    @endisset
                    <div class="row mb-4 mx-0">
                        <label for="password">Пароль</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Пароль" value="" required @isset($users) disabled @endisset>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="password_confirmation">Повторить пароль</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Повторить пароль" value="" required @isset($users) disabled @endisset>
                        </div>
                    </div>
                    <div class="row mb-4 mx-0">
                        <label for="role">Роль</label>
                        <div class="col-md-4">
                            <select class="form-select" name="role" id="role" aria-label="select">
                                @foreach($roles as $role)
                                    @if(isset($users))
                                        <option value="{{ $role->id }}" @if($role->id == $users->roles_id) {{ __('selected') }} @endif>{{ $role->title }}</option>
                                    @else
                                        <option value="{{ $role->id }}" @if($role->role == 'user') {{ __('selected') }} @endif>{{ $role->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 mx-0">
                        <div class="button-group">
                            <button type="submit" class="btn btn-success text-white">Сохранить</button>
                            <a href="{{ route('admin.users') }}" class="btn btn-gray-500 text-white ms-2">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@isset($users)
<script>
    function checkPass(){
        var changePass = document.getElementById('changePass');
        var pass = document.getElementById('password');
        var pass_conf = document.getElementById('password_confirmation');

        if(changePass.checked == true){
            pass.disabled = false;
            pass_conf.disabled = false;
        }else{
            pass.disabled = true;
            pass_conf.disabled = true;
        }
    }
</script>
@endisset