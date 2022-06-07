@extends('layouts.includes.top_header')

@section('content')
<section class="title-box">
    <div class="container">
        <div class="row">
            <div class="col-12 py-3 py-md-4">
                <h2 class="page-title">Login</h2>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-12">

                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    <div class="row py-4">

                        <div class="col-md-12">
                            <label>Email</label>
                            <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <!-- <input type="text" name="" /> -->
                        </div>
                        <div class="col-md-12">
                            <label>Password</label>
                            <input type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <!-- <input type="password" name="" /> -->
                        </div>


                        <div class="col-md-12 text-end">
                            @if (Route::has('password.request'))
                            <a class="blk-text" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                            @endif
                        </div>
                        <div class="col-md-12 art-submit-btn py-3">

                            <button type="submit" class="btns">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="col-md-12 art-submit-btn py-3">
                            Don't have an account yet? <a class="btn btn-link" href="{{ route('register') }}">
                                Register
                            </a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection