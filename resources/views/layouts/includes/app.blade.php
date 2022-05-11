<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>@yield('title') </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @include('layouts.includes.styles')
    @livewireStyles
</head>

<body>
    <div class="menu_toogle">
        <div class="toggle">
            <img src="{{asset('images/menu.png')}}">
        </div>
    </div>
    <div>
        <div>
            @include('layouts.includes.header')
            <div class="container tab-body">
                <div row>

                    <div class="d-flex align-items-start tab-main">
                        <div class=" menu-bar col-md-3">
                            @include('layouts.includes.sidebar')
                        </div>
                        <div class="tab-data col-md-9">
                            @include('layouts.includes.alerts')
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <div class="container">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('layouts.includes.script')
    </div>

</body>


<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert-dismissible').fadeOut('fast');
        }, 1000); // <-- time in millisecond
    });
</script>

@livewireScripts
<script>
    $(document).ready(function() {
        $(".toggle img").click(function() {
            $(".menu-bar").toggleClass("menu_toggle");
        })
    });
    $("input").keyup(function() {
        var id = $(this).attr("id");
        if (id == 'Primary') {
            caps = caps.charAt(0).toLowerCase() + caps.slice(1);
            $('#' + id + '').val(caps);
        } else {
            var caps = jQuery('#' + id + '').val();
            caps = caps.charAt(0).toUpperCase() + caps.slice(1);
            $('#' + id + '').val(caps);
        }

    });
</script>

</html>