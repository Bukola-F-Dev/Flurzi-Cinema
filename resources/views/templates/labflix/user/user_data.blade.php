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


                                <!-- Country + Mobile (FIXED) -->
                                <div class="field-group">

                                    <div class="field">
                                        <label>@lang('Country')</label>
                                        <select class="form-control form--control select2" id="country" name="country" required>
                                            @foreach ($countries as $key => $country)
                                                <option data-mobile_code="{{ $country->dial_code }}"
                                                data-code="{{ $key }}"
                                                        value="{{ $country->country }}">
                                                    {{ __($country->country) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="field">
                                        <label>Mobile</label>
                                        <div class="phone-group">
                                            <span class="code mobile-code"> 
                                        <input name="mobile_code" type="hidden">
                                        <input name="country_code" type="hidden"></span>
                                            <input type="number" name="mobile" class="form-control form--control checkUser"  id="mobile" name="mobile"
                                            value="{{ old('mobile') }}" required>
                                        </div>
                                        <small class=" mobileExist"></small>
                                    </div>

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

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

html, body {
    min-height: 100vh;
    font-family: 'Poppins', sans-serif;
    background: 
        radial-gradient(circle at 20% 20%, rgba(124,58,237,0.25), transparent 40%),
        radial-gradient(circle at 80% 30%, rgba(79,70,229,0.2), transparent 40%),
        #020617;
        color: #fff;
}
body {
  
}
.profile-setup {
    min-height: 100vh;
    background: radial-gradient(circle at top left, #0f172a, #020617 60%, #000);
    display: flex;
    align-items: center;
        margin-top:180px;
    margin-bottom:120px;
}

/* MAIN CONTAINER */
.setup-wrapper {
    display: grid;
    grid-template-columns: 1.1fr 1.4fr;
    max-width: 1100px;
    margin: auto;
    background: linear-gradient(145deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
    backdrop-filter: blur(30px);
    border-radius: 28px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.08);
    box-shadow: 
        0 40px 100px rgba(0,0,0,0.7),
        inset 0 1px 0 rgba(255,255,255,0.05);
}

/* LEFT PANEL */
.setup-visual {
    padding: 80px 60px;
    background: linear-gradient(160deg, #1e1b4b, #312e81);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.setup-visual::before {
    content: '';
    position: absolute;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(124,58,237,0.6), transparent);
    top: -50px;
    left: -50px;
    filter: blur(80px);
}

.setup-visual h2 {
    font-size: 32px;
    font-weight: 600;
    line-height: 1.3;
}

.setup-visual p {
    opacity: 0.7;
    margin-top: 10px;
}

/* RIGHT PANEL */
.setup-form {
    padding: 60px;
}

/* GRID */
.form-grid {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.field-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.field.full {
    grid-column: span 2;
}

/* PHONE GROUP FIX */
.phone-group {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.05);
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.12);
    overflow: hidden;
}

.phone-group .code {
    padding: 12px 16px;
    background: rgba(255,255,255,0.08);
    color: #cbd5f5;
    font-weight: 500;
    border-right: 1px solid rgba(255,255,255,0.1);
}

.phone-group input {
    flex: 1;
    border: none !important;
    background: transparent !important;
}

/* BUTTON */
.btn-modern {
    height: 52px;
    font-size: 16px;
    border-radius: 16px;
    background: linear-gradient(135deg, #8b5cf6, #6366f1);
    position: relative;
    overflow: hidden;
}

.btn-modern {
    height: 52px;
    font-size: 16px;
    border-radius: 16px;
    background: linear-gradient(135deg, #8b5cf6, #6366f1) !important;
    border: none !important;
    color: #fff !important;
    font-weight: 600;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

/* FIXED HOVER */
.btn-modern:hover {
    background: linear-gradient(135deg, #7c3aed, #4f46e5) !important;
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(124,58,237,0.35);
}

.btn-modern:focus,
.btn-modern:active {
    background: linear-gradient(135deg, #7c3aed, #4f46e5) !important;
    outline: none;
    box-shadow: 0 0 0 4px rgba(139,92,246,0.25);
}
@media (max-width: 992px) {
    .setup-wrapper {
        grid-template-columns: 1fr;
    }

    .setup-form {
        padding: 30px;
    }

    .field-group {
        grid-template-columns: 1fr;
    }
}
        .country__select {
            .select2-container--default .select2-selection--single {
                border-bottom-left-radius: 0;
                border-top-left-radius: 0;
            }
        }
  
    .my-80 {
        padding: 80px 0;
    }

    /* Glass Card */
    .custom--card {
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 18px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .custom--card:hover {
        transform: translateY(-4px);
        box-shadow: 0 25px 80px rgba(0, 0, 0, 0.75);
    }

    .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(255,255,255,0.08);
        padding: 20px;
    }

    .card-title {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .form--control {
    height: 48px;
    font-size: 14px;
    border-radius: 14px;
    background: rgba(255,255,255,0.04) !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
    transition: all 0.25s ease;
}

.form--control:focus {
    border-color: #8b5cf6 !important;
    transform: scale(1.02);
}

    .form-label {
        font-weight: 500;
        font-size: 13px;
        margin-bottom: 6px;
        color: rgba(255,255,255,0.8);
    }

    /* Input group glass */
    .input-group-text {
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #cbd5e1;
        border-radius: 12px;
    }

    .input-group .form-control {
        border-left: none;
    }

    /* Button */
    .btn--base {
        background: linear-gradient(135deg, #7c3aed, #4f46e5);
        border: none;
        padding: 12px;
        border-radius: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: 0.3s ease;
    }

    .btn--base:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(124, 58, 237, 0.4);
    }

    /* Select */
    select.form--control {
        appearance: none;
    }

    /* Error text */
    .text--danger, .text-danger {
        font-size: 12px;
        margin-top: 4px;
    }
    </style>
@endpush
