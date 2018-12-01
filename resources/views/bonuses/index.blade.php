
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
                                        <td class="attachments">使用者bonus餘額</td>

                                        <td class="attachments">變化量</td>
                                        <td class="attachments">訊息</td>

                                        <td class="attachments">
                                            <a href="{{route('bonuses.create')}}" class="btn btn-xs btn-success">新增紅利紀錄</a>
                                        </td>
                                    </tr>
                                    @foreach($bonuses as $bonus)
                                        <tr>
                                            <td class="coin-name">{{$bonus->order_id}} </td>

                                            <td class="attachments">{{$bonus->user_id}} </td>
                                            <td class="attachments">{{$bonus->user->bonus}} </td>

                                            <td class="attachments">{{$bonus->change}} </td>
                                            <td class="attachments">{{$bonus->message}}</td>

                                            <td class="attachments">
                                                <a href="#" class="btn btn-xs btn-primary">編輯</a>
                                                <button onclick='confirmDelete("{{$bonus->id}}","{{$bonus->message}}","紅利","bonuses")' class="btn btn-xs btn-danger">刪除</button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div>{{$bonuses->onEachSide(1)->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
