@extends('layouts.master')

@section('title','活動列表')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">
                                活動列表 {{'下個id:'.$next_id}}
                            </h4>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table">
                                    <tr class="heading-td">
                                        <td class="attachments">id</td>
                                        <td class="coin-name">網址</td>

                                        <td class="attachments">主題</td>
                                        <td class="attachments">敘述</td>
                                        <td class="attachments">主圖片</td>

                                        <td class="attachments">time_interval</td>




                                        <td class="attachments">
                                            <a href="{{route('events.create')}}" class="btn btn-xs btn-success">新增活動</a>
                                        </td>
                                    </tr>
                                    @foreach($events as $event)
                                        <tr>
                                            <td class="coin-name">{{$event->id}}</td>
                                            <td class="attachments">{{$event->url}} </td>
                                            <td class="attachments">{{$event->title}} </td>
                                            <td class="attachments">{{$event->description}} </td>
                                            <td class="attachments">{{$event->hero_image}}</td>

                                            <td class="attachments">{{Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s.u',json_decode($event->time_interval)->end->date)->format('Y-m-d\TH:i:s')}} </td>



                                            <td class="attachments">
                                                <a href="{{route('events.edit',$event->id)}}" class="btn btn-xs btn-primary">編輯</a>
                                                <button onclick='confirmDelete("{{$event->id}}","{{$event->title}}","活動","events")' class="btn btn-xs btn-danger">刪除</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div>{{$events->onEachSide(1)->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


