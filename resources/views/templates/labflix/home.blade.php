@extends('Template::layouts.frontend')
@section('content')
    @php
        $banner_content = getContent('banner.content', true);
        $games = App\Models\Game::active()->whereDate('start_time', today())->limit(10)->get();
        $reels = App\Models\Reel::orderBy('id', 'desc')->limit(10)->get();
    @endphp


    <section class="hero-modern">
    <div class="hero-modern-overlay"></div>

    <div class="container hero-modern-content text-center">

        <span class="badge-modern">Trending Now</span>

        <h1 class="hero-modern-title">
            Welcome to Flurzi
        </h1>

        <p class="hero-modern-subtitle">
        Dive into a universe of entertainment where movies, shows, and originals come together.
         Whether you're in the mood for action, romance,
         or thrilling adventures, our platform brings you closer to the stories you love. Anytime, Anywhere.
        </p>

        <div class="hero-modern-actions">

            <!-- WATCH NOW -->
            <a href="#" class="btn-modern primary">
                <i class="fas fa-play"></i>
                <span>WATCH NOW</span>
            </a>

            <!-- MORE INFO -->
            <a href="#" class="btn-modern secondary">
                <i class="las la-info-circle"></i>
                <span>More Info</span>
            </a>

        </div>
 <!-- NEW: Center Image -->
 <div class="hero-modern-image">
 <img src="{{ asset('assets/images/Hero_Image.png') }}" alt="happy users">
        </div>

    </div>
</section>
<section class="feature-scroll">
    <div class="feature-scroll-wrapper">

        <div class="feature-track">
            <!-- ITEM -->
            <div class="feature-item">
                <i class="fas fa-play-circle"></i>
                <span>Enjoy</span>
            </div>

            <div class="feature-item">
                <i class="fas fa-redo"></i>
                <span>Rewatch</span>
            </div>

            <div class="feature-item">
                <i class="fas fa-film"></i>
                <span>Watch Anywhere</span>
            </div>

            <div class="feature-item">
                <i class="fas fa-bolt"></i>
                <span>Instant Streaming</span>
            </div>

            <div class="feature-item">
                <i class="fas fa-star"></i>
                <span>Top Rated</span>
            </div>

            <!-- DUPLICATE FOR INFINITE EFFECT -->
            <div class="feature-item">
                <i class="fas fa-play-circle"></i>
                <span>Enjoy</span>
            </div>

            <div class="feature-item">
                <i class="fas fa-redo"></i>
                <span>Rewatch</span>
            </div>

            <div class="feature-item">
                <i class="fas fa-film"></i>
                <span>Watch Anywhere</span>
            </div>

            <div class="feature-item">
                <i class="fas fa-bolt"></i>
                <span>Instant Streaming</span>
            </div>

            <div class="feature-item">
                <i class="fas fa-star"></i>
                <span>Top Rated</span>
            </div>
        </div>

    </div>
</section>

@include('Template::partials.short_reels')
@include('Template::partials.today_games')
<!-- FEATURED -->
<section class="section-modern featured-centered">
    <div class="container">

        <div class="section-header-modern text-center mb-5">
            <h2>Featured Content</h2>
            <a href="#">View All →</a>
        </div>

        <div class="featured-row">

            @foreach ($featuredMovies->take(3) as $featured)
                <div class="featured-card">

                    <div class="poster">
                        <img 
                            data-src="{{ getImage(getFilePath('item_portrait') . '/' . @$featured->image->portrait) }}"
                            src="{{ asset('assets/global/images/lazy.png') }}"
                            class="lazy-loading-img"
                        >

                        <div class="overlay">
                            <a href="{{ isPremium() ? route('watch', $featured->slug) : '/subscription' }}" class="play-btn">
                                @if(isPremium())
                                    <i class="las la-play"></i>
                                @else
                                    <i class="las la-lock"></i>
                                @endif
                            </a>
                        </div>
                    </div>

                    <div class="info text-center">
                        <h6>{{ __(short_string($featured->title, 20)) }}</h6>

                        <div class="meta justify-content-center">
                            <span><i class="las la-star"></i> {{ $featured->ratings }}</span>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>

    </div>
</section>
<!-- <section class="section-modern">
    <div class="container-fluid px-5">

        <div class="section-header-modern">
            <h2>Featured Content</h2>
            <a href="#">View All →</a>
        </div>

        <div class="movie-grid">
            @foreach ($featuredMovies as $featured)
                <div class="movie-card-modern">

                    <div class="poster">
                        <img 
                            data-src="{{ getImage(getFilePath('item_portrait') . '/' . @$featured->image->portrait) }}"
                            src="{{ asset('assets/global/images/lazy.png') }}"
                            class="lazy-loading-img"
                        >

                        <div class="overlay">
                            <a href="{{ isPremium() ? route('watch', $featured->slug) : '/subscription' }}" class="play-btn">
                                @if(isPremium())
                                    <i class="las la-play"></i>
                                @else
                                    <i class="las la-lock"></i>
                                @endif
                            </a>
                        </div>
                    </div>

                    <div class="info">
                        <h6>{{ __(short_string($featured->title, 18)) }}</h6>

                        <div class="meta">
                            <span><i class="lar la-eye"></i> {{ numFormat($featured->view) }}</span>
                            <span><i class="las la-star"></i> {{ $featured->ratings }}</span>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</section> -->

<!-- FEATURED -->
<section class="section-modern featured-centered">
    <div class="container">

        <div class="section-header-modern text-center mb-5">
            <h2>Featured Content</h2>
            <a href="#">View All →</a>
        </div>

        <div class="featured-row">

            @foreach ($featuredMovies->take(3) as $featured)
                <div class="featured-card">

                    <div class="poster">
                        <img 
                            data-src="{{ getImage(getFilePath('item_portrait') . '/' . @$featured->image->portrait) }}"
                            src="{{ asset('assets/global/images/lazy.png') }}"
                            class="lazy-loading-img"
                        >

                        <div class="overlay">
                            <a href="{{ isPremium() ? route('watch', $featured->slug) : '/subscription' }}" class="play-btn">
                                @if(isPremium())
                                    <i class="las la-play"></i>
                                @else
                                    <i class="las la-lock"></i>
                                @endif
                            </a>
                        </div>
                    </div>

                    <div class="info text-center">
                        <h6>{{ __(short_string($featured->title, 20)) }}</h6>

                        <div class="meta justify-content-center">
                            <span><i class="las la-star"></i> {{ $featured->ratings }}</span>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>

    </div>
</section>



<section class="section featured-movies py-5 mt-4" data-section="single1">
    <div class="container-fluid px-lg-5">
      <!--  <div class="row align-items-center mb-4">
            <div class="col-8">
                <div class="section-header border-start border-danger border-4 ps-3">
                    <h2 class="section-title text-white fw-bold m-0">@lang('Featured Content')</h2>
                </div>
            </div>
            <div class="col-4 text-end">
                <a href="#" class="text-danger text-decoration-none fw-bold small text-uppercase">View All <i class="las la-angle-right"></i></a>
            </div>
        </div> -->
        
        <div class="movie-slider-one">
            @foreach ($featuredMovies as $featured)
                <div class="movie-card modern-card px-2" data-text="{{ $featured->versionName }}">
                    <div class="card-inner overflow-hidden rounded-3 position-relative shadow-hover">
                        <div class="movie-card__thumb position-relative">
                            <img class="lazy-loading-img img-fluid w-100 transition-transform"
                                data-src="{{ getImage(getFilePath('item_portrait') . '/' . @$featured->image->portrait) }}"
                                src="{{ asset('assets/global/images/lazy.png') }}" alt="@lang('image')">
                            
                            <div class="card-actions position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center opacity-0 transition-all">
                                <a class="play-btn bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" 
                                   href="{{ isPremium() ? route('watch', $featured->slug) : '/subscription' }}" 
                                   style="width: 60px; height: 60px; text-decoration:none;">
                                    @if(isPremium())
                                        <i class="lar la-play-circle fs-1"></i>
                                    @else
                                        <i class="las la-lock fs-2"></i>
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="movie-card__content p-3 bg-dark bg-opacity-75">
                            <h6 class="mb-1">
                                <a href="{{ isPremium() ? route('watch', $featured->slug) : '/subscription' }}" class="text-white text-decoration-none transition-color">
                                    {{ __(short_string($featured->title, 17)) }}
                                </a>
                            </h6>
                            <div class="movie-card__meta d-flex justify-content-between small text-muted">
                                <span><i class="far fa-eye text-danger"></i> {{ numFormat($featured->view) }}</span>
                                <span><i class="fas fa-star text-warning"></i> {{ $featured->ratings }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>



   <!-- <div style="position:relative; height:80vh; background:linear-gradient(to top,#0b0b0f,transparent), url('{{ asset('assets/images/banner.jpg') }}') center/cover;">
    <div style="bottom:50px; left:50px;">
        <h1 style="font-size:48px;">Welcome to Flurzi</h1>
        <p>Unlimited Movies, Shows, and More</p>
        <a href="#" style="background:red; padding:10px 20px; color:white;">Start Watching</a>
    </div>
</div>

    @if ($advertise && !auth()->id())
  
        <div class="modal" id="adModal">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body position-relative p-0">
                        <div class="ads-close-btn position-absolute">
                            <button class="btn-close btn-close-white" data-bs-dismiss="modal" type="button"
                                aria-label="Close"><i class="las la-times"></i></button>
                        </div>
                        <a href="{{ $advertise->content->link }}" target="_blank">
                            <img src="{{ getImage(getFilePath('ads') . '/' . @$advertise->content->image) }}"
                                alt="@lang('image')">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <section class="hero">
        <div class="hero__slider">
            @foreach ($sliders as $slider)
                @if ($slider->caption_show != 1)
                    <div class="single-slide" id="slide-{{ $slider->id }}"
                        aria-hidden="{{ $slider->isActive ? 'false' : 'true' }}">
                     <a href="{{ isPremium() ? route('watch', $slider->item->slug) : '/subscription' }}">
                            <img src="{{ getImage(getFilePath('slider') . '/' . $slider->image) }}" alt="hero-image">
                        </a>
                    </div>
                @else
                    <div class="movie-slide bg_img"
                        data-background="{{ getImage(getFilePath('slider') . '/' . $slider->image) }}">
                        <div class="movie-slide__content">
                            <h6 class="movie-name" data-animation="fadeInUp" data-delay=".2s">{{ __($slider->item->title) }}
                            </h6>
                            <ul class="movie-meta justify-content-lg-start justify-content-center" data-animation="fadeInUp"
                                data-delay=".4s">
                                <li><i class="fas fa-star color--gold"></i> <span>({{ __($slider->item->ratings) }})</span>
                                </li>
                                <li><span>{{ __($slider->item->category->name) }}</span></li>
                            </ul>
                            <p data-animation="fadeInUp" data-delay=".7s">{{ __($slider->item->preview_text) }}</p>
                            <div class="btn-area justify-content-lg-start justify-content-center align-items-center mt-lg-5 mt-sm-3 mt-2"
                                data-animation="fadeInLeft" data-delay="1s">
                                @if (@$slider->item->is_trailer == Status::TRAILER && @$slider->item->item_type == Status::SINGLE_ITEM)
                                    <a class="video-btn justify-content-lg-start justify-content-center"
                               
   href="{{ isPremium() ? route('watch', $slider->item->slug) : '/subscription' }}">
                                        <div class="icon"><i class="lar la-play-circle"></i></div>
                                        <span>@lang('Watch Trailer')</span>
                                    </a>
                                @else
                                    <a class="video-btn justify-content-lg-start justify-content-center"
                                    
   href="{{ isPremium() ? route('watch', $slider->item->slug) : '/subscription' }}">
                                        <div class="icon">
                                            <i class="lar la-play-circle"></i>
                                        </div>
                                        <span>@lang('Watch Now')</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    @include('Template::partials.short_reels')

    @include('Template::partials.today_games')

    <section class="section mt-80 mb-80" data-section="single1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-header">
                        <h2 class="section-title">@lang('Featured Items')</h2>
                    </div>
                </div>
            </div><!-- row end -->
          <!--  <div class="movie-slider-one">
                @foreach ($featuredMovies as $featured)
                    <div class="movie-card" data-text="{{ $featured->versionName }}">
                        <div class="movie-card__thumb">
                            <img class="lazy-loading-img"
                                data-src="{{ getImage(getFilePath('item_portrait') . '/' . @$featured->image->portrait) }}"
                                src="{{ asset('assets/global/images/lazy.png') }}" alt="@lang('image')">
                                <a class="icon" href="{{ isPremium() ? route('watch', $featured->slug) : '/subscription' }}">
    @if(isPremium())
        <i class="lar la-play-circle"></i>
    @else
        🔒
    @endif
</a>
                        </div>
                        <div class="movie-card__content">
                        <h6>
    <a href="{{ isPremium() ? route('watch', $featured->slug) : '/subscription' }}">
        {{ __(short_string($featured->title, 17)) }}
    </a>
</h6>
                            <ul class="movie-card__meta">
                                <li><i class="far fa-eye color--primary"></i> <span>{{ numFormat($featured->view) }}</span>
                                </li>
                                <li><i class="fas fa-star color--gold"></i> <span>({{ $featured->ratings }})</span></li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div> -->
        </div>
    </section>

    <div class="sections">   </div> -->
@endsection
 

@push('script')
    <script>
        "use strict";


        $(document).ready(function() {
            setTimeout(() => {
                $("#adModal").modal('show');
            }, 2000);
        });

        var send = 0;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 60) {

                if ($('.section').hasClass('last-item')) {
                    $('.loading').removeClass('loader');
                    return false;
                }

                $('.loading').addClass('loader');
                setTimeout(function() {
                    if (send == 0) {
                        send = 1;
                        var sec = $('.section').last().data('section');
                        var url = "{{ route('get.section') }}";
                        var data = {
                            sectionName: sec
                        };
                        $.get(url, data, function(response) {
                            if (response == 'end') {
                                $('.section').last().addClass('last-item');
                                $('.loading').removeClass('loader');
                                $('.footer').removeClass('d-none');
                                return false;
                            }
                            $('.loading').removeClass('loader');
                            $('.sections').append(response);
                            send = 0;
                        });
                    }
                }, 1000)
            }

            let images = document.querySelectorAll('.lazy-loading-img');

            function preloadImage(image) {
                const src = image.getAttribute('data-src');
                image.src = src;
            }

            let imageOptions = {
                threshold: 1,
                border: "5px solid green",
            };

            const imageObserver = new IntersectionObserver((entries, imageObserver) => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) {
                        return;
                    } else {
                        preloadImage(entry.target)
                        imageObserver.unobserve(entry.target)
                    }
                })
            }, imageOptions)
            images.forEach(image => {
                imageObserver.observe(image)
            });
        });
    </script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/plyr.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/plyr.min.js') }}"></script>
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>
@endpush

@push('script')
    <script>
        "use strict";
        const controls = [
            'play-large',
        ];

        let players = Plyr.setup('.video-player', {
            controls,
            autoplay: false,
            ratio: '9:16'
        });

        if (players.length > 0) {
            players.forEach((player, index) => {
                player.on('mouseenter', () => {
                    players.forEach((p, i) => {
                        if (i !== index) {
                            p.pause();
                        }
                    });
                    player.muted = true;
                    player.play().catch(error => {
                        console.log('Playback prevented by the browser.', error);
                    });
                });

                player.on('mouseleave', () => {
                    player.pause();
                });
            });
        }
    </script>
    <style>
        .section-modern {
    margin-top: 120px;
}
 /* Import Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

.hero-modern {
    position: relative;
    min-height: 90vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Poppins', sans-serif;
    color: #fff;
    overflow: hidden;

    /* Dark gradient + image blend */
    background: radial-gradient(circle at 20% 50%, rgba(111, 0, 255, 0.4), transparent 40%),
                radial-gradient(circle at 80% 30%, rgba(0, 102, 255, 0.3), transparent 40%),
                linear-gradient(135deg, #05010a, #0b0120);
}

.hero-modern-overlay {
    position: absolute;
    inset: 0;
    background: rgba(5, 1, 15, 0.6);
    backdrop-filter: blur(6px);
}
/* SECTION */
.featured-centered {
    padding: 100px 0;
}

/* ROW (CENTERED FLEX) */
.featured-row {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

/* CARD */
.featured-card {
    width: 260px;
    transition: all 0.3s ease;
}

/* POSTER */
.featured-card .poster {
    position: relative;
    border-radius: 14px;
    overflow: hidden;
}

.featured-card .poster img {
    width: 100%;
    height: 360px;
    object-fit: cover;
    transition: transform 0.4s ease;
}

/* HOVER EFFECT */
.featured-card:hover img {
    transform: scale(1.08);
}

/* OVERLAY */
.featured-card .overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.5);

    display: flex;
    align-items: center;
    justify-content: center;

    opacity: 0;
    transition: 0.3s ease;
}

.featured-card:hover .overlay {
    opacity: 1;
}

/* PLAY BUTTON */
.play-btn {
    width: 55px;
    height: 55px;
    background: #e50914;
    color: #fff;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;
    font-size: 22px;

    transition: 0.3s ease;
}

.play-btn:hover {
    transform: scale(1.1);
}

/* INFO */
.featured-card .info {
    margin-top: 12px;
}

.featured-card h6 {
    color: #fff;
    font-weight: 600;
    font-size: 0.95rem;
}

/* META */
.featured-card .meta {
    display: flex;
    gap: 10px;
    font-size: 0.85rem;
    color: #ccc;
    margin-top: 5px;
}

.featured-card .meta i {
    color: #fbbf24;
}

/* CONTENT */
.hero-modern-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
}
.hero-modern-image img {
    width: 500px;
    max-width: 90%;

    /* Blend into background */
    mix-blend-mode: screen;

    /* Glow */
    filter: drop-shadow(0 0 40px rgba(168, 85, 247, 0.6));

    animation: float 6s ease-in-out infinite;
}

/* BADGE */
.badge-modern {
    display: inline-block;
    padding: 6px 14px;
    font-size: 12px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255,255,255,0.1);
    margin-bottom: 20px;
    margin-top:180px;
}

/* TITLE */
.hero-modern-title {
    font-size: 52px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 20px;
}

.hero-modern-title span {
    background: linear-gradient(90deg, #a855f7, #6366f1);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* SUBTITLE */
.hero-modern-subtitle {
    font-size: 16px;
    color: #cfcfe8;
    margin-bottom: 30px;
}

/* BUTTONS */
.hero-modern-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

 
.btn-modern {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 180px;  
    height: 50px;    
    border-radius: 999px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: 0.3s ease;
}

/* PRIMARY BUTTON */
.btn-modern.primary {
    background: #fff;
    color: #000;
}

.btn-modern.primary:hover {
    background: #e5e5e5;
}

/* SECONDARY BUTTON */
.btn-modern.secondary {
    background: rgba(255,255,255,0.08);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.15);
}

.btn-modern.secondary:hover {
    background: rgba(255,255,255,0.15);
}

/* HOVER */
.btn-info-wrap:hover {
    background: rgba(255,255,255,0.15);
}
/* IMAGE UNDER BUTTON */
.hero-modern-image {
    margin-top: 50px;
    display: flex;
    justify-content: center;
}

.hero-modern-image img {
    width: 420px;
    max-width: 90%;
    border-radius: 20px;

    /* subtle glow like reference */
    box-shadow: 0 20px 60px rgba(168, 85, 247, 0.25);
    transition: transform 0.4s ease;
}

.hero-modern-image img:hover {
    transform: scale(1.03);
}
/* SECTION */
.section-modern {
    padding: 60px 0;
}

.section-header-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.hero-modern-image::before {
    content: "";
    position: absolute;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(168,85,247,0.4), transparent 70%);
    filter: blur(60px);
    z-index: -1;
}

.section-header-modern h2 {
    font-weight: 700;
}

.section-header-modern a {
    color: #e50914;
}

/* GRID */
.movie-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 20px;
}

/* CARD */
.movie-card-modern {
    transition: 0.3s;
}

.poster {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
}

.poster img {
    width: 100%;
    transition: transform 0.4s ease;
}

.movie-card-modern:hover img {
    transform: scale(1.1);
}
.hero-actions {
    display: flex;
    gap: 15px;
}

.btn-equal {
    flex: 1;                 
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}

/* OVERLAY */
.overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    transition: 0.3s;
}

.movie-card-modern:hover .overlay {
    opacity: 1;
}

/* PLAY BUTTON */
.play-btn {
    width: 55px;
    height: 55px;
    background: #e50914;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-size: 22px;
}

/* INFO */
.info {
    margin-top: 10px;
}

.info h6 {
    font-size: 14px;
    color: #fff;
}
.feature-scroll {
    background: rgba(10, 10, 20, 0.9);
    border-top: 1px solid rgba(255,255,255,0.05);
    border-bottom: 1px solid rgba(255,255,255,0.05);
    overflow: hidden;
    padding: 20px 0;
}

.feature-scroll-wrapper {
    width: 100%;
    overflow: hidden;
    position: relative;
}

.feature-track {
    display: flex;
    gap: 40px;
    width: max-content;
    animation: scrollX 25s linear infinite;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 16px;
    color: rgba(255,255,255,0.8);
    font-weight: 600;
    font-size: 1.2rem;
    white-space: nowrap;
    transition: 0.3s ease;
}

.feature-item i {
    color: #e50914;
    font-size: 1.2rem;
}

.feature-item:hover {
    color: #fff;
    transform: scale(1.05);
}

/* ANIMATION */
@keyframes scrollX {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}
.feature-scroll:hover .feature-track {
    animation-play-state: paused;
}
.feature-scroll::before,
.feature-scroll::after {
    content: "";
    position: absolute;
    top: 0;
    width: 80px;
    height: 100%;
    z-index: 2;
}

.feature-scroll::before {
    left: 0;
    background: linear-gradient(to right, #05010f, transparent);
}

.feature-scroll::after {
    right: 0;
    background: linear-gradient(to left, #05010f, transparent);
}

.meta {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    opacity: 0.7;
}
.hero-actions {
    display: flex;
    gap: 15px;
    align-items: center;
}

/* PRIMARY BUTTON (Watch Now) */
.btn-primary-modern {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 10px 22px;
    background: #e50914; /* Netflix-style red */
    color: #fff;
    font-weight: 600;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.3s ease;
   
}

.btn-primary-modern:hover {
    background: #ff1e2d;
    transform: translateY(-2px);
 
}

/* Play icon circle */
.btn-primary-modern .icon-circle {
    width: 32px;
    height: 32px;
    background: #fff;
    color: #e50914;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-primary-modern i {
    font-size: 14px;
}

/* SECONDARY GLASS BUTTON */
.btn-glass {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    background: rgba(255, 255, 255, 0.08);
    color: #fff;
    border-radius: 50px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.15);
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-glass:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
}

/* Equal height buttons */
.btn-equal {
    height: 48px;
}
@media (max-width: 768px) {

.featured-row {
    gap: 20px;
}

.featured-card {
    width: 80%;
    max-width: 280px;
}

.featured-card .poster img {
    height: 300px;
}

.featured-card h6 {
    font-size: 0.9rem;
}
}

        </style>
@endpush

