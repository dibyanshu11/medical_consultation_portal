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
<div class="container">
    <div class="form-section">
             
            <form method="POST" action="{{ route('password.update') }}">
			<input type="hidden" name="token" value="{{ request()->route('token') }}">
                @csrf
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif
            
               
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
							<input type="password" class="@error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}" required autocomplete="password_confirmation" autofocus>
                             
							 @error('password_confirmation')
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
						<button class="btns" type="submit" id="submitButton">{{ __('Reset Password') }}</button>
					</div>
                    </div>
                </div>
             
            </form>
    </div>
</div>

@endsection