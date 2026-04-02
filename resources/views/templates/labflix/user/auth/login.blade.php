@extends('Template::layouts.frontend')

@section('content')
    @php
        $login = getContent('login.content', true);
    @endphp

    <section class="auth-modern">
    <div class="auth-overlay"></div>

    <div class="container">
        <div class="auth-wrapper">

            <!-- LOGO -->
            <div class="auth-header text-center">
                        <div class="flurzi-logo mb-3">
    <span class="logo-dot"></span>
    <span class="logo-text">
        FLURZI<span>CINEMA</span>
    </span>
    <h2>Welcome Back</h2>
                <p>Login to continue your movie experience</p>
</div>
                        </div>
                        <div class="right">
                            <div class="text-center">
                                @include('Template::partials.social_login')
                            </div>

     <!-- FORM -->
     <form class="auth-form verify-gcaptcha" action="{{ route('user.login') }}" method="post">
                @csrf

                <div class="form-group">
                    <label>@lang('Username')</label>
                    <input class="form-control" name="username" type="text" value="{{ old('username') }}"
                        placeholder="Enter your username">
                </div>

                <div class="form-group">
                    <label>@lang('Password')</label>
                    <input class="form-control" name="password" type="password"
                        placeholder="Enter your password">
                </div>

                <x-captcha />

                <button class="btn-auth" type="submit">
                    @lang('Login')
                </button>

                <p class="auth-extra">
                    @lang('Forgot password?')
                    <a href="{{ route('user.password.request') }}">@lang('Reset now')</a>
                </p>

                <!-- SOCIAL LOGIN -->
                <div class="auth-social text-center">
                    @include('Template::partials.social_login')
                </div>

            </form>

        </div>
    </div>
</section>
@endsection

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

/* SECTION BACKGROUND */
.auth-modern {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;

    background: radial-gradient(circle at 20% 30%, rgba(168,85,247,0.25), transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(99,102,241,0.25), transparent 40%),
                linear-gradient(135deg, #05010a, #0b0120);

    font-family: 'Poppins', sans-serif;
}

/* OVERLAY */
.auth-overlay {
    position: absolute;
    inset: 0;
    background: rgba(5, 1, 15, 0.6);
    backdrop-filter: blur(8px);
}

/* CARD */
.auth-wrapper {
    position: relative;
    z-index: 2;

    width: 100%;
    max-width: 420px;
    padding: 40px;

    border-radius: 20px;

    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);

    backdrop-filter: blur(20px);
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}

/* HEADER */
.auth-header img {
    width: 80px;
    margin-bottom: 15px;
}

.auth-header h2 {
    font-weight: 600;
    color: #fff;
    margin-bottom: 5px;
}

.auth-header p {
    font-size: 14px;
    color: #aaa;
}

/* FORM */
.auth-form .form-group {
    margin-bottom: 18px;
}

.auth-form label {
    font-size: 13px;
    color: #bbb;
    margin-bottom: 5px;
    display: block;
}

.auth-form .form-control {
    width: 100%;
    padding: 12px 15px;
    border-radius: 12px;

    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);

    color: #fff;
    font-size: 14px;
}

.auth-form .form-control:focus {
    outline: none;
    border-color: #a855f7;
    box-shadow: 0 0 10px rgba(168,85,247,0.4);
}

/* BUTTON */
.btn-auth {
    width: 100%;
    padding: 12px;
    border-radius: 999px;
    border: none;

    background: linear-gradient(135deg, #a855f7, #6366f1);
    color: #fff;
    font-weight: 500;

    transition: 0.3s ease;
    margin-top: 10px;
}

.btn-auth:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(168,85,247,0.5);
}

/* EXTRA LINKS */
.auth-extra {
    margin-top: 15px;
    font-size: 13px;
    color: #aaa;
    text-align: center;
}

.auth-extra a {
    color: #a855f7;
    text-decoration: none;
}

/* SOCIAL */
.auth-social {
    margin-top: 20px;
}
</style>
