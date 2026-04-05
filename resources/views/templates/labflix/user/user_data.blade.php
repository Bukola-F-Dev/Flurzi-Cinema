@extends('Template::layouts.frontend')
@section('content')
 
             <section class="profile-setup">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-12 col-lg-10 col-xl-8">

                <div class="setup-wrapper">

                    <!-- LEFT SIDE (visual panel) -->
                    <div class="setup-visual d-none d-lg-flex">
                        <div>
                            <h2>Complete your profile</h2>
                            <p>Let’s personalize your Flurzi Cinema experience.</p>
                        </div>
                    </div>

                    <!-- RIGHT SIDE (FORM) -->
                    <div class="setup-form">

                        <h4 class="mb-4">@lang('Complete Your Profile')</h4>

                        <form method="POST" action="{{ route('user.data.submit') }}">
                            @csrf

                            <div class="form-grid">

                                <!-- Username -->
                                <div class="field full">
                                    <label>Username</label>
                                    <input type="text" name="username" 
                                        value="{{ old('username') }}" class="form-control form--control checkUser" required>
                                    <small class="usernameExist"></small>
                                </div>

                                <div class="field-group">
    <div class="field">
        <label>@lang('Country')</label>
        <select class="form-control form--control select2" id="country" name="country" required>
            @foreach ($countries as $key => $country)
                <option 
                    data-mobile_code="{{ $country->dial_code }}"
                    data-code="{{ $key }}"
                    value="{{ $country->country }}">
                    {{ __($country->country) }}
                </option>
            @endforeach
        </select>
    </div>
</div>

 
<div class="field full phone-group">
    <label>Mobile</label>

    <div class="phone-input">
        <span class="code mobile-code"></span>

        <input type="hidden" name="mobile_code">
        <input type="hidden" name="country_code">

        <input 
            type="number"
            name="mobile"
            class="form-control form--control checkUser"
            id="mobile"
            value="{{ old('mobile') }}"
            required
        >
    </div>

    <small class="mobileExist"></small>
</div>

                             

                                <!-- Address Row -->
                                <div class="field-group">
                                    <div class="field"><label>Address</label><input class="form-control form--control" type="text"  
                                        name="address" value="{{ old('address') }}"></div>
                                    <div class="field"><label>State</label><input class="form-control form--control" type="text"  
                                        name="state" value="{{ old('state') }}"></div>
                                </div>

                                <div class="field-group">
                                    <div class="field"><label>City</label><input class="form-control form--control" type="text" name="city" value="{{ old('city') }}"></div>
                                    <div class="field"><label>Zip</label><input class="form-control form--control" type="text"  
                                        name="zip" value="{{ old('zip') }}"></div>
                                </div>

                                <!-- Submit -->
                                <button type="submit" class="btn-modern w-100 mt-3">
                                @lang('Submit')
                                </button>

                            </div>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

 
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush


@push('script')
    <script>
        "use strict";
        (function($) {

            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('.select2').select2();

            $('select[name=country]').on('change', function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
                var value = $('[name=mobile]').val();
                var name = 'mobile';
                checkUser(value, name);
            });

            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));


            $('.checkUser').on('focusout', function(e) {
                var value = $(this).val();
                var name = $(this).attr('name')
                checkUser(value, name);
            });

            function checkUser(value, name) {
                var url = '{{ route('user.checkUser') }}';
                var token = '{{ csrf_token() }}';

                if (name == 'mobile') {
                    var mobile = `${value}`;
                    var data = {
                        mobile: mobile,
                        mobile_code: $('.mobile-code').text().substr(1),
                        _token: token
                    }
                }
                if (name == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.field} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            }
        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
/* IMPORT FONT */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background: #020617;
}

/* SECTION BACKGROUND */
.profile-setup {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 80px 0;

    /* Deep cinematic gradient */
    background: radial-gradient(circle at 20% 20%, rgba(124, 58, 237, 0.25), transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(236, 72, 153, 0.2), transparent 40%),
                linear-gradient(135deg, #020617, #0f172a);
}
.phone-input {
    display: flex;
    align-items: center;
}
.phone-input .code {
    padding: 0 12px;
    height: 50px;
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.08);
    border-radius: 12px 0 0 12px;
}


/* MAIN WRAPPER */
.setup-wrapper {
    display: flex;
    border-radius: 24px;
    overflow: hidden;

    /* GLASS EFFECT */
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(25px);
    -webkit-backdrop-filter: blur(25px);

    border: 1px solid rgba(255, 255, 255, 0.08);

    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.6);
}
.phone-group.field {
    width: 100%;
}

/* LEFT PANEL */
.setup-visual {
    flex: 1;
    padding: 60px;
    color: #fff;

    display: flex;
    align-items: center;

    background: linear-gradient(160deg, #1e1b4b, #0f172a);
    position: relative;
}

/* glow effect */
.setup-visual::before {
    content: "";
    position: absolute;
    width: 250px;
    height: 250px;
    background: radial-gradient(circle, #a855f7, transparent 70%);
    top: -50px;
    left: -50px;
    opacity: 0.4;
}

/* TEXT */
.setup-visual h2 {
    font-size: 36px;
    font-weight: 600;
    margin-bottom: 15px;
}

.setup-visual p {
    color: #cbd5f5;
    font-size: 15px;
}

/* RIGHT PANEL */
.setup-form {
    flex: 1.3;
    padding: 50px;
    color: #fff;
}

/* FORM GRID */
.form-grid {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

/* FIELD GROUP (2 COLS) */
.field-group {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.field-group .field {
    flex: 1;
}

/* FULL WIDTH FIELD */
.field.full {
    width: 100%;
}

/* LABEL */
.field label {
    font-size: 13px;
    margin-bottom: 6px;
    display: block;
    color: #cbd5e1;
}

/* INPUTS */
.form--control {
    width: 100%;
    height: 50px;
    border-radius: 12px;
    padding: 0 15px;

    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);

    color: #fff;
    font-size: 14px;

    transition: all 0.3s ease;
}

/* INPUT FOCUS */
.form--control:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.25);
    outline: none;
}

/* SELECT */
select.form--control {
    appearance: none;
}
.field-group .phone-group {
    flex: 0 0 100%;
}

/* PHONE GROUP */
.phone-group {
    display: flex;
    align-items: center;
    width: 100%;
}

.phone-group .code {
    padding: 0 12px;
    height: 50px;
    display: flex;
    align-items: center;

    border-radius: 12px 0 0 12px;
    background: rgba(255, 255, 255, 0.08);
    border-right: none;
}

.phone-group input {
    border-radius: 0 12px 12px 0;
}

/* BUTTON */
.btn-modern {
    height: 55px;
    border-radius: 14px;
    border: none;

    font-weight: 500;
    font-size: 15px;

    color: #fff;

    background: linear-gradient(90deg, #a855f7, #6366f1);
    transition: all 0.3s ease;
}

.phone-input input {
    border-radius: 0 12px 12px 0;
}

/* BUTTON HOVER (FIXED - NO RED!) */
.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(139, 92, 246, 0.4);

    background: linear-gradient(90deg, #9333ea, #4f46e5);
}

/* SMALL TEXT */
small {
    font-size: 12px;
    color: #94a3b8;
}
.country__select {
            .select2-container--default .select2-selection--single {
                border-bottom-left-radius: 0;
                border-top-left-radius: 0;
            }
        }

/* RESPONSIVE */
@media (max-width: 992px) {
    .setup-wrapper {
        flex-direction: column;
    }

    .setup-visual {
        display: none;
    }

    .setup-form {
        padding: 30px;
    }

    .field-group {
        flex-direction: column;
    }
}


    </style>
@endpush
