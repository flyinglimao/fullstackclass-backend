
@extends('layouts.master')

@section('title','紅利列表')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">
                                紅利列表
                            </h4>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table">
                                    <tr class="heading-td">
                                        {{--<td class="mv-icon">ID</td>--}}
                                        <td class="attachments">交易編號</td>
                                        <td class="attachments">使用者id</td>
                                        <td class="attachments">變化量</td>
                                        <td class="attachments">訊息</td>

                                        <td class="attachments">
                                            <a href="{{route('messages.create')}}" class="btn btn-xs btn-success">新增訊息</a>
                                        </td>
                                    </tr>
                                    @foreach($bonuses as $bonus)
                                        <tr>
                                            <td class="coin-name">{{$bonus->order_id}} </td>

                                            <td class="attachments">{{$bonus->sender->name}} </td>
                                            <td class="attachments">{{$bonus->receiver->name}} </td>
                                            <td class="attachments">{{$bonus->type}}</td>
                                            <td class="attachments">{{$bonus->title}} <img src="{{asset('images/icon/market-value/triangle-down.png')}}" alt="icon"></td>
                                            <td class="buy">{{$bonus->message}} </td>
                                            <td class="attachments">
                                                <a href="{{route('messages.edit',$bonus->id)}}" class="btn btn-xs btn-primary">編輯</a>
                                                <button onclick='confirmDelete("{{$bonus->id}}","{{$bonus->title}}","訊息","messages")' class="btn btn-xs btn-danger">刪除</button>

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
