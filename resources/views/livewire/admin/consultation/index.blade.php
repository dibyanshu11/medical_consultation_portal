<div>
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

        <div class="container">


            <div class="row top-search-bar">

                <h4>Consultation List </h4>
                <div class="col-md-5">
                    <input type="text" placeholder="Search" id="myCustomSearchBox" name="Search" class="Search-bar" wire:model="searchTerm">
                </div>
                <div class="col-md-7">
                    <div class="add-btn">
                        <a href="{{ route('add-consultation') }}" class="custom-button">Add Consultation</a>
                    </div>
                </div>

            </div>

            <div class="table-outter">
            <table class="table  table-borderless Patient-History-tb table-sm data-table">
                <thead>
                    <tr>
                        <th>Sr.</th>
                        <th>Response Name</th>
                        <th>Office Name</th>
                        <th>Doctor Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultations as $i => $consultation)
                    <tr>
                        <input type="hidden" id="select_delete" value="{{ $consultation->id}}">

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $consultation->response_name }}</td>
                        <td>{{$consultation->office->office_name }}</td>
                        <td>{{@$consultation->doctor->first_name }} {{@$consultation->doctor->last_name }}</td>
                        <td>{{ $consultation->created_at->format('M d, Y') }}</td>

                        <td>
                            <div class="btn-icon-list">
                                <a href="{{ route('consultation-edit',$consultation->id) }}" class="">
                                    <img src="{{asset('images/pen 4.png')}}">
                                </a>
                                <a class="delete-button consultation">
                                    <img src="{{asset('images/delete-24.ico')}}">
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            {{ $consultations->links('pagination::bootstrap-4')}}

        </div>
    </div>
</div>