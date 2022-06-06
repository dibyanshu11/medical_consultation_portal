@extends('layouts.includes.top_header')

@section('content')
<section class="title-box">
    <div class="container">
        <div class="row">
            <div class="col-12 py-3 py-md-4">
                <h2 class="page-title">Reset Password</h2>
            </div>
        </div>
    </div>
</section>


<div class="form-section">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="mail">
                    <label for="fname">Email</label>
                    <!-- <input type="email" name="email"> -->
                    <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="Password-btn">
            <div class="row">
                <div class="col-md-12 art-submit-btn py-3">
                    <!-- <input type="submit" value="Send password Reset link" name="" class="btns" /> -->
                    <button type="submit" class="btns" >
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection