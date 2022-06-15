@extends('layouts.includes.top_header')
@section('content')
<section class="title-box">
    <div class="container">
        <div class="row">
            <div class="col-12 py-3 py-md-4">
                <h2 class="page-title">Register</h2>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="form-section">

        
            <form method="POST" action="{{ route('register') }}">
                @csrf
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="my-name">
                            <label>First name</label>
                            <input type="text" class="@error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <!-- <input type="text" name="fname"> -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="my-name">
                            <label for="fname">Last name</label>
                            <input type="text" class="@error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mail">
                            <label for="fname">Mobile Number</label>
                            <input type="text" class="@error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mail">
                            <label for="fname">Email</label>
                            <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mail">
                            <label for="fname">Password</label>
                            <input type="password" class="@error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="mail">
                            <label for="fname">Conform password</label>
                            <input type="password" class="@error('confirm_password') is-invalid @enderror" name="confirm_password" value="{{ old('confirm_password') }}" required autocomplete="confirm_password" autofocus>

                            @error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="s-btn">
                        <div class="col-md-12 art-submit-btn py-3">
                            <button class="btns" type="submit">Register</button>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 art-submit-btn py-3">

                        Already a member? <a class="btn btn-link" href="{{ route('login') }}">
                            Login
                        </a>

                    </div>
                </div>
            </form>
    </div>
</div>

@endsection