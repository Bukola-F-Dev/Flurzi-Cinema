@extends('Template::layouts.frontend')
@section('content')
    @php
        $banner_content = getContent('banner.content', true);
        $games = App\Models\Game::active()->whereDate('start_time', today())->limit(10)->get();
        $reels = App\Models\Reel::orderBy('id', 'desc')->limit(10)->get();
    @endphp


    <section class="hero" style="background: url('https://images.unsplash.com/photo-1524985069026-dd778a71c7b4?q=80&w=2070') center/cover no-repeat;">
    <div class="hero-overlay"></div>

    <div class="container hero-content">
        <span class="badge badge-glow">Trending Now</span>

        <h1 class="hero-title">
            Welcome to <span>Flurzi</span>
        </h1>

        <p class="hero-subtitle">
            Unlimited Movies, Shows, and More. Experience cinema from home.
        </p>

        <div class="hero-actions">

<!-- WATCH NOW -->
<a href="#" class="btn-watch-wrap">
    <span class="circle">
        <i class="fas fa-play"></i>
    </span>
    <span class="rect">WATCH NOW</span>
</a>

<!-- MORE INFO -->
<a href="#" class="btn-info-wrap">
    <i class="las la-info-circle"></i>
    <span>More Info</span>
</a>

</div>
    </div>
</section>

@include('Template::partials.short_reels')
@include('Template::partials.today_games')

<!-- FEATURED -->
<section class="section-modern">
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
    margin-top: 40px;
}
        /* HERO */
.hero {
    position: relative;
    height: 85vh;
    background: url('../images/banner.jpg') center/cover no-repeat;
    display: flex;
    align-items: center;
    padding: 0;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to right,
        rgba(0,0,0,0.85) 20%,
        rgba(0,0,0,0.4) 60%,
        transparent 100%
    );
}

.hero {
    animation: zoomBg 20s ease-in-out infinite alternate;
}

@keyframes zoomBg {
    from { background-size: 100%; }
    to { background-size: 110%; }
}

.hero-content {
    position: relative;
    max-width: 650px;
    color: #fff;
    color: #fff;
    padding-left: 0 !important; 
}
.container.hero-content {
    padding-left: 5%;
}

.hero-title {
    font-size: 3rem;
    font-weight: 800;
    text-shadow: 0 5px 20px rgba(0,0,0,0.8);
}

.hero-title span {
    color: #e50914;
}

.hero-subtitle {
    opacity: 0.8;
    margin: 15px 0;
}
.hero-actions {
    display: flex;
    gap: 0px; /* tighter */
    margin-top: 20px;
    padding-left: 0 !important;
    margin-top: 20px;
}

/* FORCE SAME WIDTH */
.hero-actions a {
    flex: 1;
    justify-content: center;
    max-width:200px;
}

/* =========================
   WATCH BUTTON (CIRCLE + RECT)
========================= */
.btn-watch-wrap {
    display: flex;
    align-items: center;
    text-decoration: none;
}

/* RED CIRCLE */
.btn-watch-wrap .circle {
    width: 60px;
    height: 60px;
    background: #e50914;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2; /* sits above rectangle */
}

/* ICON */
.btn-watch-wrap .circle i {
    color: #fff;
    font-size: 30px;
}

/* RECTANGLE PART */
.btn-watch-wrap .rect {
    height: 40px;
    width: 170px;
    background: #e50914;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 20px 0 20px;

    /* THIS creates the "joined" look */
    margin-left: -15px;

    border-radius: 0 50px 50px 0;

    font-weight: 700;
    font-size: 13px;
    letter-spacing: 0.5px;
}

/* HOVER */
.btn-watch-wrap:hover .circle,
.btn-watch-wrap:hover .rect {
    background: #ff1e2d;
}


/* =========================
   MORE INFO BUTTON
========================= */
.btn-info-wrap {
    display: flex;
    align-items: center;
    justify-content: center;

    height: 44px;
    padding: 0 20px;

    border-radius: 50px;

    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    color: #fff;

    gap: 8px;
    text-decoration: none;

    border: 1px solid rgba(255,255,255,0.15);
}

/* HOVER */
.btn-info-wrap:hover {
    background: rgba(255,255,255,0.15);
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
    box-shadow: 0 6px 20px rgba(229, 9, 20, 0.3);
}

.btn-primary-modern:hover {
    background: #ff1e2d;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(229, 9, 20, 0.45);
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
        </style>
@endpush

