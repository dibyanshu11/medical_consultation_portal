<div>
    <div class="row top-search-bar">

        <h4>Offices</h4>

       
        <div class="col-md-5">
            <input type="text" placeholder="Search" id="myCustomSearchBox" name="Search" class="Search-bar" wire:model="searchTerm">
        </div>
        <div class="col-md-7">
            <div class="add-btn">
                <a href="{{ route('create-office') }}" class="custom-button">Add Office</a>
            </div>
        </div>

    </div>
    <div class="table-outter">
    <table class="table  table-borderless Patient-History-tb table-sm datatable data-table">
        <thead>
            <tr>

                <th>Sr.</th>
                <th>Name</th>
                <th width="35%">Address</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offices as $i => $office)
            <tr>
                <input type="hidden" id="select_delete" value="{{$office->id}}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $office->office_name }}</td>
                <td>{!! $office->address !!} ,{!! $office->city !!}, {!! $office->state !!} {!! $office->zip_code !!}</td>
                <td>{!! $office->created_at->format('M d, Y') !!}</td>

                <td>
                    <div class="btn-icon-list">
                        <a href="{{ route('office-edit',$office->id) }}" class="">
                            <img src="{{asset('images/pen 4.png')}}">
                        </a>
                        <a class="delete-button office">
                            <img src="{{asset('images/delete-24.ico')}}">
                        </a>
                    </div>
                </td>


            </tr>
            @endforeach

        </tbody>
    </table>
    </div>
    {{ $offices->links()}}
</div>