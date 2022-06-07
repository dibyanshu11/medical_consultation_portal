@extends('layouts.includes.app')
@section('title', 'Office Profile')
@section('content')



    <div row>
        <div class="d-flex align-items-start tab-main">

            <div class="tab-data col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                       
                            <div class="add-dctr">

                                {!! Form::open(['route'=>'store-office', 'method'=>'post']) !!}
                                <h4>Add Office</h4>
                                @include('admin.add_office.form')

                                <input type="submit" value="Add Office">
                                {!! Form::close() !!}


                            </div>
                    
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection