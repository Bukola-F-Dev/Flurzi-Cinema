<!-- <header class="header">
    <div class="header__bottom">
        <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-xl align-items-center p-0">
                <a class="site-logo site-title" href="{{ route('home') }}"><p>Flurzi Cinema</p><span class="logo-icon"><i class="flaticon-fire"></i></span></a>
                <button class="navbar-toggler ml-auto" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" type="button" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu-toggle"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav main-menu ms-xxl-5 mx-auto">
                        <li><a href="{{ route('home') }}">@lang('Home')</a></li>
                        @foreach ($categories as $category)
                            @if ($category->subcategories->where('status', 1)->count() > 0)
                                <li class="menu_has_children">
                                    <a href="{{ route('category', $category->id) }}">{{ __($category->name) }}</a>
                                    <span><i class="las la-caret-down"></i></span>
                                    <ul class="sub-menu">
                                        @foreach ($category->subcategories as $subcategory)
                                            <li><a
                                                    href="{{ route('subCategory', $subcategory->id) }}">{{ __($subcategory->name) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ route('category', $category->id) }}">{{ __($category->name) }}</a></li>
                            @endif
                        @endforeach
                        @if (gs('genre') && json_decode(gs('genres')))
                            <li><a href="{{ route('genre') }}">@lang('Genres')</a></li>
                        @endif
                        @if (gs('tournament'))
                            <li><a href="{{ route('live.tournaments') }}">@lang('Tournaments')</a></li>
                        @endif
                        @if (gs('live_tv'))
                            <li><a href="{{ route('live.tv') }}">@lang('Live TV')</a></li>
                        @endif
                        @guest
                            <li><a href="{{ route('contact') }}">@lang('Contact')</a></li>
                        @else
                            <li class="menu_has_children">
                                <a href="javascript:void(0)">@lang('More')</a>
                                <span><i class="las la-caret-down"></i></span>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('user.deposit.history') }}">@lang('Payment History')</a></li>
                                    <li><a href="{{ route('user.wishlist.index') }}">@lang('My Wishlist')</a></li>
                                    <li><a href="{{ route('user.watch.history') }}">@lang('Watch History')</a></li>
                                    @if (gs('watch_party'))
                                        <li><a href="{{ route('user.watch.party.history') }}">@lang('Watch Party')</a></li>
                                    @endif
                                    <li><a href="{{ route('user.rented.item') }}">@lang('Rented Item')</a></li>
                                    <li><a href="{{ route('short.videos', [0, 'favorite']) }}">@lang('My Reel List')</a></li>
                                    @if (gs('request_item'))
                                        <li><a href="{{ route('user.request.item.index') }}">@lang('Request Items')</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endguest
                    </ul>
                    <div class="nav-right d-flex ml-auto flex-wrap gap-2 gap-xxl-3">
                        <button class="nav-right__search-btn"><i class="fas fa-search"></i></button>
                        @guest
                            <a href="{{ route('user.login') }}"><i class="las la-sign-in-alt"></i> @lang('Login')</a>
                            @if (gs('registration'))
                                <a href="{{ route('user.register') }}"><i class="las la-user-plus"></i>
                                    @lang('Registration')</a>
                            @endif
                        @else
                            <div class="dropdown">
                                <button class="" data-bs-toggle="dropdown" data-display="static" type="button"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="las la-user-plus"></i> {{ __(auth()->user()->username ?? 'Dashboard') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu--sm box--shadow1 dropdown-menu-right border-0 p-0">
                                    <a class="dropdown-menu__item d-flex align-items-center px-3 py-2"
                                        href="{{ route('user.profile.setting') }}">
                                        <i class="dropdown-menu__icon las la-user-circle"></i>
                                        <span class="dropdown-menu__caption">@lang('Profile Setting')</span>
                                    </a>
                                    <a class="dropdown-menu__item d-flex align-items-center px-3 py-2"
                                        href="{{ route('ticket.index') }}">
                                        <i class="dropdown-menu__icon las la-list"></i>
                                        <span class="dropdown-menu__caption">@lang('My Support Ticket')</span>
                                    </a>
                                    <a class="dropdown-menu__item d-flex align-items-center px-3 py-2"
                                        href="{{ route('ticket.open') }}">
                                        <i class="dropdown-menu__icon las la-ticket-alt"></i>
                                        <span class="dropdown-menu__caption">@lang('Create Support Ticket')</span>
                                    </a>

                                    <a class="dropdown-menu__item d-flex align-items-center px-3 py-2"
                                        href="{{ route('user.change.password') }}">
                                        <i class="dropdown-menu__icon las la-key"></i>
                                        <span class="dropdown-menu__caption">@lang('Change Password')</span>
                                    </a>

                                    <a class="dropdown-menu__item d-flex align-items-center px-3 py-2"
                                        href="{{ route('user.logout') }}">
                                        <i class="dropdown-menu__icon las la-sign-out-alt"></i>
                                        <span class="dropdown-menu__caption">@lang('Logout')</span>
                                    </a>
                                </div>
                            </div>
                            @endif
                            @if (gs('multi_language'))
                                @php
                                    $languages = App\Models\Language::all();
                                    $language = $languages->where('code', '!=', session('lang'));
                                    $activeLanguage = $languages->where('code', session('lang'))->first();
                                @endphp
                                @if (!blank($language))
                                    <div class="language dropdown">
                                        <button class="language-wrapper" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="language-content">
                                                <span class="language_flag">
                                                    <img src="{{ getImage(getFilePath('language') . '/' . @$activeLanguage->image, getFileSize('language')) }}"
                                                        alt="flag">
                                                </span>
                                                <span class="language_text_select">{{ __(@$activeLanguage->name) }}</span>
                                            </span>
                                            <span class="collapse-icon"><i class="las la-angle-down"></i></span>
                                        </button>
                                        <div class="dropdown-menu langList_dropdow py-2" style="">
                                            <ul class="langList">
                                                @foreach ($language as $item)
                                                    <li class="language-list langSel" data-lang_code="{{ $item->code }}">
                                                        <div class="language_flag">
                                                            <img src="{{ getImage(getFilePath('language') . '/' . @$item->image, getFileSize('language')) }}"
                                                                alt="flag">
                                                        </div>
                                                        <p class="language_text">{{ __(@$item->name) }}</p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <a href="{{ route('pay','basic') }}" class="btn btn-danger">Subscribe</a>

<a href="{{ route('pay','premium') }}" class="btn btn-dark">Go Premium</a>
                
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="header-search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form class="header-search-form" action="{{ route('search') }}">
                        <input name="search" type="text" placeholder="@lang('Search here')....">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

    <header class="header sticky-top" style="background: rgba(5, 1, 15, 0.85); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(255,255,255,0.08);">
    <div class="header__bottom py-3">
        <div class="container-fluid px-lg-5">
            <nav class="navbar navbar-expand-xl align-items-center p-0">
                <a class="navbar-brand d-flex align-items-center gap-2 me-lg-5" href="{{ route('home') }}">
                    <div class="logo-icon bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; box-shadow: 0 0 15px rgba(220, 53, 69, 0.4);">
                        <i class="flaticon-fire"></i>
                    </div>
                    <h4 class="mb-0 fw-bold text-uppercase tracking-wider text-white">Flurzi<span class="text-danger">Cinema</span></h4>
                </a>

                <button class="navbar-toggler border-0 shadow-none text-white" type="button" id="menuToggle">
    <span class="menu-icon">
        <i class="las la-bars fs-2"></i>
    </span>
</button>

<div class="navbar-collapse custom-mobile-menu" id="navbarSupportedContent">
 
 <div class="mobile-menu-header">
        <button class="menu-close-btn" id="menuClose">
            <i class="las la-times"></i>
        </button>
    </div>
                    <ul class="navbar-nav main-menu ms-auto align-items-center gap-3">
                  
 
@guest
{{-- ALWAYS VISIBLE --}}

@endguest


{{-- 🔵 AUTH USERS ONLY (FULL MENU) --}}
@auth
<li class="nav-item">
    <a class="nav-link text-white" href="{{ route('home') }}">
        Home
    </a>
</li>

<li class="nav-item">
    <a class="nav-link text-white" href="{{ route('contact') }}">
        Contact
    </a>
</li>
    {{-- Categories --}}
    @foreach ($categories as $category)
        @if ($category->subcategories->where('status', 1)->count() > 0)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white"
                   href="javascript:void(0)"
                   data-bs-toggle="dropdown">
                    {{ __($category->name) }}
                </a>

                <ul class="dropdown-menu bg-dark p-2">
                    @foreach ($category->subcategories as $subcategory)
                        <li>
                            <a class="dropdown-item text-white-50"
                               href="{{ route('subCategory', $subcategory->id) }}">
                                {{ __($subcategory->name) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link text-white"
                   href="{{ route('category', $category->id) }}">
                    {{ __($category->name) }}
                </a>
            </li>
        @endif
    @endforeach

    {{-- Genres --}}
    @if (gs('genre') && json_decode(gs('genres')))
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('genre') }}">
                Genres
            </a>
        </li>
    @endif

    {{-- Tournament --}}
    @if (gs('tournament'))
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('live.tournaments') }}">
                Tournaments
            </a>
        </li>
    @endif

    {{-- Live TV --}}
    @if (gs('live_tv'))
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('live.tv') }}">
                Live TV
            </a>
        </li>
    @endif

    {{-- More --}}
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown">
            More
        </a>

        <ul class="dropdown-menu bg-dark p-2">
            <li><a class="dropdown-item text-white-50" href="{{ route('user.deposit.history') }}">Payment History</a></li>
            <li><a class="dropdown-item text-white-50" href="{{ route('user.wishlist.index') }}">Wishlist</a></li>
            <li><a class="dropdown-item text-white-50" href="{{ route('user.watch.history') }}">Watch History</a></li>
        </ul>
    </li>

@endauth
</ul>

                    <!--    <li class="nav-item"><a class="nav-link fw-semibold nav-hover-link text-white" href="{{ route('home') }}">@lang('Home')</a></li>
                        
                        @foreach ($categories as $category)
                            @if ($category->subcategories->where('status', 1)->count() > 0)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle fw-semibold nav-hover-link text-white" href="{{ route('category', $category->id) }}" id="cat-{{$category->id}}" role="button" data-bs-toggle="dropdown">
                                        {{ __($category->name) }} <i class="las la-angle-down small"></i>
                                    </a>
                                    <ul class="dropdown-menu border-0 shadow-lg animate slideIn bg-dark mt-2 p-2" style="border-radius: 10px; border: 1px solid rgba(255,255,255,0.1) !important;">
                                        @foreach ($category->subcategories as $subcategory)
                                            <li><a class="dropdown-item py-2 text-white-50 hover-text-white" href="{{ route('subCategory', $subcategory->id) }}">{{ __($subcategory->name) }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item"><a class="nav-link fw-semibold nav-hover-link text-white" href="{{ route('category', $category->id) }}">{{ __($category->name) }}</a></li>
                            @endif
                        @endforeach

                        @if (gs('genre') && json_decode(gs('genres')))
                            <li class="nav-item"><a class="nav-link fw-semibold nav-hover-link text-white" href="{{ route('genre') }}">@lang('Genres')</a></li>
                        @endif
                        @if (gs('tournament'))
                            <li class="nav-item"><a class="nav-link fw-semibold nav-hover-link text-white" href="{{ route('live.tournaments') }}">@lang('Tournaments')</a></li>
                        @endif
                        @if (gs('live_tv'))
                            <li class="nav-item"><a class="nav-link fw-semibold nav-hover-link text-white" href="{{ route('live.tv') }}">@lang('Live TV')</a></li>
                        @endif

                        @guest
                            <li class="nav-item"><a class="nav-link fw-semibold nav-hover-link text-white" href="{{ route('contact') }}">@lang('Contact')</a></li>
                        @else
                        <li class="nav-item dropdown">
    <a class="nav-link nav-hover-link fw-semibold text-white dropdown-toggle nav-dropdown-link"
       href="#"
       role="button"
       data-bs-toggle="dropdown">
        @lang('More')
    </a>

    <ul class="dropdown-menu border-0 shadow-lg animate slideIn bg-dark mt-2 p-2"
        style="border-radius: 10px; border: 1px solid rgba(255,255,255,0.1);">
        
        <li><a class="dropdown-item py-2 text-white-50" href="{{ route('user.deposit.history') }}">@lang('Payment History')</a></li>
        <li><a class="dropdown-item py-2 text-white-50" href="{{ route('user.wishlist.index') }}">@lang('My Wishlist')</a></li>
        <li><a class="dropdown-item py-2 text-white-50" href="{{ route('user.watch.history') }}">@lang('Watch History')</a></li>

        @if (gs('watch_party'))
            <li><a class="dropdown-item py-2 text-white-50" href="{{ route('user.watch.party.history') }}">@lang('Watch Party')</a></li>
        @endif

        <li><a class="dropdown-item py-2 text-white-50" href="{{ route('user.rented.item') }}">@lang('Rented Item')</a></li>
        <li><a class="dropdown-item py-2 text-white-50" href="{{ route('short.videos', [0, 'favorite']) }}">@lang('My Reel List')</a></li>

        @if (gs('request_item'))
            <li><a class="dropdown-item py-2 text-white-50" href="{{ route('user.request.item.index') }}">@lang('Request Items')</a></li>
        @endif
    </ul>
</li>
                        @endguest
                    </ul> -->

                    <div class="nav-right d-flex align-items-center ms-xl-3 ps-xl-2 border-start border-secondary border-opacity-25 gap-3">
                        
                        <button class="nav-right__search-btn bg-transparent text-white search-box-bordered">
                            <i class="fas fa-search"></i>
                        </button>

                     <!--   @guest
                            <div class="auth-btns d-flex gap-2">
                            <a href="{{ route('user.login') }}" class="btn btn-sm btn-login-custom px-3 fw-bold">@lang('Login')</a>
                                @if (gs('registration'))
                                    <a href="{{ route('user.register') }}" class="btn btn-sm btn-danger px-4 rounded-1 fw-bold">@lang('REGISTER')</a>
                                @endif
                            </div>
                        @else
                            <div class="dropdown">
                            <button class="nav-user-btn dropdown-toggle"
        data-bs-toggle="dropdown">
    <i class="las la-user-circle fs-5 me-1"></i>
    {{ __(auth()->user()->username ?? 'Dashboard') }}
</button>
                                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg bg-dark mt-2 p-2" style="border-radius: 10px; border: 1px solid rgba(255,255,255,0.1) !important;">
                                    <a class="dropdown-item d-flex align-items-center gap-2 text-white-50" href="{{ route('user.profile.setting') }}"><i class="las la-user-circle fs-5"></i> @lang('Profile')</a>
                                    <a class="dropdown-item d-flex align-items-center gap-2 text-white-50" href="{{ route('ticket.index') }}"><i class="las la-list fs-5"></i> @lang('Tickets')</a>
                                    <div class="dropdown-divider border-secondary border-opacity-25"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-2 text-danger fw-bold" href="{{ route('user.logout') }}"><i class="las la-sign-out-alt fs-5"></i> @lang('Logout')</a>
                                </div>
                            </div>
                        @endguest

                        @if (gs('multi_language'))
                            @php
                                $languages = App\Models\Language::all();
                                $activeLanguage = $languages->where('code', session('lang'))->first();
                                $otherLanguages = $languages->where('code', '!=', session('lang'));
                            @endphp
                            <div class="language dropdown">
                                <button class="btn btn-sm btn-dark bg-opacity-50 border-0 rounded-pill" data-bs-toggle="dropdown">
                                    <img src="{{ getImage(getFilePath('language') . '/' . @$activeLanguage->image) }}" class="rounded-circle me-1" width="18">
                                    <span class="small">{{ strtoupper(@$activeLanguage->code) }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow bg-dark mt-2" style="border-radius: 8px;">
                                    @foreach ($otherLanguages as $item)
                                        <li class="langSel" data-lang_code="{{ $item->code }}">
                                            <a class="dropdown-item d-flex align-items-center gap-2 text-white-50" href="javascript:void(0)">
                                                <img src="{{ getImage(getFilePath('language') . '/' . @$item->image) }}" width="20">
                                                <span>{{ __(@$item->name) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif -->
                        @guest
<div class="auth-btns d-flex gap-2">
    <a href="{{ route('user.login') }}" class="btn btn-sm btn-login-custom px-3 fw-bold">
        @lang('Login')
    </a>

    @if (gs('registration'))
        <a href="{{ route('user.register') }}" class="btn btn-sm btn-danger px-4 rounded-1 fw-bold">
            @lang('REGISTER')
        </a>
    @endif
</div>
@endguest


@auth
<div class="dropdown">
    <button class="nav-user-btn dropdown-toggle" data-bs-toggle="dropdown">
        <i class="las la-user-circle fs-5 me-1"></i>
        {{ auth()->user()->username }}
    </button>

    <div class="dropdown-menu dropdown-menu-end bg-dark p-2">
        <a class="dropdown-item text-white-50" href="{{ route('user.profile.setting') }}">Profile</a>
        <a class="dropdown-item text-danger" href="{{ route('user.logout') }}">Logout</a>
    </div>
</div>
@endauth

                       

                        @auth
                        <a href="{{ route('pay','premium') }}" class="btn btn-sm btn-warning fw-bold px-3 rounded-1 shadow-sm" style="background: #ffb400; border: none; font-size: 0.75rem;">
                            <i class="las la-crown me-1"></i> PREMIUM
                        </a>
@endauth
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>

<div class="header-search-area py-4 bg-dark border-bottom border-secondary border-opacity-25">
    <div class="container">
        <form class="header-search-form d-flex align-items-center" action="{{ route('search') }}">
            <input name="search" class="form-control bg-transparent border-0 text-white fs-4" type="text" placeholder="@lang('Search movies, shows, etc')...">
            <button type="submit" class="btn text-white fs-3 p-0 ms-2"><i class="fas fa-search"></i></button>
        </form>
    </div>
</div>

<style>
 
.nav-hover-link {
        position: relative;
        transition: opacity 0.3s ease;
        opacity: 0.8;
    }
    .nav-hover-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 1px;
        left: 50%;
        background-color: #e50914; 
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-dropdown-link {
    padding: 6px 10px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.nav-dropdown-link:hover {
   
    color: #fff !important;
    opacity: 1;
}
    .nav-hover-link:hover::after {
        width: 80%;
    }
    .nav-hover-link:hover {
        opacity: 1 !important;
        color: #fff !important;
    }
/* NAV LINK BASE */
.navbar .nav-link {
    position: relative;
    color: #fff;
    font-weight: 500;
    transition: color 0.3s ease;
}

/* UNDERLINE (hidden by default) */
.navbar .nav-link::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -5px;
    width: 0%;
    height: 2px;
    background: #dc3545; /* red */
    transition: width 0.3s ease;
}

/* ON HOVER → SHOW LINE */
.navbar .nav-link:hover::after {
    width: 100%;
}
    .nav-user-btn {
    background: transparent;
    border: 1px solid rgba(255,255,255,0.15);
    color: #fff;
    padding: 6px 12px;
    border-radius: 8px;

    display: flex;
    align-items: center;
    gap: 6px;

    font-weight: 600;
    font-size: 0.85rem;

    transition: all 0.3s ease;
}

.nav-user-btn:hover {
    background: rgba(255,255,255,0.06);
    border-color: rgba(255,255,255,0.3);
    transform: translateY(-1px);
}
.mobile-menu-header {
    display: none;
}
.navbar .main-menu {
    display: flex;
    align-items: center;
    gap: 20px; /* consistent spacing */
}

.navbar .nav-item {
    display: flex;
    align-items: center;
}


/* MOBILE MENU BASE */
@media (max-width: 1199px) {
    .mobile-menu-header {
        display: flex;
    }
    .menu-icon i {
    transition: all 0.3s ease;
}

.menu-icon i.rotate {
    transform: rotate(180deg);
}
.custom-mobile-menu {
    position: fixed;
    top: 0;
    right: -100%;
    left: auto; 
    width: 80%;
    max-width: 320px;
    height: 100vh;
    background: rgba(10, 10, 25, 0.98);
    backdrop-filter: blur(20px);
    padding: 80px 20px 30px;
    z-index: 9999;

    display: flex;
    flex-direction: column;
    justify-content: flex-start;

    transition: all 0.4s ease;
    overflow-y: auto;
    box-shadow: -10px 0 30px rgba(0,0,0,0.6);
}

/* ACTIVE STATE */
.custom-mobile-menu.active {
    right: 0;
}
.mobile-menu-header {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 100%;
    display: flex;
    justify-content: flex-end;
}

.menu-close-btn {
    background: rgba(255,255,255,0.08);
    border: none;
    color: #fff;
    width: 42px;
    height: 42px;
    border-radius: 10px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 22px;
    cursor: pointer;

    transition: all 0.3s ease;
}

.menu-close-btn:hover {
    background: rgba(255,255,255,0.15);
    transform: rotate(90deg);
}

/* MENU ITEMS */
.main-menu {
    flex-direction: column !important;
    align-items: flex-start !important;
    gap: 10px;
    width: 100%;
}
.auth-btns {
    flex-direction: column !important;
    width: 100%;
}

.auth-btns a {
    width: 100%;
    text-align: center;
}

.main-menu .nav-item {
    width: 100%;
}

.main-menu .nav-link {
    width: 100%;
    padding: 12px 15px;
    border-radius: 8px;
    font-size: 0.95rem;
}
 

/* DROPDOWNS INSIDE MOBILE */
.dropdown-menu {
    position: static !important;
    transform: none !important;
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    padding-left: 10px;
}

.dropdown-item {
    font-size: 0.85rem;
    padding-left: 15px;
}

/* RIGHT SIDE ITEMS */
.nav-right {
    flex-direction: column !important;
    align-items: flex-start !important;
    width: 100%;
    margin-top: 20px;
    gap: 10px;
    border: none !important;
    padding: 0 !important;
    margin-left:30;
}

.nav-right a,
.nav-right button {
    width: 100%;
    justify-content: flex-start;
}

/* OVERLAY */
.menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    z-index: 9998;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.menu-overlay.active {
    opacity: 1;
    visibility: visible;
}
}

.dropdown-menu {
    background: rgba(10, 10, 20, 0.95) !important;
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255,255,255,0.08) !important;
}

.dropdown-item {
    border-radius: 6px;
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background: rgba(255,255,255,0.06) !important;
    color: #fff !important;
    transform: translateX(3px);
}
    /* Bordered Search Box */
    .search-box-bordered {
        width: 42px;
        height: 42px;
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .search-box-bordered:hover {
        border-color: #fff;
        background: rgba(255,255,255,0.05);
    }
    .btn-login-custom {
        transition: all 0.3s ease;
        color: #fff !important;
    }
    .btn-login-custom:hover {
        background-color: #fff !important;
        color: #000 !important; 
        border-radius: 4px;
    }
    .custom-mobile-menu .nav-link,
.custom-mobile-menu .nav-hover-link {
    color: #ffffff !important;
    opacity: 1 !important; /* REMOVE FADE */
}

/* Ensure dropdown items are readable */
.custom-mobile-menu .dropdown-item {
    color: rgba(255,255,255,0.85) !important;
}

/* Strong hover state */
.custom-mobile-menu .nav-link:hover {
    background: rgba(255, 255, 255, 0.08) !important;
    color: #ffffff !important;
    opacity: 1 !important;
}

/* Active/focus state */
.custom-mobile-menu .nav-link:focus,
.custom-mobile-menu .nav-link:active {
    color: #ffffff !important;
}

/* FIX dropdown visibility */
.custom-mobile-menu .dropdown-menu {
    background: rgba(20, 20, 35, 0.98) !important;
    border-radius: 10px;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const toggleBtn = document.getElementById("menuToggle");
    const menu = document.querySelector(".custom-mobile-menu");
    const closeBtn = document.getElementById("menuClose");

    const overlay = document.createElement("div");
    overlay.classList.add("menu-overlay");
    document.body.appendChild(overlay);

    toggleBtn.addEventListener("click", function () {
    menu.classList.toggle("active");
    overlay.classList.toggle("active");

    const icon = toggleBtn.querySelector("i");

    icon.classList.toggle("rotate");

    if (menu.classList.contains("active")) {
        icon.classList.remove("la-bars");
        icon.classList.add("la-times");
        document.body.style.overflow = "hidden";
    } else {
        icon.classList.remove("la-times");
        icon.classList.add("la-bars");
        document.body.style.overflow = "auto";
    }
});

    closeBtn.addEventListener("click", function () {
        menu.classList.remove("active");
        overlay.classList.remove("active");

        const icon = toggleBtn.querySelector("i");
        icon.classList.remove("la-times");
        icon.classList.add("la-bars");

        document.body.style.overflow = "auto";
    });

    overlay.addEventListener("click", function () {
        menu.classList.remove("active");
        overlay.classList.remove("active");

        const icon = toggleBtn.querySelector("i");
        icon.classList.remove("la-times");
        icon.classList.add("la-bars");

        document.body.style.overflow = "auto";
    });

});
</script>
  