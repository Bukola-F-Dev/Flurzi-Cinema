@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">

    <h2 class="mb-4">Choose Your Plan</h2>

    <div class="row justify-content-center">

        {{-- FREE --}}
        <div class="col-md-3">
            <div class="card p-4">
                <h4>Free</h4>
                <p>Ads + No tournaments</p>
                <h3>£0</h3>
            </div>
        </div>

        {{-- BASIC --}}
        <div class="col-md-3">
            <div class="card p-4">
                <h4>Basic</h4>
                <p>Ads + Tournament Access</p>
                <h3>£6.99</h3>
                <a href="{{ route('subscribe.plan','basic') }}" class="btn btn-danger">Subscribe</a>
            </div>
        </div>

        {{-- PREMIUM --}}
        <div class="col-md-3">
            <div class="card p-4">
                <h4>Premium</h4>
                <p>No Ads + Tournament Access</p>
                <h3>£10.99</h3>
                <a href="{{ route('subscribe.plan','premium') }}" class="btn btn-dark">Go Premium</a>
            </div>
        </div>

    </div>
</div>
@endsection