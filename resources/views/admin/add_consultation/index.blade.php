@extends('layouts.includes.app')
@section('title', 'Create Consultation')
@section('content')


<div class="tab-body">
    <div class="row">
        <div class="d-flex align-items-start tab-main">

            <div class="tab-data">
                <div class="tab-content" id="v-pills-tabContent">
                    @livewire('admin.consultation.index')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        // debugger;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.consultation').click(function(e) {

            e.preventDefault();

            var delete_id = $(this).closest('tr').find('#select_delete').val();

            swal({

                    title: "Are you sure want to delete ?",

                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })

                .then((willDelete) => {
                    if (willDelete) {
                        var data = {
                            "_token": $('input[name=_token]').val(),
                            "id": delete_id,
                        };

                        $.ajax({
                            'type': "DELETE",
                            url: 'consultation/delete/' + delete_id,
                            data: data,

                            success: function(response) {
                                swal(response.status, {
                                        icon: "success",
                                    })
                                    .then((result) => {
                                        location.reload();
                                    });
                            }
                        });

                    }

                });

        });
    });
</script>

@endsection