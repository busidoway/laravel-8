<div class="d-block mb-4 mb-md-0">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="#">Админ</a></li>
            @isset($title_nav)<li class="breadcrumb-item active" aria-current="page">@isset($title_nav_route)<a href="{{ route($title_nav_route) }}">@endisset{{ $title_nav }}@isset($title_nav_route)</a>@endisset</li>@endisset
        </ol>
    </nav>
    @isset($title)<h2 class="h4">{{ $title }}</h2>@endisset
    @isset($subtitle)<p class="mb-0">{{ $subtitle }}</p>@endisset
</div>