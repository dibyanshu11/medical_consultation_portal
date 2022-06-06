@extends('layouts.includes.app')
@section('title', 'Add Doctor')
@section('content')


<div class="container tab-body">
    <div row>
        <div class="d-flex align-items-start tab-main">

            <div class="tab-data col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- fist tab -->


                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                        <div class="container">
                            <div class="add-dctr">

                                {!! Form::open(['route'=>'store-dotor', 'method'=>'post','enctype' => 'multipart/form-data']) !!}
                                <h4>Add Doctor</h4>
                                @include('admin.add_doctor.form')

                                <input type="submit" value="Add Doctor">
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