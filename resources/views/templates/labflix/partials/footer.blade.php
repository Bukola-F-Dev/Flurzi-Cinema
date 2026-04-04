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
                <div class="flurzi-logo mb-3">
    <span class="logo-dot"></span>
    <span class="logo-text">
        FLURZI<span>CINEMA</span>
    </span>
</div>

                    <p class="footer-text">
                       At Flurzi Cinema, stream, discover and Binge-watch your favorite movies, anytime, anywhere!
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
        @if($categories && count($categories) > 0)
            @foreach ($categories as $category)
                <li>
                    <a href="{{ route('category', $category->id) }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        @else
            <!-- Default fallback links -->
            <li><a href="#">Action</a></li>
            <li><a href="#">Drama</a></li>
            <li><a href="#">Comedy</a></li>
            <li><a href="#">Romance</a></li>
        @endif
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
        <img src="{{ frontendImage('footer', @$item->data_values->store_image, '80x40') }}">
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
                <span>Flurzi Cinema</span> — All Rights Reserved
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
                    </div> -->
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

<style>
.flurzi-logo {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo-dot {
    width: 28px;
    height: 28px;
    background: linear-gradient(135deg, #ff003c, #ff4d4d);
    border-radius: 50%;
    box-shadow: 0 0 15px rgba(255, 0, 60, 0.7);
}

.logo-text {
    font-size: 20px;
    font-weight: 700;
    letter-spacing: 1px;
    color: #fff;
}

.logo-text span {
    color: #ff003c;
    margin-left: 2px;
}
.footer-modern {
    position: relative;
    background: #0b0b0f;
    color: #aaa;
    overflow: hidden;
}

.footer-gradient {
    position: absolute;
    top: -100px;
    left: 0;
    width: 100%;
    height: 300px;
    background: radial-gradient(circle at center, rgba(255,0,60,0.25), transparent 70%);
    filter: blur(80px);
    z-index: 0;
}

.footer-content {
    position: relative;
    z-index: 2;
    padding: 80px 0;
}

.footer-title {
    color: #fff;
    font-weight: 600;
    margin-bottom: 20px;
    font-size: 15px;
    letter-spacing: 0.5px;
}

.footer-text {
    font-size: 14px;
    line-height: 1.7;
    color: #bbb;
}

.footer-links li {
    margin-bottom: 10px;
}

.footer-links a {
    color: #aaa;
    font-size: 14px;
    transition: 0.3s;
}

.footer-links a:hover {
    color: #ff003c;
    transform: translateX(5px);
}

.social-links-modern {
    display: flex;
    gap: 12px;
    margin-top: 20px;
}

.social-links-modern a {
    display: flex;
    width: 42px;
    height: 42px;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    color: #fff;
    transition: all 0.3s ease;
}

.social-links-modern a:hover {
    background: linear-gradient(135deg, #a855f7, #6366f1);
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(168,85,247,0.4);
}
.subscribe-modern {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.05);
    border-radius: 999px;
    padding: 5px;
    border: 1px solid rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    margin-top:12px;
}

.subscribe-modern input {
    flex: 1;
    border: none;
    padding: 12px 15px;
    background: transparent;
    color: #fff;
    font-size: 14px;
    outline: none;
}

.subscribe-modern input::placeholder {
    color: #888;
}

.subscribe-modern button {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    border: none;

    background: linear-gradient(135deg, #a855f7, #6366f1);
    color: #fff;

    display: flex;
    align-items: center;
    justify-content: center;

    transition: all 0.3s ease;
}

.subscribe-modern button:hover {
    transform: scale(1.1);
    box-shadow: 0 0 20px rgba(168,85,247,0.6);
}
.footer-bottom {
    border-top: 1px solid #1a1a22;
    padding: 20px 0;
    font-size: 13px;
    color: #777;
}

.footer-bottom span {
    color: #ff003c;
    font-weight: 600;
}

.footer-policies a {
    margin-left: 15px;
    color: #777;
    transition: 0.3s;
}

.footer-policies a:hover {
    color: #ff003c;
}
.footer-modern:hover .footer-gradient {
    transform: scale(1.1);
    transition: 1.5s ease;
}
.footer-modern {
    background: linear-gradient(180deg, #070114, #030308);
}

.footer-title {
    font-size: 14px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #ddd;
}

.apps {
    display: flex;
    gap: 12px;
    margin-top: 20px;
    flex-wrap: wrap;
}

.apps a {
    display: inline-block;
    transition: 0.3s ease;
}

.apps img {
    height: 45px;
    width: auto;
    border-radius: 8px;
}

.apps a:hover {
    transform: translateY(-3px) scale(1.05);
}

</style>

 