@extends('Template::layouts.frontend')
@section('content')

<section class="my-80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-5">

                <div class="card custom--card">

                    <div class="card-header text-center">
                        <h5 class="card-title">@lang('Complete Your Profile')</h5>
                    </div>

                    <div class="card-body p-4">

                        <form method="POST" action="{{ route('user.data.submit') }}">
                            @csrf

                            <div class="row g-3">

                                <!-- Username -->
                                <div class="col-12">
                                    <label class="form-label">@lang('Username')</label>
                                    <input type="text" class="form-control form--control checkUser"
                                        name="username" value="{{ old('username') }}" required>
                                    <small class="text--danger usernameExist"></small>
                                </div>

                                <!-- Country -->
                                <div class="col-lg-6">
                                    <label class="form-label">@lang('Country')</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="las la-globe"></i></span>
                                        <select class="form-control form--control select2" id="country"
                                            name="country" required>
                                            @foreach ($countries as $key => $country)
                                                <option class="text-dark"
                                                    data-mobile_code="{{ $country->dial_code }}"
                                                    data-code="{{ $key }}"
                                                    value="{{ $country->country }}">
                                                    {{ __($country->country) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Mobile -->
                                <div class="col-lg-6">
                                    <label class="form-label">@lang('Mobile')</label>
                                    <div class="input-group">
                                        <span class="input-group-text mobile-code bg--base"></span>
                                        <input name="mobile_code" type="hidden">
                                        <input name="country_code" type="hidden">
                                        <input class="form-control form--control checkUser"
                                            id="mobile" name="mobile" type="number"
                                            value="{{ old('mobile') }}" required>
                                    </div>
                                    <small class="text-danger mobileExist"></small>
                                </div>

                                <!-- Address -->
                                <div class="col-sm-6">
                                    <label class="form-label">@lang('Address')</label>
                                    <input type="text" class="form-control form--control"
                                        name="address" value="{{ old('address') }}">
                                </div>

                                <!-- State -->
                                <div class="col-sm-6">
                                    <label class="form-label">@lang('State')</label>
                                    <input type="text" class="form-control form--control"
                                        name="state" value="{{ old('state') }}">
                                </div>

                                <!-- Zip -->
                                <div class="col-sm-6">
                                    <label class="form-label">@lang('Zip Code')</label>
                                    <input type="text" class="form-control form--control"
                                        name="zip" value="{{ old('zip') }}">
                                </div>

                                <!-- City -->
                                <div class="col-sm-6">
                                    <label class="form-label">@lang('City')</label>
                                    <input type="text" class="form-control form--control"
                                        name="city" value="{{ old('city') }}">
                                </div>

                                <!-- Submit -->
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn--base w-100">
                                        @lang('Submit')
                                    </button>
                                </div>

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
