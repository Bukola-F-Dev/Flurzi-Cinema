@extends('Template::layouts.frontend')
@section('content')

{{ request()->route()->getName() }}

    <section class="current-live-match-section">
        <div class="container">
            <div class="row justify-content-center gy-3">
                @forelse ($tournaments as $tournament)
                    @php
                        $version = $tournament->versionName;
                        if (auth()->check()) {
                            $subscribedTournaments = auth()->user()->subscribedTournamentId();
                            $version = in_array($tournament->id, $subscribedTournaments) ? 'Watch' : $version;
                        }
                    @endphp
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
    <a href="{{ route('tournament.detail', [$tournament->id, slug($tournament->name)]) }}"
       class="live-card">

        <div class="live-card__image">
            <img src="{{ getImage(getFilePath('tournament') . '/thumb_' . $tournament->image, getFileThumb('tournament')) }}" alt="">

            <!-- overlay -->
            <div class="live-card__overlay"></div>

            <!-- play button -->
            <div class="live-card__play">
                <i class="las la-play"></i>
            </div>

            <!-- badge -->
            <span class="live-card__badge">{{ __($version) }}</span>
        </div>

        <div class="live-card__content">
            <h6>{{ __($tournament->name) }}</h6>
        </div>
    </a>
</div>
                @empty
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <img src="{{ asset(activeTemplate(true) . 'images/no-results.png') }}" alt="">
                    </div>
                @endforelse
                {{ paginateLinks($tournaments) }}
            </div>
        </div>
    </section>
@endsection

@push('style')
<style>
.current-live-match-section {
    padding: 80px 0;

    background: 
        linear-gradient(
            to bottom,
            rgba(11,11,15,0.95),
            rgba(18,18,26,0.95)
        ),
        url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba?q=80&w=2070')
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh; /* force visibility */
}

/* CARD */
.live-card {
    display: block;
    border-radius: 18px;
    overflow: hidden;
    position: relative;
    background: rgba(255,255,255,0.03);
    backdrop-filter: blur(10px);
    transition: all 0.4s ease;
}

/* IMAGE */
.live-card__image {
    position: relative;
    overflow: hidden;
}

.live-card__image img {
    width: 100%;
    height: 230px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

/* OVERLAY */
.live-card__overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
    opacity: 0.7;
}

/* PLAY BUTTON */
.live-card__play {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.8);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(229,9,20,0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 26px;
    opacity: 0;
    transition: all 0.3s ease;
}

/* BADGE */
.live-card__badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(135deg, #e50914, #ff2a3d);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    color: #fff;
    box-shadow: 0 0 10px rgba(229,9,20,0.6);
}

/* CONTENT */
.live-card__content {
    padding: 15px;
}

.live-card__content h6 {
    color: #fff;
    font-weight: 600;
    font-size: 15px;
    margin: 0;
}

/* HOVER EFFECT */
.live-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.6);
}

.live-card:hover img {
    transform: scale(1.1);
}

.live-card:hover .live-card__play {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
}

</style>

@endpush
