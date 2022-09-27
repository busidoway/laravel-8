<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="/">
        <img class="navbar-brand-dark" src="/assets/img/brand/light.svg" alt="Volt logo" /> <img class="navbar-brand-light" src="/assets/img/brand/dark.svg" alt="Volt logo" />
    </a>
    <div class="d-flex align-items-center">
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
  <div class="sidebar-inner px-4 pt-3">
    <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
      <div class="d-flex align-items-center">
        <div class="avatar-lg me-4">
          <img src="../../assets/img/team/profile-picture-3.jpg" class="card-img-top rounded-circle border-white"
            alt="Bonnie Green">
        </div>
        <div class="d-block">
          <h2 class="h5 mb-3">Hi, Jane</h2>
          <a href="../../pages/examples/sign-in.html" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>            
            Выйти
          </a>
        </div>
      </div>
      <div class="collapse-close d-md-none">
        <a href="#sidebarMenu" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true"
            aria-label="Toggle navigation">
            <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          </a>
      </div>
    </div>
    <ul class="nav flex-column pt-3 pt-md-0">
        <li class="nav-item">
            <a href="{{ route('home') }}" target="_blank" class="nav-link d-flex align-items-center">
            <span class="sidebar-icon">
                <img src="/assets/img/brand/light.svg" height="20" width="20" alt="Volt Logo">
            </span>
            <span class="mt-1 ms-1 sidebar-text">Перейти на сайт</span>
            </a>
        </li>
        <li class="nav-item  {{ (Route::is('admin.slider') ? 'active' : '') }} ">
            <a href="{{ route('admin.slider') }}" class="nav-link">
            <span class="sidebar-icon">
                <i class="fas fa-images"></i>
            </span>
            <span class="sidebar-text">Слайдер</span>
            </a>
        </li>
        <li class="nav-item  {{ (Route::is('admin.news') ? 'active' : '') }} ">
            <span class="nav-link {{ (Route::is('admin.news') || Route::is('admin.news_category') ? '' : 'collapsed') }} d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-news">
                <span>
                    <span class="sidebar-icon">
                        <i class="far fa-newspaper"></i>
                    </span>
                    <span class="sidebar-text">Новости</span>
                </span>
                <span class="link-arrow">
                    <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </span>
            </span>
            <div class="multi-level collapse {{ (Route::is('admin.news') || Route::is('admin.news_category')  ? 'show' : '') }} " role="list" id="submenu-news" aria-expanded="false">
                <ul class="flex-column nav">
                    <li class="nav-item {{ (Route::is('admin.news') ? 'active' : '') }}">
                        <a href="{{ route('admin.news') }}" class="nav-link">
                            <span class="sidebar-text">Список</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (Route::is('admin.news_category') ? 'active' : '') }}">
                        <a href="{{ route('admin.news_category') }}" class="nav-link">
                            <span class="sidebar-text">Категории</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item  {{ (Route::is('admin.events') ? 'active' : '') }} ">
            <a href="{{ route('admin.events') }}" class="nav-link">
            <span class="sidebar-icon">
                <i class="fas fa-calendar-alt"></i>
            </span>
            <span class="sidebar-text">Мероприятия</span>
            </a>
        </li>
        <li class="nav-item  {{ (Route::is('admin.viewpoints') ? 'active' : '') }} ">
            <a href="{{ route('admin.viewpoints') }}" class="nav-link">
            <span class="sidebar-icon">
                <i class="fas fa-calendar-day"></i>
            </span>
            <span class="sidebar-text">Точка зрения</span>
            </a>
        </li>
        <li class="nav-item">
            <span class="nav-link {{ (Route::is('admin.video') || Route::is('admin.video_load') ? '' : 'collapsed') }} d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-video">
                <span>
                    <span class="sidebar-icon">
                        <i class="fas fa-film"></i>
                    </span>
                    <span class="sidebar-text">Видео</span>
                </span>
                <span class="link-arrow">
                    <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </span>
            </span>
            <div class="multi-level collapse {{ (Route::is('admin.video') || Route::is('admin.video_load')  ? 'show' : '') }} " role="list" id="submenu-video" aria-expanded="false">
                <ul class="flex-column nav">
                    <li class="nav-item {{ (Route::is('admin.video') ? 'active' : '') }}">
                        <a href="{{ route('admin.video') }}" class="nav-link">
                            <span class="sidebar-text">Список</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (Route::is('admin.video_load') ? 'active' : '') }}">
                        <a href="{{ route('admin.video_load') }}" class="nav-link">
                            <span class="sidebar-text">Загрузка</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item  {{ (Route::is('admin.persons') ? 'active' : '') }} ">
            <a href="{{ route('admin.persons') }}" class="nav-link">
            <span class="sidebar-icon">
                <i class="fas fa-user-tie"></i>
            </span>
            <span class="sidebar-text">Сотрудники</span>
            </a>
        </li>
        <li class="nav-item  {{ (Route::is('admin.users') ? 'active' : '') }} ">
            <a href="{{ route('admin.users') }}" class="nav-link">
            <span class="sidebar-icon">
                <i class="fas fa-users"></i>
            </span>
            <span class="sidebar-text">Пользователи</span>
            </a>
        </li>
        <li class="nav-item">
            <span class="nav-link {{ (Route::is('admin.reestr') || Route::is('admin.reestr_load') ? '' : 'collapsed') }} d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-reestr">
                <span>
                    <span class="sidebar-icon">
                        <i class="fas fa-list-alt"></i>
                    </span>
                    <span class="sidebar-text">Реестр</span>
                </span>
                <span class="link-arrow">
                    <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </span>
            </span>
            <div class="multi-level collapse {{ (Route::is('admin.reestr') || Route::is('admin.reestr_load')  ? 'show' : '') }} " role="list" id="submenu-reestr" aria-expanded="false">
                <ul class="flex-column nav">
                    <li class="nav-item {{ (Route::is('admin.reestr') ? 'active' : '') }}">
                        <a href="{{ route('admin.reestr') }}" class="nav-link">
                            <span class="sidebar-text">Список</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (Route::is('admin.reestr_load') ? 'active' : '') }}">
                        <a href="{{ route('admin.reestr_load') }}" class="nav-link">
                            <span class="sidebar-text">Загрузка</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <span class="nav-link {{ (Route::is('admin.reestr_org') || Route::is('admin.reestr_org_load') ? '' : 'collapsed') }} d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-reestr-org">
                <span>
                    <span class="sidebar-icon">
                        <i class="fas fa-list-alt"></i>
                    </span>
                    <span class="sidebar-text">Реестр организаций</span>
                </span>
                <span class="link-arrow">
                    <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </span>
            </span>
            <div class="multi-level collapse {{ (Route::is('admin.reestr_org') || Route::is('admin.reestr_org_load')  ? 'show' : '') }} " role="list" id="submenu-reestr-org" aria-expanded="false">
                <ul class="flex-column nav">
                    <li class="nav-item {{ (Route::is('admin.reestr_org') ? 'active' : '') }}">
                        <a href="{{ route('admin.reestr_org') }}" class="nav-link">
                            <span class="sidebar-text">Список</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (Route::is('admin.reestr_org_load') ? 'active' : '') }}">
                        <a href="{{ route('admin.reestr_org_load') }}" class="nav-link">
                            <span class="sidebar-text">Загрузка</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item  {{ (Route::is('admin.menu') ? 'active' : '') }} ">
            <a href="{{ route('admin.menu') }}" class="nav-link">
            <span class="sidebar-icon">
                <i class="fas fa-bars"></i>
            </span>
            <span class="sidebar-text">Меню</span>
            </a>
        </li>
    </ul>
  </div>
</nav>
