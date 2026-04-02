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
    
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    backdrop-filter: blur(25px);
margin-top: 180px;
    border-radius: 16px;

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
}

/* HOVER */
.btn-auth:hover {
       transform: translateY(-2px);
}
.contact-section-modern {
    margin-top: 80px; 
    padding-top:120px;
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
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    color: #fff;
}

.input-modern:focus {
    border-color: #e50914;
    box-shadow: none;
}

/* LABEL */
.form-label-modern {
    font-size: 12px;
    color: #aaa;
    text-transform: uppercase;
    margin-bottom: 6px;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .contact-wrapper {
        grid-template-columns: 1fr;
    }

    .contact-map-area iframe {
        min-height: 300px;
    }
}
.btn-danger {
    background-color: #e50914 !important;
    border-color: #e50914 !important;
    color: #fff !important;
}

.btn-danger:hover {
    background-color: #ff1f2d !important;
    border-color: #ff1f2d !important;
}
    </style>
