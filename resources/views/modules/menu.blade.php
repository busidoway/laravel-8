<nav id="menu" class="menu mt-2">
    <div class="submenu">
        <div class="container_mod px-2 py-0">
            <ul class="nav align-items-center">
            @php
                function buildMenu($items, $parent)
                {
                    foreach ($items as $item) {
                        if (isset($item->children)) {
                        @endphp
                            <li class="nav-item py-3">
                                <a href="{{ $item->url }}" class="nav-link">
                                    {{ $item->title }} @php if($item->label): @endphp<span class="nav-link_label">{{ $item->label }}</span>@php endif; @endphp
                                </a>
                                <div class="megamenu">
                                    <div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="megamenu-item">
                                                    <ul class="nav flex-column">
                                                        @php foreach($item->children as $child): @endphp
                                                            <li class="nav-item @php if($child->children):@endphp nav-parent @php endif; @endphp">
                                                                <a class="nav-link" href="{{ $child->url }}">{{ $child->title }}</a>
                                                                @php if($child->children):@endphp
                                                                    <div>
                                                                        <ul class="nav flex-column">
                                                                            @php buildMenu($child->children, 'nav-parent') @endphp
                                                                        </ul>
                                                                    </div>
                                                                @php endif; @endphp
                                                            </li>
                                                        @php endforeach; @endphp
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @php
                        } else {
                        @endphp
                            <li class="nav-item">
                                <a href="{{ $item->url }}" class="nav-link">{{ $item->title }} @php if($item->label): @endphp<span class="nav-link_label">{{ $item->label }}</span>@php endif; @endphp</a>
                            </li>
                        @php
                        }
                    }
                }

                buildMenu($menuitems, 'mainMenu')
            @endphp
            </ul>
        </div>
    </div>
</nav>

<nav id="mmenu" class="mm--home mm " data-mm-title="Меню">
    <ul class="">
    @php
        function buildSlideMenu($items, $parent)
        {
            foreach ($items as $item) {
                if (isset($item->children)) {
                @endphp
                    <li class="level-2@php if($item->children):@endphp parent @php endif; @endphp">
                        <a href="{{ $item->url }}">{{ $item->title }}</a>
                        <ul>
                        @php foreach($item->children as $child): @endphp
                            <li class="level-3@php if($child->children):@endphp parent @php endif; @endphp">
                                <a href="{{ $child->url }}">{{ $child->title }}</a>
                                @php if($child->children):@endphp
                                    <ul>
                                    @php buildSlideMenu($child->children, 'nav-parent') @endphp
                                    </ul>
                                @php endif; @endphp
                            </li>
                        @php endforeach; @endphp
                        </ul>
                    </li>
                @php
                } else {
                @endphp
                    <li class="level-2">
                        <a href="{{ $item->url }}">{{ $item->title }}</a>
                    </li>
                @php
                    }
                }
            }

            buildSlideMenu($menuitems, 'mainMenu')
        @endphp
    </ul>
</nav>