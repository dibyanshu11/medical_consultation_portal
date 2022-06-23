@extends('layouts.includes.app')
@section('title', 'Doctor Update')
@section('content')


<div class="tab-body">
    <div class="row">
        <div class="d-flex align-items-start tab-main">

            <div class="tab-data col-md-12">
                <div class="tab-content" id="v-pills-tabContent">



                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                        <div class="container">
                            <div class="add-dctr">

                                <h4>Update Doctor</h4>
                                {!! Form::model($doctors, ['route'=>['doctor-update', $doctors->id], 'method'=>'PATCH', 'enctype'=>'multipart/form-data']) !!}
                                @include('admin.add_doctor.form')
                                <input type="submit" value="Update Doctor">
                                {!! Form::close() !!}
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