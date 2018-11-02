@extends('layouts.master')

@section('title','管理者列表')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">管理者列表</h4>
                            <select class="custome-select border-0 pr-3">
                                <option selected>Last 24 Hours</option>
                                <option value="0">01 July 2018</option>
                            </select>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table">
                                    <tr class="heading-td">
                                        {{--<td class="mv-icon">ID</td>--}}
                                        <td class="coin-name">名稱</td>
                                        <td class="coin-name">權限</td>
                                        <td class="attachments">暱稱</td>
                                        <td class="attachments">信箱</td>
                                        <td class="attachments">電話</td>
                                        <td class="attachments">
                                            <a href="#" class="btn btn-xs btn-success">新增管理員</a>
                                        </td>
                                    </tr>
                                    @foreach($admins_list as $admin)
                                        <tr>
                                            {{--                                    <td class="mv-icon">{{$product->id}} </td>--}}
                                            <td class="coin-name">{{$admin->username}} </td>
                                            <td class="coin-name">{{json_decode($admin->permissions)->{'權限'} }} </td>
                                            <td class="attachments">{{$admin->display_name}} </td>
                                            <td class="attachments">{{$admin->email}}</td>
                                            <td class="attachments">{{$admin->phone}} <img src="{{asset('images/icon/market-value/triangle-down.png')}}" alt="icon"></td>
                                            <td class="attachments">
                                                <a href="{{route('admins.edit',['admins'=>$admin->id])}}" class="btn btn-xs btn-primary">編輯</a>
                                                <button onclick="" class="btn btn-xs btn-danger">刪除</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
