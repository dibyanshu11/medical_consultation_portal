@extends('layouts.includes.app')
@section('title', 'Account')

@section('content')


<div class="tab-body">
    <div class="row">
        <div class="d-flex align-items-start tab-main">

            <div class="tab-data">
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- fist tab -->
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">


                            
                            <form action="{{ route('update-profile') }}" method="POST">
                                @csrf
                                <div class="row">

                                    @if(auth()->user()->image !=null)

                                    <img class="user-prf-img user-profile" alt="Profile" src="{{auth()->user()->image}}" />

                                    @else
                                    <img class="user-prf-img user-profile" alt="Profile" src="{{asset('images/no-image.png')}}" " />

                                        @endif
                                        <div class=" uploadimges">
                                    <input type="file" name="image" id="file" class="image" />
                                    <img src="{{asset('images/user-img-edit-icon.png')}}" class="user_profile" id="btnOpenFileDialog" onclick="openfileDialog();">

                                </div>


                                <!-- add cropper Model -->


                                @include('layouts.includes.cropper_model')

                                <!-- end cropper Model -->
                                <div class="col-md-12 p-email">
                                    <label for="Officename">Primary Email</label><br>
                                    <input type="email" id="Primary" name="email" value="{{$admin->email}}" autocomplete="email">
                                    @error('email') <span ...>{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="change-password">
                                        <a class="custom-button" href="{{ route('change-password') }}">Click to change password</a>
                                    </div>
                                </div>

                        </div>
                        <input type="submit" value="Update Email">
                        </form>


                </div>

                <!-- fist tab end -->
            </div>
        </div>
    </div>
</div>

<script>
    function openfileDialog() {
        $("#file").click();
    }

    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;

    $(".cancel").on('click', function(e) {
        $("#file").val('');
        $modal.modal('hide');
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
            viewMode: 2,
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

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/update-profile-pic",
                    data: {
                        '_token': $('meta[name="_token"]').attr('content'),
                        'image': base64data,

                    },
                    success: function(data) {
                        $modal.modal('hide');
                        window.location.href = '{{url("/home")}}';
                    }
                });
            }
        });
    })
</script>

@endsection