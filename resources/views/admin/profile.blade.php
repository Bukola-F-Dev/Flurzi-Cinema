@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-4 mb-30">

        <div class="glass-card overflow-hidden">
          
                <div class="profile-header">
    <img src="{{ getImage(getFilePath('adminProfile') . '/' . $admin->image, getFileSize('adminProfile')) }}" alt="Image">

    <div>
        <h5 class="text-white mb-0">{{ __($admin->name) }}</h5>
        <small class="text-light opacity-75">Administrator</small>
    </div>
</div>
<ul class="list-group profile-list px-3 pb-3 pt-2">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Name')
                            <span class="fw-bold">{{ __($admin->name) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="fw-bold">{{ __($admin->username) }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Email')
                            <span class="fw-bold">{{ $admin->email }}</span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 mb-30">
        <div class="glass-card p-4">
                <div class="card-body">
                <h5 class="section-title mb-4">@lang('Profile Information')</h5>

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xxl-4 col-lg-6">
                                <div class="form-group">
                                    <label>@lang('Image')</label>
                                    <x-image-uploader image="{{ $admin->image }}" class="w-100" type="adminProfile" :required=false />
                                </div>
                            </div>
                            <div class="col-xxl-8 col-lg-6">
                            <label>@lang('Name')</label>
                            <div class="input-group mb-3">
    <span class="input-group-text bg-transparent border-0 text-light">
        <i class="las la-user"></i>
    </span>
    <input class="form-control" type="text" name="name" value="{{ $admin->name }}" required>
</div>

<label>@lang('Email')</label>
<div class="input-group mb-3">
    <span class="input-group-text bg-transparent border-0 text-light">
        <i class="las la-envelope"></i>
    </span>
    <input class="form-control" type="email" name="email" value="{{ $admin->email }}" required>
</div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-modern w-100">@lang('Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.password') }}" class="btn btn--sm btn-outline--primary"><i class="las la-key"></i>@lang('Password Setting')</a>
@endpush
@push('style')
    <style>
    /* 🌌 Background depth */
body {
    background: radial-gradient(circle at top, #0f172a, #020617);
}

/* ✨ Glass Card */
.glass-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-radius: 18px;
    border: 1px solid rgba(255,255,255,0.08);
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
    transition: 0.3s ease;
}

.glass-card:hover {
    transform: translateY(-4px);
}

/* 👤 Profile Header */
.profile-header {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.profile-header img {
    width: 65px;
    height: 65px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.3);
}

/* 📋 Info List */
.profile-list .list-group-item {
    background: transparent;
    border: none;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.8);
}

/* 🧾 Form */
.form-control {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    color: #fff;
    border-radius: 10px;
    padding: 10px 12px;
}

.form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 2px rgba(99,102,241,0.3);
}

/* Labels */
label {
    font-size: 13px;
    color: rgba(255,255,255,0.7);
}

/* 🔘 Buttons */
.btn-modern {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border: none;
    border-radius: 12px;
    padding: 12px;
    font-weight: 500;
    transition: 0.25s ease;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(99,102,241,0.4);
}

/* 🧠 Section title */
.section-title {
    font-weight: 600;
    color: #fff;
    font-size: 18px;
}
        .list-group-item:first-child {
            border-top-left-radius: unset;
            border-top-right-radius: unset;
        }
    </style>
@endpush
