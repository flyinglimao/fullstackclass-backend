
@extends('layouts.master')

@section('title','訊息列表')

@section('index',route('messages.index'))

@section('type','Message')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">
                                訊息列表
                            </h4>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table">
                                    <tr class="heading-td">
                                        {{--<td class="mv-icon">ID</td>--}}
                                        <td class="coin-name">編號</td>

                                        <td class="attachments">送出者</td>
                                        <td class="attachments">接收者</td>
                                        <td class="attachments">種類</td>
                                        <td class="attachments">標題</td>
                                        <td class="buy">內容</td>
                                        <td class="attachments">
                                            <a href="{{route('messages.create')}}" class="btn btn-xs btn-success">新增訊息</a>
                                        </td>
                                    </tr>
                                    @foreach($messages as $message)
                                        <tr>
                                            <td class="coin-name">{{$message->id}} </td>

                                            <td class="attachments">{{$message->sender->name}} </td>
                                            <td class="attachments">{{$message->receiver->name}} </td>
                                            <td class="attachments">{{$message->type}}</td>
                                            <td class="attachments">{{$message->title}} <img src="{{asset('images/icon/market-value/triangle-down.png')}}" alt="icon"></td>
                                            <td class="buy">{{$message->message}} </td>
                                            <td class="attachments">
                                                <a href="{{route('messages.edit',$message->id)}}" class="btn btn-xs btn-primary">編輯</a>
                                                <button onclick='confirmDelete("{{$message->id}}","{{$message->title}}","訊息","messages")' class="btn btn-xs btn-danger">刪除</button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div>{{$messages->onEachSide(1)->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
