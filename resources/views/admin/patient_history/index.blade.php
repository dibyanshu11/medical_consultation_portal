@extends('layouts.includes.app')
@section('title', 'Patient History')
@section('content')


<div class="tab-body ">
    <div class="row">
        <div class="d-flex align-items-start tab-main">
           
            <div class="tab-data">
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- fist tab -->

                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

 
    
                        @livewire('admin.chat.index')



                    </div>
                    <!-- fist tab end -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection