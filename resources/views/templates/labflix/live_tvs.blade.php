@extends('Template::layouts.frontend')

@section('content')
   
<section class="live-hero">
    <div class="live-hero-overlay"></div>

    <div class="container text-center">
        <h1 class="live-title">Live TV List</h1>
        <p class="breadcrumb-text">
            <i class="fas fa-home"></i> Home • Live TV List
        </p>
    </div>
</section>

<section class="shorts-section mt-80 mb-80">
        <div class="container">
            <ul class="nav nav-pills event--tab mb-4" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true"> All Channels
                    </button>
                </li>
                @foreach ($channelCategories as $key => $category)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-{{ $key }}-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-{{ $key }}" type="button" role="tab"
                            aria-controls="pills-{{ $key }}" aria-selected="false"> {{ __($category->name) }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    @foreach ($channelCategories as $category)
                        @php
                            $eligable = false;
                            if (auth()->check()) {
                                $subscribedChannels = auth()->user()->subscribedChannelId();
                                $eligable = in_array($category->id, $subscribedChannels) ? true : false;
                            }
                        @endphp
                        <div class="tv-live">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                                <div class="d-flex flex-wrap gap-2 gap-md-3">
                                    <h5 class="channel-title">{{ __($category->name) }} @lang('Channels')</h5>
                                    @if (!$eligable)
                                        <button class="btn btn--light btn--sm channelSubscribeBtn"
                                            data-id="{{ $category->id }}" data-price="{{ showAmount($category->price) }}">
                                            <span class="icon"><i class="fas fa-rocket fa-lg"></i></span>
                                            @lang('Subscribe')
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="tv-grid">
                                @foreach ($category->channels as $channel)
                                    <a href="{{ route('watch.tv', $channel->id) }}" class="tv-channel modern-channel" alt="tv-channel">
                                        <div class="tv-channel__thumb">
                                            <span><img
                                                    src="{{ getImage(getFilePath('television') . '/' . $channel->image, getFileSize('television')) }}"
                                                    class="w-100"></span>
                                            <span class="play-btn-icon">
                                                <i class="las la-play"></i>
                                            </span>
                                        </div>
                                        <div class="tv-channel__content">
                                            <h6 class="tv-channel__title"> {{ __($channel->title) }} </h6>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                @foreach ($channelCategories as $key => $category)
                    <div class="tab-pane fade" id="pills-{{ $key }}" role="tabpanel"
                        aria-labelledby="pills-{{ $key }}-tab" tabindex="0">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                            @php
                                $eligable = false;
                                if (auth()->check()) {
                                    $subscribedChannels = auth()->user()->subscribedChannelId();
                                    $eligable = in_array($category->id, $subscribedChannels) ? true : false;
                                }
                            @endphp
                            <div class="d-flex flex-wrap gap-2 gap-md-3">
                                <h4 class="channel-title">{{ __($category->name) }} @lang('Channels')</h4>
                                @if (!$eligable)
                                    <button class="btn btn--light btn--sm channelSubscribeBtn"
                                        data-id="{{ $category->id }}" data-price="{{ showAmount($category->price) }}">
                                        <span class="icon"><i class="fas fa-rocket fa-lg"></i></span>
                                        @lang('Subscribe')
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="tv-card-wrapper">
                            @foreach ($category->channels as $channel)
                            <a href="{{ isPremium() ? route('watch.tv', $channel->id) : '/subscription' }}" 
   class="tv-channel" alt="tv-channel">
                                    <div class="tv-channel__thumb">
                                        <span><img
                                                src="{{ getImage(getFilePath('television') . '/' . $channel->image, getFileSize('television')) }}"
                                                class="w-100"></span>
                                                <span class="play-btn-icon">
    @if(isPremium())
        <i class="las la-play"></i>
    @else
        🔒
    @endif
</span>
                                    </div>
                                    <div class="tv-channel__content">
                                        <h6 class="tv-channel__title"> {{ __($channel->title) }} </h6>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="modal alert-modal" id="channelModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST">
                    @csrf
                    <div class="modal-body">
                        <span class="alert-icon"><i class="fas fa-question-circle"></i></span>
                        <p class="modal-description">@lang('Confirmation Alert!')</p>
                        <p class="modal--text">@lang('Are you sure to subscribe to this channel group?')</p>
                        <p class="modal--text">@lang('Monthly subscription price is ') <span class="subscription-price"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--dark btn--sm" data-bs-dismiss="modal"
                            type="button">@lang('No')</button>
                        <button class="btn btn--base btn--sm" type="submit">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('style')
    <style>
        /* SECTION */
.shorts-section {
    padding: 60px 0;
}

/* TABS */
.modern-tabs {
    gap: 10px;
    flex-wrap: wrap;
}

.modern-tabs .nav-link {
    border-radius: 50px;
    padding: 8px 18px;
    background: rgba(255,255,255,0.05);
    color: #aaa;
    border: 1px solid transparent;
    transition: 0.3s;
}

.modern-tabs .nav-link.active {
    background: #e50914;
    color: #fff;
}

.modern-tabs .nav-link:hover {
    color: #fff;
}

/* GRID */
.tv-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 20px;
}

/* CARD */
.modern-channel {
    text-decoration: none;
    display: block;
    transition: 0.3s;
}

/* THUMB */
.tv-channel__thumb {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
}

.tv-channel__thumb img {
    transition: 0.4s;
}

/* HOVER ZOOM */
.modern-channel:hover img {
    transform: scale(1.1);
}

/* DARK OVERLAY */
.tv-channel__thumb::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    opacity: 0;
    transition: 0.3s;
}

.modern-channel:hover .tv-channel__thumb::after {
    opacity: 1;
}

/* PLAY BUTTON */
.play-btn-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.8);
    background: rgba(229,9,20,0.9);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: 0.3s;
    color: #fff;
    font-size: 22px;
}

.modern-channel:hover .play-btn-icon {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
}

/* TITLE */
.tv-channel__title {
    margin-top: 10px;
    color: #ddd;
    font-size: 14px;
    transition: 0.3s;
}

.modern-channel:hover .tv-channel__title {
    color: #fff;
}

/* SUBSCRIBE BUTTON */
.channelSubscribeBtn {
    background: linear-gradient(135deg, #e50914, #ff2e63);
    border: none;
    border-radius: 50px;
    color: #fff;
    padding: 6px 16px;
    font-size: 13px;
    transition: 0.3s;
}

.channelSubscribeBtn:hover {
    transform: scale(1.05);
}

/* SECTION TITLE */
.channel-title {
    color: #fff;
    font-weight: 600;
}
        .tv-card__thumb {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            overflow: hidden;
        }

        @media (max-width: 1199px) {
            .tv-card__thumb {
                width: 106px;
                height: 106px;
            }
        }

        @media (max-width: 767px) {
            .tv-card__thumb {
                width: 93px;
                height: 93px;
            }
        }

        @media (max-width: 575px) {
            .tv-card__thumb {
                width: 85px;
                height: 85px;
            }
        }
        /* HERO SECTION */
.live-hero {
    position: relative;
    height: 350px;
    background: url('https://images.unsplash.com/photo-1608889175123-8ee362201f81') center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding-top:80px;
}

/* DARK OVERLAY (cinematic feel) */
.live-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(0,0,0,0.4),
        rgba(11,11,15,0.95)
    );
}

/* CONTENT */
.live-hero .container {
    position: relative;
    z-index: 2;
}
.live-hero::after {
    content: "";
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 120px;
    background: linear-gradient(to bottom, transparent, #0b0b0f);
}

/* TITLE */
.live-title {
    font-size: 42px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 10px;
}

/* BREADCRUMB */
.breadcrumb-text {
    color: #ccc;
    font-size: 14px;
}

.breadcrumb-text i {
    color: #e50914;
}

        .tv-card-wrapper {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
            gap: 12px;
        }

        .tv-card {
            display: flex;
            justify-content: center;
        }
    </style>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.channelSubscribeBtn').on('click', function(e) {
                e.preventDefault();
                let modal = $("#channelModal");
                modal.find('.subscription-price').text($(this).data('price'));
                modal.find('form').attr('action',
                    `{{ route('user.subscribe.channel', '') }}/${$(this).data('id')}`)
                modal.modal('show');
            });
        })(jQuery)
    </script>
@endpush
