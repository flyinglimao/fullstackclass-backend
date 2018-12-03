@extends('layouts.master')

@section('title','新增庫存變化')

@section('content')



    <div class="main-content-inner"><!--不一樣的部分-->
        <div class="row">
            <div class="col-12">               <!-    col-lg-6 col-ml-12 -->
                <div class="row">
                    <!-- Textual inputs start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">新增庫存變化</h4>
                                <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                <form action="{{route('sales.store')}}" method="post" id="create">
                                @csrf
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
                                        <label for="change" class="col-form-label">變化量</label>
                                        <input class="form-control" type="text" placeholder="請輸入id" id="change" name="change" value="{{old('change')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="products_id" class="col-form-label">商品id</label>
                                        <input class="form-control" type="text" placeholder="請輸入id" id="products_id" name="products_id" value="{{old('products_id')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="order_id" class="col-form-label">訂單id</label>
                                        <input class="form-control" type="text" placeholder="請輸入訂單id" id="order_id" name="order_id" value="{{old('order_id')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="message" class="col-form-label">訊息</label>
                                        <input class="form-control" type="text" placeholder="請輸入訊息" id="message" name="message" value="{{old('message')}}">
                                    </div>
                                    <div class="form-group">
                                        <button class="form-control" type="submit" onclick="disableButton(this,'#create')">提交</button>
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
