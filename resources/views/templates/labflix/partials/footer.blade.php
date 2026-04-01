<!-- footer section start -->
@php
    $policies = getContent('policy_pages.element');
    $footer = getContent('footer.content', true);
    $footerElement = getContent('footer.element', false, null, true);
    $links = getContent('short_links.element', false, null, true);
    $subscriber = getContent('subscribe.content', true);
    $socials = getContent('social_icon.element');
@endphp
<footer class="footer-modern">
    <div class="footer-gradient"></div>

    <div class="container footer-content">
        <div class="row gy-5">

            <!-- BRAND -->
            <div class="col-lg-4">
                <div class="footer-brand">
                    <img src="{{ siteLogo() }}" class="mb-3" style="max-height:50px;">

                    <p class="footer-text">
                        {{ __(@$footer->data_values->about_us) }}
                    </p>

                    <div class="social-links-modern">
                        @foreach ($socials as $social)
                            <a href="{{ @$social->data_values->url }}" target="_blank">
                                @php echo @$social->data_values->social_icon @endphp
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- LINKS -->
            <div class="col-lg-2 col-6">
                <h6 class="footer-title">Quick Menu</h6>
                <ul class="footer-links">
                    @foreach ($links as $link)
                        <li><a href="{{ route('links', $link->slug) }}">{{ $link->data_values->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- CATEGORIES -->
            <div class="col-lg-2 col-6">
                <h6 class="footer-title">Categories</h6>
                <ul class="footer-links">
                    @foreach ($categories as $category)
                        <li><a href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- SUBSCRIBE -->
            <div class="col-lg-4">
                <h6 class="footer-title">{{ @$footer->data_values->subscribe_title }}</h6>

                <p class="footer-text small">
                    {{ @$footer->data_values->subscribe_subtitle }}
                </p>

                <form class="subscribe-modern">
                    @csrf
                    <input name="email" type="email" placeholder="Enter your email" required>
                    <button type="submit">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>

                <div class="apps mt-3">
                @foreach ($footerElement as $item)
    <a href="{{ @$item->data_values->link }}">
        <img src="{{ frontendImage('footer', @$item->data_values->store_image, '150x45') }}">
    </a>
@endforeach
                </div>
            </div>

        </div>
    </div>

    <!-- BOTTOM -->
    <div class="footer-bottom">
        <div class="container d-flex justify-content-between flex-wrap">
            <p>
                © {{ date('Y') }} 
                <span>{{ gs('site_name') }}</span> — All Rights Reserved
            </p>

            <div class="footer-policies">
                @foreach ($policies as $policy)
                    <a href="{{ route('policy.pages', $policy->slug) }}">
                        {{ $policy->data_values->title }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>

<!-- <footer class="footer @if (request()->routeIs('home') || request()->routeIs('category') || request()->routeIs('subCategory') || request()->routeIs('search')) d-none @endif">
    <div class="footer__top">
        <div class="container">
            <div class="row mb-none-30">
                <div class="col-lg-4 col-sm-8 mb-50">
                    <div class="footer-widget">
                        <a href="{{ route('home') }}"><img class="mb-4" src="{{ siteLogo() }}" alt="image"></a>
                        <p>{{ __(@$footer->data_values->about_us) }}</p>
                        <ul class="social-links mt-3">
                            @foreach ($socials as $social)
                                <li><a href="{{ @$social->data_values->url }}" target="_blank">@php echo @$social->data_values->social_icon @endphp</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 mb-50">
                    <div class="footer-widget">
                        <h4 class="footer-widget__title">@lang('Short Links')</h4>
                        <ul class="link-list">
                            @foreach ($links as $link)
                                <li>
                                    <a href="{{ route('links', $link->slug) }}">{{ __($link->data_values->title) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 mb-50">
                    <div class="footer-widget">
                        <h4 class="footer-widget__title">@lang('Category')</h4>
                        <ul class="link-list">
                            @foreach ($categories as $category)
                                <li><a href="{{ route('category', $category->id) }}">{{ __($category->name) }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- footer-widget end -->
                </div>
                <div class="col-lg-4 col-sm-8 mb-50">
                    <div class="footer-widget">
                        <h4 class="footer-widget__title">{{ __(@$footer->data_values->subscribe_title) }}</h4>
                        <p>{{ __(@$footer->data_values->subscribe_subtitle) }}</p>
                        <form class="subscribe-form mt-3">
                            @csrf
                            <input name="email" type="email" placeholder="@lang('Email Address')">
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                        <div class="download-links">
                            @foreach ($footerElement as $footer)
                                <a class="download-links__item" href="{{ @$footer->data_values->link }}" target="_blank">
                                    <img src="{{ frontendImage('footer', @$footer->data_values->store_image, '150x45') }}" alt="@lang('image')">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="d-flex justify-content-center justify-content-lg-between">
                        <p>@lang('Copyright') &copy; @php echo date('Y') @endphp @lang('All Rights Reserved By ')
                            <a href="{{ route('home') }}" class="base--color">{{ __(gs('site_name')) }}</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="links justify-content-md-end justify-content-around">
                        @foreach ($policies as $policy)
                            <li><a href="{{ route('policy.pages', $policy->slug) }}">{{ __(@$policy->data_values->title) }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="modal alert-modal" id="alertModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <span class="alert-icon"><i class="fas fa-question-circle"></i></span>
                <p class="modal-description">@lang('Subscription Alert!')</p>
                <p class="modal--text">@lang('Please subscribe a plan to view our paid items')</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn--dark btn--sm" data-bs-dismiss="modal" type="button">@lang('Cancel')</button>
                <a class="btn btn--base btn--sm" href="{{ route('subscription') }}">@lang('Subscribe Now')</a>
            </div>
        </div>
    </div>
</div>


@push('style')
<style>
.footer-modern {
    position: relative;
    background: #07070b;
    padding-top: 80px;
    color: #ccc;
    overflow: hidden;
}

/* subtle gradient glow */
.footer-gradient {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top, rgba(229,9,20,0.15), transparent 60%);
}

/* spacing */
.footer-content {
    position: relative;
    z-index: 2;
}

/* titles */
.footer-title {
    color: #fff;
    font-weight: 600;
    margin-bottom: 15px;
}

/* text */
.footer-text {
    opacity: 0.7;
    line-height: 1.6;
}

/* links */
.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 8px;
}

.footer-links a {
    color: #aaa;
    text-decoration: none;
    transition: 0.3s;
}

.footer-links a:hover {
    color: #e50914;
    padding-left: 5px;
}

/* social icons */
.social-links-modern {
    display: flex;
    gap: 12px;
}

.social-links-modern a {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
    transition: 0.3s;
}

.social-links-modern a:hover {
    background: #e50914;
    transform: translateY(-3px);
}

/* subscribe */
.subscribe-modern {
    display: flex;
    margin-top: 15px;
    border-radius: 50px;
    overflow: hidden;
    background: rgba(255,255,255,0.05);
}

.subscribe-modern input {
    flex: 1;
    padding: 12px 15px;
    border: none;
    background: transparent;
    color: #fff;
}

.subscribe-modern button {
    background: #e50914;
    border: none;
    padding: 0 20px;
    color: #fff;
}

/* apps */
.apps img {
    height: 40px;
    margin-right: 10px;
}

/* bottom */
.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.08);
    margin-top: 50px;
    padding: 20px 0;
}

.footer-bottom p {
    margin: 0;
    font-size: 14px;
}

.footer-bottom span {
    color: #e50914;
}

.footer-policies a {
    margin-left: 15px;
    color: #aaa;
    font-size: 14px;
    text-decoration: none;
}

.footer-policies a:hover {
    color: #fff;
}
    </style>
    @endpush
