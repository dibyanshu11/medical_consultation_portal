@extends('layouts.includes.app')
@section('title', 'View conversation')
@section('content')


<div class=" tab-body">
    <div row>
        <div class="d-flex align-items-start tab-main">
            <div class="tab-data col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="add-dctr">
                            <div class="profile_doc">
                            @foreach($conversations as $conversation)

                            @php

                            $explode_img=explode('user-profile/',$conversation->user->image);

                            @endphp

                            @if ($explode_img[1]==null)
                            <img class="user-prf-img" alt="Profile" src="{{asset('images/no-image.png')}}" />
                            @else
                            <img class="user-prf-img" alt="Profile" src="{{asset('storage/user-profile/')}}/{{ $explode_img[1]}}" />
                            @endif

                            <h5>{{@$conversation->user->first_name}}</h5>
                            <h4> View conversation</h4>
                            <div class="backbtn">
                            <a class="btn btn-success backbtn" href="{{route('patient-index')}}">Back</a></div>
                            </div>
                            <div class="row chat_page">

                                @foreach($conversation['chat_data'] as $chat)
                                <div class="row chat_color">
                                    <div class="row">
                                        <div class="col" style="text-align: center;">
                                            {{ $chat->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5 chatmsg">
                                            
                                      {{ $chat->key }}
                                     
                                        </div>
                                    </div>
                                    <div class="row chatreponse">
                                        <?php
                                        $chatResult = ($chat->chat_data) ? json_decode($chat->chat_data) : [];
                                        ?>
                                        
                                        @if( !empty($chatResult))
                                            @foreach ($chatResult as $chat)

                                                <?php
                                                    $explode_link = explode(",", $chat->video_link);
                                                    //And implode by space
                                                    $implode_link = implode("", $explode_link);
                                                    //than explode url
                                                    $explode_url = explode("https://www.youtube.com/watch?v=", $implode_link);
                                                ?>
                                                <div>

                                                    <div class="borderchat" style="background:#e4e4e4;">
                                                        <span class="result" style="font-size: 22px;font-weight: 700;"></span>{{($chat)? @$chat->video_response : ''}}
                                                    </div>
                                                    @foreach(@$explode_url as $key=> $data)
                                                        @if($key > 0)


                                                        <div class="media mt-2">
                                                            <div class="media-body bordervideo">
                                                                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$data}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                            </div>
                                                        </div>
                                                        @endif

                                                    @endforeach
                                                </div>
                                            @endforeach

                                        @else
                                        <div class="col-lg-5 msgrespone">
                                           <span class="result" style="font-size: 18px;">Sorry, but nothing matched. Please consider trying different, fewer, or more general keywords</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection