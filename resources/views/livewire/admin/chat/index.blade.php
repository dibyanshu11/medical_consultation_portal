<div>
    <div class="row top-search-bar">
        <div class="col-md-7">
            <h4>Patient History
                <h4>
        </div>

        <div class="col-md-5">
            <input type="text" placeholder="Search" id="myCustomSearchBox" name="Search" class="Search-bar" wire:model="searchTerm">
        </div>
    </div>
    <div class="table-outter">
    <table class="table  table-borderless Patient-History-tb table-sm ">
        <thead>
            <tr>
                <th>Sr</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th width="24%">Date of Consultation</th>
                <th width="26%">View Consultation</th>
                <!--<th>Notes</th>-->
            </tr>
        </thead>
        <tbody>
            @foreach($chats as $i => $chat)
            <tr>
                <input type="hidden" id="select_delete" value="{{$chat->id}}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $chat->user->first_name }} {{ $chat->user->last_name }}</td>
                <td>{{ $chat->doctor->first_name }} {{ $chat->doctor->last_name }}</td>
                <td>{{ $chat->created_at->format('M d, Y')}}</td>
               
                <td>
                    <div class="btn-icon-list">
                        <a href="{{ route('chat-view',$chat->id) }}" class="">
                        View conversation
                        </a>
                      
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    </div>
    {{ $chats->links('pagination::bootstrap-4')}}
</div>