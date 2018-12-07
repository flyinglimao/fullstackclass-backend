
@extends('layouts.master')

@section('title','會員列表')

@section('index',route('home'))

@section('type','User Index')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">
                                會員目錄: {{$total.'筆資料'}}
                            </h4>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table">
                                    <tr class="heading-td">
                                        {{--<td class="mv-icon">ID</td>--}}
                                        <td class="coin-name">編號</td>

                                        <td class="attachments">名字</td>
                                        <td class="attachments">電子郵件</td>
                                        <td class="attachments">郵件認證</td>
                                        <td class="attachments"></td>
                                    </tr>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="coin-name">{{$user->id}} </td>
                                            <td class="attachments">{{$user->name}} </td>
                                            <td class="attachments">{{$user->email}} </td>
                                            <td class="attachments">{{$user->hasVerifiedEmail()?'通過':'未通過'}} </td>
                                            <td class="attachments">
                                                <a href="{{route('user.show',$user->id)}}" class="btn btn-xs btn-success">查看詳細資訊</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div>{{$users->onEachSide(1)->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
