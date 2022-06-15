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

                                            // dd( $result ,"llll");
                                            // dd($arr2);
                                        } else {
                                            $result = [];
                                            // dd( $result ,"dsfskfsjkjk");
                                        }
                                        ?>
                                        @if(!empty($result))
                                        <div style="background: aliceblue;margin-top: 15px;padding: 14px;border-radius: 16px;overflow: auto;">
                                            <span style="font-size: 22px;font-weight: 700;">Response Name : </span>{{($result)? @$result->response_name : ''}}
                                        </div>
                                        <div style="background: aliceblue;margin-top: 15px;padding: 14px;border-radius: 16px;overflow: auto;">
                                            <span style="font-size: 22px;font-weight: 700;">Keywords : </span>{{($result)? @$result->keywords : ''}}
                                        </div>
                                        <div style="background: aliceblue;margin-top: 15px;padding: 14px;border-radius: 16px;overflow: auto;">
                                            <span style="font-size: 22px;font-weight: 700;">Questions : </span>{{($result)? @$result->questions : ''}}
                                        </div>
                                        <div style="background: aliceblue;margin-top: 15px;padding: 14px;border-radius: 16px;overflow: auto;">
                                            <span style="font-size: 22px;font-weight: 700;">Phrases : </span>{{($result)? @$result->phrases : ''}}
                                        </div>

                                        <div>


                                            @foreach(@$explode_url as $key=> $data)
                                            @if($key > 0)


                                            <div class="media mt-2">
                                                <div class="media-body">
                                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$data}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                            @endif

                                            @endforeach
                                        </div>

                                        <div style="background: aliceblue;margin-top: 15px;padding: 14px;border-radius: 16px;overflow: auto;">
                                            <span class="result" style="font-size: 22px;font-weight: 700;">Video Response : </span>{{($result)? @$result->video_response : ''}}
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