<div>
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

        <div class="container">


            <div class="row top-search-bar">
                <h4>Doctor List </h4>
                <div class="col-md-5">
                    <input type="text" placeholder="Search" id="myCustomSearchBox" name="Search" class="Search-bar" wire:model="searchTerm">
                </div>

                <div class="col-md-7">
                    <div class="add-btn">
                        <a href="{{ route('add-doctor') }}" class="custom-button">Add Doctor</a>
                    </div>
                </div>

            </div>
            <div class="table-outter">
                <table id="example" class="display table  table-borderless Patient-History-tb table-sm datatable data-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Office Name</th>
                            <th>Doctor</th>
                            <th width="24%">Practice</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doctors as $i => $doctor)
                        <tr>
                            <input type="hidden" id="select_delete" value="{{$doctor->id}}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $doctor->office_name }}</td>
                            <td><img class="user-prf-img" alt="Profile" src="{{ $doctor->doctor_pic }}" />{{$doctor->first_name}} {{$doctor->last_name}}</td>
                            <td>{{ $doctor->practice }}</td>
                            <td>{{ $doctor->created_at->format('M d, Y') }}</td>

                            <td>
                                <div class="btn-icon-list">
                                    <a href="{{ route('doctor-edit',$doctor->id) }}" class="">
                                        <img src="{{asset('images/pen 4.png')}}">
                                    </a>
                                    <a class="delete delete-button">
                                        <img src="{{asset('images/delete-24.ico')}}">
                                    </a>
                                </div>
                            </td>


                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
            {{ $doctors->links('pagination::bootstrap-4')}}


        </div>
    </div>
</div>