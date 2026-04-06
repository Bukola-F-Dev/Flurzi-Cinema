@extends('Template::layouts.frontend')
@section('content')
    @php
        $contactContent = getContent('contact.content', true);
    @endphp

    <section class="contact-section-modern py-80">
    <div class="container">

        <div class="contact-wrapper">

            <!-- LEFT: FORM -->
            <div class="contact-form-area">
                <h2 class="contact-title-modern mb-4">{{ __($pageTitle) }}</h2>

                <form class="verify-gcaptcha" method="post" action="">
                    @csrf

                    <div class="form-group mb-3">
                        <label class="form-label-modern">@lang('Name')</label>
                        <input class="form-control input-modern" name="name" type="text"
                            value="{{ old('name', $user?->fullname) }}"
                            @if ($user && $user->profile_complete) readonly @endif required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label-modern">@lang('Email Address')</label>
                        <input class="form-control input-modern" name="email" type="email"
                            value="{{ old('email', $user?->email) }}"
                            @if ($user) readonly @endif required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label-modern">@lang('Subject')</label>
                        <input class="form-control input-modern" name="subject" type="text"
                            value="{{ old('subject') }}" required>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label-modern">@lang('Message')</label>
                        <textarea class="form-control input-modern" name="message" rows="4" required>{{ old('message') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <x-captcha />
                    </div>

                    <button class="btn-auth">
                        <i class="las la-paper-plane me-2"></i>@lang('Send Message')
                    </button>
                </form>
            </div>

            <!-- RIGHT: MAP -->
            <div class="contact-map-area">
                <iframe 
                    src="{{ @$contactContent->data_values->map_link }}"
                    loading="lazy">
                </iframe>
            </div>

        </div>

    </div>
</section>
    <!-- <section class="mt-80 mb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card custom--card">
                        <div class="card-header">
                            <h2 class="contact-form__title">{{ __($pageTitle) }}</h2>
                        </div>
                        <div class="card-body">
                            <form class="verify-gcaptcha" method="post" action="">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label">@lang('Name')</label>
                                    <input class="form-control form--control" name="name" type="text"
                                        value="{{ old('name', $user?->fullname) }}"
                                        @if ($user && $user->profile_complete) readonly @endif required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('Email')</label>
                                    <input class="form-control form--control" name="email" type="email"
                                        value="{{ old('email', $user?->email) }}"
                                        @if ($user) readonly @endif required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('Subject')</label>
                                    <input class="form-control form--control" name="subject" type="text"
                                        value="{{ old('subject') }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">@lang('Message')</label>
                                    <textarea class="form-control form--control" name="message" wrap="off" required>{{ old('message') }}</textarea>
                                </div>
                                <x-captcha />
                                <div class="form-group">
                                    <button class="cmn-btn w-100" type="submit">@lang('Submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-map">
                        <iframe class="contact-map__iframe" src="{{ @$contactContent->data_values->map_link }}"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
@endsection

<style>
    /* WRAPPER (single container) */
.contact-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    backdrop-filter: blur(30px);
margin-top: 180px;
    border-radius: 20px;

    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    overflow: hidden;
 
}
 
.btn-auth {
    width: 100%;
    padding: 14px;
    border-radius: 999px;

    background: linear-gradient(135deg, #a855f7, #6366f1);
    border: none;

    color: #fff;
    font-weight: 600;
    letter-spacing: 0.5px;

transition: all 0.3s ease;
}

/* HOVER */
.btn-auth:hover {
    transform: translateY(-3px) scale(1.02);
}
 
 
.contact-section-modern {
    position: relative;
    padding: 120px 0 100px;
 

    /* Cinematic gradient background */
    background: radial-gradient(circle at 20% 20%, rgba(168,85,247,0.15), transparent 40%),
                radial-gradient(circle at 80% 80%, rgba(99,102,241,0.15), transparent 40%),
                linear-gradient(180deg, #020617, #020617);

    overflow: hidden;
}

/* Glow blobs (extra depth) */
.contact-section-modern::before,
.contact-section-modern::after {
    content: "";
    position: absolute;
    width: 400px;
    height: 400px;
    border-radius: 50%;
    filter: blur(120px);
    opacity: 0.4;
    z-index: 0;
}

.contact-section-modern::before {
    background: #a855f7;
    top: -100px;
    left: -100px;
}

.contact-section-modern::after {
    background: #6366f1;
    bottom: -100px;
    right: -100px;
}

/* Make content stay above background */
.contact-section-modern .container {
    position: relative;
    z-index: 1;
}
/* FORM SIDE */
.contact-form-area {
    padding: 40px;
}

/* MAP SIDE */
.contact-map-area {
    min-height: 100%;
}

.contact-map-area iframe {
    width: 100%;
    height: 100%;
    min-height: 450px;
    border: 0;
}

/* TITLE */
.contact-title-modern {
    font-weight: 600;
    color: #fff;
}

/* INPUTS */
.input-modern {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: #fff;
    border-radius: 10px;
    padding: 12px 14px;
    transition: all 0.3s ease;
}

.input-modern:focus {
    border-color: #e50914;
    background: rgba(255,255,255,0.08);
  
}
 

/* LABEL */
.form-label-modern {
    font-size: 12px;
    color: #aaa;
    text-transform: uppercase;
    margin-bottom: 6px;
}
@media (max-width: 992px) {

.contact-section-modern {
    padding: 80px 15px;
}

.contact-wrapper {
    grid-template-columns: 1fr;
    border-radius: 14px;
}

.contact-form-area {
    padding: 25px 20px;
}

.contact-title-modern {
    font-size: 1.5rem;
    text-align: center;
}

.form-label-modern {
    font-size: 11px;
}

.input-modern {
    font-size: 14px;
    padding: 10px 12px;
}

.btn-auth {
    padding: 12px;
    font-size: 14px;
}

.contact-map-area iframe {
    min-height: 250px;
}
}
    </style>
