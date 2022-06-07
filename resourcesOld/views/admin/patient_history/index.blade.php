@extends('layouts.includes.app')

@section('content')


<div class=" tab-body">
    <div row>
        <div class="d-flex align-items-start tab-main">

            <div class="tab-data col-md-12">
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