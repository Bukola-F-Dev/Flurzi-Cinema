@extends('Template::layouts.frontend')

@section('content')
    @php
        $login = getContent('login.content', true);
    @endphp

    <section class="auth-modern">
    <div class="auth-overlay"></div>

    <div class="auth-full">

        <!-- LEFT SIDE -->
        <div class="auth-left">
            <div class="flurzi-logo mb-4">
                <span class="logo-dot"></span>
                <span class="logo-text">
                    FLURZI<span>CINEMA</span>
                </span>
            </div>

            <h1>Welcome Back</h1>
            <p>Login to continue your movie experience</p>
        </div>

        <!-- RIGHT SIDE -->
        <div class="auth-right">

            <form class="auth-form verify-gcaptcha" action="{{ route('user.login') }}" method="post">
                @csrf

                <!-- USERNAME -->
                <div class="form-group">
                    <label>@lang('Username')</label>
                    <div class="icon-input">
                        <i class="fas fa-user"></i>
                        <input name="username" type="text"
                            value="{{ old('username') }}"
                            placeholder="Enter your username">
                    </div>
                </div>

                <!-- PASSWORD -->
                <div class="form-group">
                    <label>@lang('Password')</label>
                    <div class="icon-input">
                        <i class="fas fa-lock"></i>
                        <input name="password" type="password"
                            placeholder="Enter your password">
                    </div>
                </div>

                <x-captcha />

                <button class="btn-auth" type="submit">
                    @lang('Login')
                </button>

                <p class="auth-extra">
                    @lang('Forgot password?')
                    <a href="{{ route('user.password.request') }}">@lang('Reset now')</a>
                </p>

                <div class="auth-social">
                    @include('Template::partials.social_login')
                </div>

            </form>

        </div>

    </div>
</section>
@endsection

<style>

* {
    box-sizing: border-box;
}
/* FULL LAYOUT */
.auth-full {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    max-width: 1000px;
    margin: auto;
    gap: 60px;
    padding: 40px;
    margin-top:180px;
    border-radius: 20px; 
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    margin-bottom:120px;

    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    backdrop-filter: blur(25px);
    
}
 
.auth-full::before {
    content: "";
    position: absolute;
    width: 400px;
    height: 400px;
    top: -100px;
    left: -100px;

    background: radial-gradient(circle, rgba(168,85,247,0.4), transparent 70%);
    filter: blur(80px);
    z-index: 0;
}

/* BLUE GLOW (bottom-right) */
.auth-full::after {
    content: "";
    position: absolute;
    width: 400px;
    height: 400px;
    bottom: -120px;
    right: -120px;

    background: radial-gradient(circle, rgba(99,102,241,0.35), transparent 70%);
    filter: blur(80px);
    z-index: 0;
}

/* Make content stay above glow */
.auth-full > * {
    position: relative;
    z-index: 2;
}
/* LEFT SIDE */
.auth-left {
    flex: 1;
    color: #fff;
}

.auth-left h1 {
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 10px;
}

.auth-left p {
    color: #aaa;
    font-size: 16px;
}

/* RIGHT SIDE */
.auth-right {
    flex: 1;
}

/* REMOVE SMALL BOX FEEL */
.auth-wrapper {
    max-width: none;
    background: none;
    border: none;
    box-shadow: none;
    padding: 0;
}

/* FORM */
.auth-form {
    width: 100%;
}

/* INPUT WITH ICON */
.icon-input {
    position: relative;
    margin-bottom: 20px;
}

.icon-input i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #888;
}

.icon-input input {
    width: 100%;
    padding: 14px 15px 14px 45px;
    border-radius: 12px;

    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);

    color: #fff;
    font-size: 14px;
}

.icon-input input:focus {
    outline: none;
    border-color: #a855f7;
 
}

/* BUTTON */
.btn-auth {
    width: 100%;
    padding: 14px;
    border-radius: 999px;
    border: none;

    background: linear-gradient(135deg, #a855f7, #6366f1);
    color: #fff;
    font-weight: 600;

    transition: 0.3s ease;
}

.btn-auth:hover {
    transform: translateY(-2px);
}

/* EXTRA */
.auth-extra {
    margin-top: 15px;
    font-size: 13px;
    color: #aaa;
    text-align: center;
}

.auth-extra a {
    color: #a855f7;
}

/* SOCIAL */
.auth-social {
    margin-top: 25px;
    text-align: center;
} 


/* =========================
   TABLET (<= 992px)
========================= */
@media (max-width: 992px) {

.auth-full {
    flex-direction: column;
    gap: 25px;
    padding: 25px;
margin-top:100px;
    width: 100%;
    max-width: 100%;
    margin: 60px 10px;
    box-sizing: border-box;
    overflow-x: hidden;
}

 
.auth-left,
.auth-right {
    width: 100%;
    text-align: left; /* FIX: was center */
}

.auth-left h1 {
    font-size: 34px;
}

.auth-left p {
    font-size: 15px;
}
}

/* =========================
MOBILE (<= 576px)
========================= */
@media (max-width: 576px) {

html, body {
    overflow-x: hidden; /* FIX RIGHT SIDE SCROLL */
}

.auth-modern {
    width: 100%;
    overflow-x: hidden;
}

.auth-full {
    padding: 18px;
    margin: 90px 10px;
    border-radius: 15px;

    width: auto;
    max-width: 100%;
    box-sizing: border-box;
}

/* KEEP TEXT LEFT ALIGNED */
.auth-left,
.auth-right {
    text-align: left !important;
}

.auth-left h1 {
    font-size: 26px;
}

.auth-left p {
    font-size: 13px;
}

/* INPUT FIX */
.icon-input input {
    padding: 12px 12px 12px 40px;
    font-size: 13px;
    width: 100%;
    box-sizing: border-box;
}

/* BUTTON */
.btn-auth {
    padding: 12px;
    font-size: 14px;
    width: 100%;
}
} 
</style>
