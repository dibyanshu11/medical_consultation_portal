@extends('layouts.includes.app')
@section('title', 'Office Profile')
@section('content')


<div class=" tab-body">
    <div row>
        <div class="d-flex align-items-start tab-main">
            <div class="tab-data col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="add-dctr">
                            @include('layouts.includes.alerts')
                            <h4> View conversation</h4>
                            <div class="row chat_page">
                                @foreach($conversations as $conversation)

                                @foreach($conversation['chat_data'] as $chat)
                                <div class="row chat_color" style="background: gainsboro;margin-top: 37px;border-radius: 5px;padding: 19px;">
                                    <div class="row">
                                        <div class="col" style="text-align: center;">
                                            {{ $chat->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3" style="background: beige;padding: 7px;border-radius: 20px;">
                                            Search Key :{{ $chat->key }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php

                                    //  var_dump(json_decode($chat->chat_data->response_name)); die();
                                     
                                        $result = ($chat->chat_data)? json_decode($chat->chat_data) : [];
                                        if(!empty($result)){
                                            $result = $result[0];
                                        }else{
                                            $result = [];
                                        }
                                        ?>
                                        @if(!empty($result))
                                            <div class="col" style="background: aliceblue;margin-top: 15px;padding: 14px;border-radius: 16px;overflow: auto;">
                                                <span class="result" style="font-size: 22px;font-weight: 700;">Result : </span>{{($result)? $result->id : ''}} {{($result)? $result->keywords : ''}}
                                            </div>
                                        @else
                                            <div class="col" style="background: aliceblue;margin-top: 15px;padding: 14px;border-radius: 16px;overflow: auto;">
                                                <span class="result" style="font-size: 22px;font-weight: 700;">Result : Data not found</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection