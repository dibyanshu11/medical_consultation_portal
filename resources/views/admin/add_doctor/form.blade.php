<div class="doctor-container adddoctor">

    @if(@$doctors->doctor_pic)

    <div class="row">
        <div class="col-md-6">
            <div class="form-group col-md-6}">
                @php
                $office_id = explode(',',@$doctors->office_id);
                @endphp
                {!! Form::label('offices','Select Office', ['class' => 'control-label']) !!}
                {!! Form::select('offices', $officeSelect ,$office_id, [ 'id'=>'select-option','class' => 'form-control real-file' . ($errors->has('offices') ? ' is-invalid' : '')]) !!}
                {!! $errors->first('offices', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>

    @else
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('offices','Select Office', ['class' => 'control-label']) !!}
                {!! Form::select('offices', $officeSelect, null, [ 'id'=>'select-option','class' => 'form-control real-file' . ($errors->has('offices') ? ' is-invalid' : '')]) !!}
                {!! $errors->first('offices', '<span class="help-block">:message</span>') !!}
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-6">
        </div>

        <div class="Upload-img ">
            <input type="hidden" id="doctor_id" value="{{@$doctors->id}}">
            <input type="hidden" name="cropimage" id="cropimage">
            @if(@$doctors->doctor_pic)
            <img src="{{$doctors->doctor_pic}}" class="doctor-image">
            </br>
            <div class="form-group {!! ($errors->has('image') ? 'has-error' : '') !!}">
                <div id="img-preview"></div>
                <input type="hidden" name="doctor_pic" id="doctor_pic" value="{{@$doctors->doctor_pic}}">
                <input type="file" name="image" id="file" class="image real-file" />
                <a type="button" id="btnOpenFileDialog" class="custom-button" onclick="openfileDialog()" ;>Upload Image</a><br>

                </br>
                <!-- add cropper Model -->


                @include('layouts.includes.cropper_model')

                <!-- end cropper Model -->
            </div>
            @else
            <div class="form-group {!! ($errors->has('image') ? 'has-error' : '') !!}">

                <div class=" uploadimges">
                    <div id="img-preview"></div>
                    <input type="file" name="image" id="file" class="image real-file" accept="image/*" />
                    <a type="button" id="btnOpenFileDialog" class="custom-button" onclick="openfileDialog()" ;>Upload Image</a><br>
                    <span id="file-upload-filename">
                </div>
            </div>
            @include('layouts.includes.cropper_model')

            {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
            </br>
            @endif
            </br>
        </div>

    </div>
    <div class="row">

        <div class="form-group">
            {!! Form::label('first_name','First Name', ['class' => 'control-label']) !!}
            {!! Form::text('first_name', null, ['id'=>'fname','class' => 'form-control' . ($errors->has('first_name') ? ' is-invalid' : '') ]) !!}
            {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
        </div>


        <div class="form-group">
            {!! Form::label('last_name','Last Name', ['class' => 'control-label']) !!}
            {!! Form::text('last_name', null, ['id'=>'lname','class' => 'form-control' . ($errors->has('last_name') ? ' is-invalid' : '') ]) !!}
            {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 {!! ($errors->has('practice') ? 'has-error' : '') !!}">
            @php
            $practice = explode(', ',@$doctors->practice);
            @endphp

            {!! Form::label('practice','Select Practice', ['class' => 'control-label ']) !!}
            {!! Form::select('practice[]',
            ['Allergists/Immunologists' => 'Allergists/Immunologists',
            'Anesthesiologists'=>'Anesthesiologists',
            'Cardiologists'=>'Cardiologists',
            'Colon and Rectal Surgeons'=>'Colon and Rectal Surgeons',
            'Critical Care Medicine Specialists'=>'Critical Care Medicine Specialists',
            'Dermatologists'=>'Dermatologists',
            ]
            ,$practice , ['id'=>'pracitce', 'multiple'=>'multiple','class' => 'form-control' . ($errors->has('practice') ? ' is-invalid' : '') ]) !!}

            {!! $errors->first('practice', '<span class="help-block">:message</span>') !!}
        </div>
    </div>


  <div class="form-group">
        {!! Form::label('intro_video','Introduction Video', ['class' => 'control-label']) !!}
        {!! Form::text('intro_video', null, ['id'=>'intro_video','class' => 'form-control' . ($errors->has('intro_video') ? ' is-invalid' : '') ]) !!}
        {!! $errors->first('intro_video', '<span class="help-block">:message</span>') !!}
    </div>


    <div class="form-group">
        {!! Form::label('description','Description', ['class' => 'control-label']) !!}
        {!! Form::textarea('description', null, ['id'=>'doctor_description','class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : '') ]) !!}
        {!! $errors->first('description', '<span class="help-block">:message</span>') !!}

    </div>

</div>
<link href="{{ asset('css/multi.css') }}" rel="stylesheet">


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $("#pracitce").select2({
        tokenSeparators: [',', ' '],

    })

    function openfileDialog() {
        $("#file").click();
        $(".doctor-image").hide();
    }

    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;

    $(".cancel").on('click', function(e) {
        $("#file").val('');
        $modal.modal('hide');
        $("#img-preview").hide();
    });
    $("body").on("change", ".image", function(e) {
        var files = e.target.files;
        var done = function(url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 4,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function() {
        canvas = cropper.getCroppedCanvas({
            width: 200,
            height: 160,
        });

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                $("#cropimage").val(base64data);
                $("#img-preview img").attr('src', base64data);
                $modal.modal('hide');
                $(".doctor-image").hide();

            }
        });
    });


    $(document).ready(function() {
        //Chosen
        $("#select-option").select2({
            tokenSeparators: [',', ' ']
        })
    });

    // var input = document.getElementById('file');
    // var infoArea = document.getElementById('file-upload-filename');

    // input.addEventListener('change', showFileName);

    // function showFileName(event) {

    //     // the change event gives us the input it occurred in 
    //     var input = event.srcElement;

    //     // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
    //     var fileName = input.files[0].name;

    //     // use fileName however fits your app best, i.e. add it into a div
    //     infoArea.textContent = fileName;
    // }



    //show image
    const chooseFile = document.getElementById("file");
    const imgPreview = document.getElementById("img-preview");

    chooseFile.addEventListener("change", function() {
        getImgData();
    });

    function getImgData() {
        const files = chooseFile.files[0];
        if (files) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(files);
            fileReader.addEventListener("load", function() {
                imgPreview.style.display = "block";
                imgPreview.innerHTML = '<img src="' + this.result + '" />';
            });
        }
    }
</script>