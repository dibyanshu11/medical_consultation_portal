@extends('layouts.includes.app')
@section('title', 'Update Office')
@section('content')


<div class="container tab-body">
    <div row>
        <div class="d-flex align-items-start tab-main">
          
            <div class="tab-data col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
                
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                        <div class="container">
                            <div class="add-dctr">
                                @include('layouts.includes.alerts')
                                <h4>Update Office</h4>
                                {!! Form::model($offices, ['route'=>['office-update', $offices->id], 'method'=>'PATCH']) !!}

                                @include('admin.add_office.form')
                                <input type="submit" value="Update Office">
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