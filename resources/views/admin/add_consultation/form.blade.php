<div class="doctor-container">
    <div class="row">

        @if(@$consultations->office_id !=null)

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    @php
                    @$office_id = explode(',',@$consultations->office_id);
                    @endphp
                    {!! Form::label('offices','Select Office', ['class' => 'control-label']) !!}
                    {!! Form::select('offices', @$offices ,$office_id, [ 'id'=>'select-option','class' => 'form-control select-option real-file' . ($errors->has('offices') ? ' is-invalid' : '')]) !!}
                    {!! $errors->first('offices', '<span class="help-block">:message</span>') !!}
                </div>
            </div>
            <div class="col-md-6 ">
                <label for="doctor" class="control-label">Select Doctor</label>
                <select id="select-doctor" class="form-control real-file selected-doctor" name="doctor_id">
                    <option value="">Select Doctor</option>
                    @foreach($doctors_list as $doctors)
                    <option value="{{@$doctors->id}}" {{@$selected_doctor->id == @$doctors->id  ? 'selected' : ''}}>{{@$doctors->first_name}} {{@$doctors->last_name}} ({{@$doctors->practice}} )</option>
                    @endforeach
                </select>

            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('offices','Select Office', ['class' => 'control-label']) !!}
                    {!! Form::select('offices', $offices , null, ['placeholder' => 'Select Office', 'id'=>'select-option','class' => 'form-control real-file' . ($errors->has('offices') ? ' is-invalid' : '')]) !!}
                    {!! $errors->first('offices', '<span class="help-block">:message</span>') !!}
                </div>
            </div>

            <div class="col-md-6 doctor-list">

            </div>
        </div>
        @endif


    </div>
    <div class="row">
        <div class="form-group col-md-12 {!! ($errors->has('response_name') ? 'has-error' : '') !!}">
            {!! Form::label('response_name','Name this Response', ['class' => 'control-label']) !!}
            {!! Form::text('response_name', null, ['id'=>'response','class' => 'form-control' . ($errors->has('response_name') ? ' is-invalid' : '') ]) !!}
            {!! $errors->first('response_name', '<span class="help-block">:message</span>') !!}
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <h4>Add Label</h4>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between add-label {!! ($errors->has('keywords') ? 'has-error' : '') !!}">
            {!! Form::label('keywords','Enter Keywords', ['class' => 'control-label']) !!}
            {!! Form::text('keywords', null, ['id'=>'Keywords','class' => 'form-control' . ($errors->has('keywords') ? ' is-invalid' : '') ]) !!}
            {!! $errors->first('keywords', '<span class="help-block">:message</span>') !!}


        </div>
        <span><small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small></span>

        <div class="col-md-12 d-flex justify-content-between add-label {!! ($errors->has('questions') ? 'has-error' : '') !!}">
            {!! Form::label('questions','Enter Questions', ['class' => 'control-label']) !!}
            {!! Form::text('questions', null, ['id'=>'Questions','class' => 'form-control' . ($errors->has('questions') ? ' is-invalid' : '') ]) !!}
            {!! $errors->first('questions', '<span class="help-block">:message</span>') !!}
        </div>
        <span><small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small></span>

        <div class="col-md-12 d-flex justify-content-between add-label {!! ($errors->has('phrases') ? 'has-error' : '') !!}">
            {!! Form::label('phrases','Enter Phrases', ['class' => 'control-label Phrases']) !!}
            {!! Form::text('phrases', null, ['id'=>'Phrases','class' => 'form-control' . ($errors->has('phrases') ? ' is-invalid' : '') ]) !!}
            {!! $errors->first('phrases', '<span class="help-block">:message</span>') !!}
        </div>
        <span><small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small></span>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4>Add Response</h4>
        </div>
    </div>

    <div class="col-md-12 d-flex justify-content-between Video-Link add-label {!! ($errors->has('video_link') ? 'has-error' : '') !!}">
        {!! Form::label('video_link','Video Link', ['class' => 'control-label ']) !!}
        {!! Form::text('video_link', null, ['id'=>'Phrases','class' => 'form-control' . ($errors->has('video_link') ? ' is-invalid' : '') ]) !!}
        {!! $errors->first('video_link', '<span class="help-block">:message</span>') !!}
    </div>
    <span><small class="form-text text-muted">Separate keywords with a comma, space bar, or enter key</small></span>
    <div class="row">
        <div class="col-md-12">
            <label for="response">Create Video Response</label><br>
            {!! Form::label('video_response','Video Response', ['class' => 'control-label']) !!}
            {!! Form::textarea('video_response', null, ['id'=>'video_response','class' => 'form-control response' . ($errors->has('video_response') ? ' is-invalid' : '') ]) !!}
            {!! $errors->first('video_response', '<span class="help-block">:message</span>') !!}

        </div>
    </div>






</div>

<style>
    #select-doctor {
        min-width: 150px;
        height: 48px;
        border-radius: 10px;
        background-color: #f6f6f6;
        border: none;
        outline: none;
        margin-bottom: 15px;
        padding: 10px;
    }
</style>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $("#video_response").keyup(function() {
            var id = $(this).attr("id");
            var caps = jQuery('#' + id + '').val();
            caps = caps.charAt(0).toUpperCase() + caps.slice(1);
            $('#' + id + '').val(caps);
        });

        $('input[name="keywords"]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
        });
        $('input[name="questions"]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
        });
        $('input[name="phrases"]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
        });

        $('input[name="video_link"]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
        });

        $('.bootstrap-tagsinput keywords').on('focus', function() {
            $(this).closest('.bootstrap-tagsinput').addClass('has-focus');
        }).on('blur', function() {
            $(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
        });

        $("#select-option").change(function() {

            // alert($(this).val());
            let office_id = $(this).val();
            $.ajax({
                type: 'post',
                data: {
                    'id': office_id,

                },
                url: "{{ route('doctor_list')}}",
                dataType: 'json',
                success: function(res) {
                    doctors = res.data;
                    console.log(doctors, "doctors list");
                    var html = '<div class="form-group">';
                    html += '<label for="doctor" class="control-label">Select Doctor</label>';
                    html += '<select id="select-doctor" class="form-control real-file" name="doctor_id">';
                    html += '<option value="Select Doctor" selected disabled>Select Doctor</option></option>';
                    $(doctors).each((index, element) => {
                        console.log(element);
                        html += '<option value="' + element.id + '"> ' + element.first_name + ' ' + element.last_name + ' ' + '(' + ' ' + element.practice + '   ' + ')' + '</option>';

                    });
                    html += ' </select>';
                    html += '</div>';
                    html += '</div>';
                    $(".doctor-list").html(html);
                },
                error: function(res) {
                    console.log('error', res);
                    // $('#message').text('Error!');
                    // $('.dvLoading').hide();
                }
            });
        });


        // for update
        $(".select-option").change(function() {


            // alert('heloo sir');

            // alert($(this).val());
            let office_id = $(this).val();
            $.ajax({
                type: 'post',
                data: {
                    'id': office_id,

                },
                url: "{{ route('doctor_list')}}",
                dataType: 'json',
                success: function(res) {
                    doctors = res.data;
                    console.log(doctors, "doctors list");

                    var html = '';
                    html += '<option>Select Doctor</option>';
                    $(doctors).each((index, element) => {
                        console.log(element);

                        html += '<option value="' + element.id + '"> ' + element.first_name + ' ' + element.last_name + ' ' + '(' + ' ' + element.practice + '   ' + ')' + '</option>';

                    });


                    $(".selected-doctor").html(html);
                },
                error: function(res) {
                    console.log('error', res);
                    // $('#message').text('Error!');
                    // $('.dvLoading').hide();
                }
            });
        });

    });
</script>