@extends('layouts.includes.app')
@section('title', 'Update consultation')
@section('content')


<div class="container tab-body">
    <div row>
        <div class="d-flex align-items-start tab-main">

            <div class="tab-data col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                        <div class="container">
                            <div class="add-dctr">

                                <h4>Update Consultation</h4>
                                {!! Form::model($consultations, ['route'=>['consultation-update', $consultations->id], 'method'=>'PATCH']) !!}

                                @include('admin.add_consultation.form')
                                <input type="submit" value="Update Consultation">
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection