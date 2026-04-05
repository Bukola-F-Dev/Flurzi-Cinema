@extends('Template::layouts.master')
@section('content')
    <section class="my-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                  


                    <div class="glass-card">

<form class="register" method="post" enctype="multipart/form-data">
    @csrf

    <!-- 👤 PROFILE IMAGE -->
    <div class="dashboard-edit-profile__thumb mb-5">
        <div class="file-upload">
            <label class="edit-pen" for="update-photo">
                <i class="las la-camera"></i>
            </label>
            <input type="file" name="image" id="update-photo" hidden accept=".jpg,.jpeg,.png">
        </div>

        <img id="upload-img"
            src="{{ getImage(getFilePath('userProfile') . '/' . $user->image, getFileSize('userProfile'), true) }}">
    </div>

    <div class="row g-4">

        <!-- First Name -->
        <div class="col-sm-6">
            <label class="form-label">@lang('First Name')</label>
            <div class="input-group-modern">
                <i class="las la-user"></i>
                <input type="text" class="form--control" name="firstname" value="{{ $user->firstname }}" required>
            </div>
        </div>

        <!-- Last Name -->
        <div class="col-sm-6">
            <label class="form-label">@lang('Last Name')</label>
            <div class="input-group-modern">
                <i class="las la-user"></i>
                <input type="text" class="form--control" name="lastname" value="{{ $user->lastname }}" required>
            </div>
        </div>

        <!-- Email -->
        <div class="col-sm-6">
            <label class="form-label">@lang('E-mail Address')</label>
            <div class="input-group-modern">
                <i class="las la-envelope"></i>
                <input class="form--control" value="{{ $user->email }}" readonly>
            </div>
        </div>

        <!-- Mobile -->
        <div class="col-sm-6">
            <label class="form-label">@lang('Mobile Number')</label>
            <div class="input-group-modern">
                <i class="las la-phone"></i>
                <input class="form--control" value="{{ $user->mobile }}" readonly>
            </div>
        </div>

        <!-- Address -->
        <div class="col-sm-6">
            <label class="form-label">@lang('Address')</label>
            <div class="input-group-modern">
                <i class="las la-map-marker"></i>
                <input type="text" class="form--control" name="address" value="{{ $user->address }}">
            </div>
        </div>

        <!-- State -->
        <div class="col-sm-6">
            <label class="form-label">@lang('State')</label>
            <div class="input-group-modern">
                <i class="las la-map"></i>
                <input type="text" class="form--control" name="state" value="{{ $user->state }}">
            </div>
        </div>

        <!-- Zip -->
        <div class="col-sm-6">
            <label class="form-label">@lang('Zip Code')</label>
            <div class="input-group-modern">
                <i class="las la-mail-bulk"></i>
                <input type="text" class="form--control" name="zip" value="{{ $user->zip }}">
            </div>
        </div>

        <!-- City -->
        <div class="col-sm-6">
            <label class="form-label">@lang('City')</label>
            <div class="input-group-modern">
                <i class="las la-city"></i>
                <input type="text" class="form--control" name="city" value="{{ $user->city }}">
            </div>
        </div>

        <!-- Country -->
        <div class="col-sm-12">
            <label class="form-label">@lang('Country')</label>
            <div class="input-group-modern">
                <i class="las la-globe"></i>
                <input class="form--control" value="{{ $user->country_name }}" disabled>
            </div>
        </div>

    </div>

    <!-- SUBMIT -->
    <button type="submit" class="btn btn-modern w-100 mt-4">
        <i class="las la-save me-1"></i> @lang('Update Profile')
    </button>

</form>

</div> 
                </div>
            </div>
        </div>
    </section>


    
<style>
/* 🌐 Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

html, body {
    background: radial-gradient(circle at top, #0f172a, #020617) !important;
    min-height: 100vh;
    font-family: 'Poppins', sans-serif;
}

/* 🌌 Section spacing */
.my-80 {
    padding: 80px 0;
    background: radial-gradient(circle at 20% 20%, rgba(124, 58, 237, 0.25), transparent 40%),
                radial-gradient(circle at 80% 70%, rgba(236, 72, 153, 0.2), transparent 40%),
                linear-gradient(135deg, #020617, #0f172a);
                margin-top:180px;
                margin-bottom:120px;
}
.glass-card {
    transition: all 0.3s ease;
}

.glass-card:hover {
    transform: translateY(-5px);
}

/* ✨ Glass Card */
.glass-card {
    background: rgba(255, 255, 255, 0.06) !important;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.15);
    box-shadow: 0 25px 70px rgba(0,0,0,0.7);
    padding: 35px;
}
.card.custom--card {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}

/* 👤 Profile Image */
.dashboard-edit-profile__thumb {
    position: relative;
    text-align: center;
}

.dashboard-edit-profile__thumb img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    border: 3px solid rgba(255,255,255,0.2);
    transition: 0.3s;
}

.dashboard-edit-profile__thumb:hover img {
    transform: scale(1.05);
}

/* ✏️ Edit icon */
.edit-pen {
    position: absolute;
    right: calc(50% - -35px);
    bottom: 10px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff;
    padding: 8px;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

/* 🧾 Inputs */
.form--control {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    color: #fff;
    padding: 12px;
    transition: 0.25s ease;
}

.form--control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 2px rgba(99,102,241,0.3);
}

/* Labels */
.form-label {
    font-size: 13px;
    color: rgba(255,255,255,0.7);
}

/* 🔘 Button */
.btn-modern {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border: none;
    border-radius: 14px;
    padding: 14px;
    font-weight: 500;
    transition: 0.3s ease;
}

.btn-modern:hover {
    transform: translateY(-2px);
    background: #8b5cf6 !important;
}

.input-group-modern {
    position: relative;
}

.input-group-modern i {
    position: absolute;
    top: 50%;
    left: 12px;
    transform: translateY(-50%);
    color: rgba(255,255,255,0.5);
}

.input-group-modern input {
    padding-left: 35px;
}
</style>
@endsection

