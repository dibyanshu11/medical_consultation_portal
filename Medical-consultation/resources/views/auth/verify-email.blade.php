@extends('layouts.includes.top_header')
@section('content')
<section class="title-box">
    <div class="container">
        <div class="row">
            <div class="col-12 py-3 py-md-4">
                <h2 class="page-title">Verify Your Email Address</h2>
            </div>
        </div>
    </div>
</section>

<div class="form-section1">
    <div class="card-body">
        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="uppr-txt">
                        <h6>Verify your email Address</h6>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="lower-txt">
                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                        @endif
                        <p>Before proceeding please check your email for a verification link. if you did not receive the email.
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>
                        </p>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>


@endsection