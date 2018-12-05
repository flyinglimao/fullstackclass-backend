@extends('layouts.master')

@section('title','編輯訂單')

@section('index',route('orders.index'))

@section('type','Order')

@section('content')



    <div class="main-content-inner"><!--不一樣的部分-->
        <div class="row">
            <div class="col-12">               <!-    col-lg-6 col-ml-12 -->
                <div class="row">
                    <!-- Textual inputs start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">編輯訂單</h4>
                                <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                <form action="{{route('orders.update',$order->id)}}" method="post" id ="edit">
                                @csrf
                                @method('PATCH')
                                <!-- 錯誤訊息 -->
                                    @if ($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">ERROR!!</h4>
                                            <p>請修正以下表單</p>
                                            <hr>
                                            <p class="mb-0">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <button class="form-control" type="button"  onclick="disableButton(this,'#edit')">提交</button>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">狀態</label>
                                        <input class="form-control" type="text" placeholder="請輸入狀態" id="example-text-input" name="state" value="{{old('state',$order->state)}}">
                                    </div>


                                    <div class="form-group">
                                        <label for="example-search-input" class="col-form-label">付款時間</label>
                                        <input class="form-control" type="datetime-local" id="example-search-input" name="date"
                                               value="{{old('date',$pay_date)}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="example-type-input" class="col-form-label">物流公司</label>
                                        <input class="form-control" type="text" placeholder="請輸入物流公司" id="example-type-input" name="ship_information" value="{{old('ship_information',$order->ship_information)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-textarea-input" class="col-form-label">訊息</label>
                                        <textarea  class="form-control" cols="20" rows="4" placeholder="請輸入內容" id="example-textarea-input" name="message">{{old('message',$order->message)}}</textarea>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Textual inputs end -->
                </div>
            </div>
        </div>
    </div>

@endsection
