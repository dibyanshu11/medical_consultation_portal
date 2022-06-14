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
                            <a class="btn btn-success backbtn" href="{{route('patient-index')}}">Back</a>
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

                                        $result = ($chat->chat_data) ? json_decode($chat->chat_data) : [];
                                        if (!empty($result[0]->video_link)) {
                                            $result = $result[0];


                                            //explode video link by ','
                                            $explode_link = explode(",", $result->video_link);
                                            //And implode by space
                                            $implode_link = implode("", $explode_link);
                                            //than explode url
                                            $explode_url = explode("https://www.youtube.com/watch?v=", $implode_link);
                                            //  dd( $explode_url );


                                        } else {
                                            $result = [];
                                        }
                                        ?>
                                        @if(!empty($result))
                                        <div class="fullchat">
                                            <span style="font-size: 22px;font-weight: 700;"></span>{{($result)? @$result->response_name : ''}}
                                        </div>
                                        <!-- <div class="borderchat">
                                            <span style="font-size: 22px;font-weight: 700;">Keywords : </span>{{($result)? @$result->keywords : ''}}
                                        </div>
                                        <div class="borderchat">
                                            <span style="font-size: 22px;font-weight: 700;">Questions : </span>{{($result)? @$result->questions : ''}}
                                        </div>
                                        <div class="borderchat">
                                            <span style="font-size: 22px;font-weight: 700;">Phrases : </span>{{($result)? @$result->phrases : ''}}
                                        </div> -->

                                        <div>

                                            <div class="borderchat">
                                                <span class="result" style="font-size: 22px;font-weight: 700;"></span>{{($result)? @$result->video_response : ''}}
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


                                        @else
                                        <div class="col-lg-5 msgrespone">
                                            <span class="result" style="font-size: 22px;font-weight: 700;">Result : Data not found</span>
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