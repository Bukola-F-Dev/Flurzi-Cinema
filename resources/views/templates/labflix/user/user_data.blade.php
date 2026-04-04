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
                                    <small class="text--danger usernameExist"></small>
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
                                        <small class="text-danger mobileExist"></small>
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
    background: radial-gradient(circle at top left, #0f172a, #020617 60%, #000000) !important;
        color: #fff;
}
.profile-setup {
    min-height: 100vh;
    background: radial-gradient(circle at top left, #0f172a, #020617 60%, #000);
    display: flex;
    align-items: center;
}

/* MAIN CONTAINER */
.setup-wrapper {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 30px 80px rgba(0,0,0,0.6);
}

/* LEFT PANEL */
.setup-visual {
    padding: 60px;
    background: linear-gradient(135deg, rgba(124,58,237,0.25), rgba(79,70,229,0.15));
    color: #fff;
    display: flex;
    align-items: center;
}

/* RIGHT PANEL */
.setup-form {
    padding: 40px;
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
    gap: 8px;
    align-items: center;
}

.phone-group .code {
    padding: 12px;
    background: rgba(255,255,255,0.08);
    border-radius: 12px;
    min-width: 70px;
    text-align: center;
}

/* BUTTON */
.btn-modern {
    background: linear-gradient(135deg, #7c3aed, #4f46e5);
    border: none;
    padding: 14px;
    border-radius: 14px;
    color: white;
    font-weight: 600;
    transition: 0.3s;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(124,58,237,0.35);
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

    /* Inputs */
    .form--control {
        background: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        color: #fff !important;
        border-radius: 12px;
        padding: 12px 14px;
        transition: all 0.25s ease;
    }

    .form--control:focus {
        background: rgba(255, 255, 255, 0.08) !important;
        border-color: #7c3aed !important;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.25);
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
