@extends('layouts.master')

@section('title','使用者資料')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">

                    <div class="alert alert-primary" role="alert">
                        <h4 class="alert-heading">Welcome!!</h4>
                        <p>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                        </p>
                    </div>
                    @if(!(Auth::user()->hasVerifiedEmail()))
                        <div class="alert alert-primary" role="alert">
                            <h4 class="alert-heading">{{ __('Verify Your Email Address') }}</h4>
                            <p>
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            Before proceeding, please check your email---
                            {{Auth::user()->email}}<br>
                            for a verification link.<br>
                            If you did not receive the email,
                            <a href="{{ route('verification.resend') }}">click here to request another</a>.
                            </p>
                        </div>
                    @endif
                    <input type="hidden" value="{{Auth::user()->id}}">
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">使用者名稱</label>
                        <input disabled class="form-control" type="text" value="{{old("name",Auth::user()->name)}}" id="example-text-input" name="name">
                    </div>
                    <div class="form-group">
                        <label for="example-email-input" class="col-form-label">電子郵件</label>
                        <input disabled class="form-control" type="text" value="{{old("email",Auth::user()->email)}}" id="example-email-input" name="email">
                    </div>
                    <div class="form-group">
                        <label for="example-admin-input" class="col-form-label">權限</label>
                        <input disabled class="form-control" type="text" value="{{(int)Auth::user()->isAdmin?'管理員':'會員'}}" id="example-admin-input">
                    </div>
                    <div class="form-group">
                        <label for="example-bonus-input" class="col-form-label">紅利點數</label>
                        <input disabled class="form-control" type="text" value="{{(int)Auth::user()->bonus}}" id="example-bonus-input">
                    </div>
                    <div class="form-group">
                        <label for="total_orders" class="col-form-label">總花費</label>
                        <input disabled class="form-control" type="text" value="{{$total_orders}}" id="total_orders">
                    </div>
                    <div class="form-group">
                        <a href="{{route('password.request')}}">重設密碼</a>
                    </div>

                </div>
                @auth

                @endauth
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="accordion1" class="according">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#accordion11">紅利累積紀錄</a>
                            </div>
                            <div id="accordion11" class="collapse" data-parent="#accordion1">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <h4 class="header-title mb-0">
                                            歷史列表
                                        </h4>
                                    </div>
                                    <div class="market-status-table mt-4">
                                        <div class="market-status-table mt-4">
                                            <div class="table-responsive">
                                                <table class="dbkit-table">
                                                    <tr class="heading-td">
                                                        <td class="attachments">id</td>
                                                        <td class="attachments">change</td>
                                                        <td class="attachments">message</td>
                                                    </tr>
                                                    @foreach($bonuses as $bonus)
                                                        <tr class="heading-td">
                                                            <td class="attachments">{{$bonus->id}}</td>
                                                            <td class="attachments">{{$bonus->change}}</td>
                                                            <td class="attachments">{{$bonus->message}}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>

                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#accordion12">商品購買紀錄</a>
                            </div>
                            <div id="accordion12" class="collapse" data-parent="#accordion2">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <h4 class="header-title mb-0">
                                            歷史列表
                                        </h4>
                                    </div>
                                    <div class="market-status-table mt-4">
                                        <div class="table-responsive">
                                            <table class="dbkit-table">
                                                <tr class="heading-td">
                                                    <td class="attachments">id</td>
                                                    <td class="attachments">商品名稱</td>
                                                    <td class="attachments">單價</td>
                                                    <td class="attachments">數量</td>
                                                    <td class="attachments">總金額</td>
                                                </tr>
                                                @foreach($orders as $order)
                                                    <tr class="heading-td">
                                                        <td class="attachments">{{$order->id}}</td>
                                                        <td class="attachments">{{\App\Product::find(json_decode($order->products)->product_id)->title}}</td>
                                                        <td class="attachments">{{json_decode($order->products)->unit_price}}</td>
                                                        <td class="attachments">{{json_decode($order->products)->quantity}}</td>

                                                        <td class="attachments">{{json_decode($order->payment_information)->total}}</td>
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
            </div>
        </div>
    </div>
</div>
@endsection
