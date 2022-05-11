@extends('layouts.includes.app')
@section('title', 'Change password')
@section('content')


<div class="container tab-body">
    <div row>
        <div class="d-flex align-items-start tab-main">
          
            <div class="tab-data col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- fist tab -->
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="add-dctr">
                            <div class="container">

                          
                                <form action="{{ route('update-password') }}" method="POST">
                                    @csrf

                                    <div class="col-md-12">
                                        <label for="Officename">Current Password</label><br>
                                        <input type="password" id="Current" name="current_password">
                                        @error('current_password') <span ...>{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="Officename">New Password</label><br>
                                        <input type="password" id="New" name="new_password">
                                        @error('new_password') <span ...>{{ $message }}</span> @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="Officename">Confirm Password</label><br>
                                        <input type="password" id="New" name="confirm_password">
                                        @error('confirm_password') <span ...>{{ $message }}</span> @enderror
                                    </div>

                                    <input type="submit" value="Update Password">
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- fist tab end -->
                </div>
            </div>
        </div>
    </div>
</div>


@endsection