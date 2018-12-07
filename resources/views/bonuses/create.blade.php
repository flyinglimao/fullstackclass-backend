@extends('layouts.master')

@section('title','新增紅利訊息')

@section('index',route('bonuses.index'))

@section('type','Bonus')

@section('content')



    <div class="main-content-inner"><!--不一樣的部分-->
        <div class="row">
            <div class="col-12">               <!-    col-lg-6 col-ml-12 -->
                <div class="row">
                    <!-- Textual inputs start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">新增紅利訊息</h4>
                                <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                <form action="{{route('bonuses.store')}}" method="post" id ="create">
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
                                        <button class="form-control" type="button"  onclick="disableButton(this,'#create')">提交</button>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_id" class="col-form-label">使用者id</label>
                                        <input class="form-control" type="text" placeholder="請輸入id" id="user_id" name="user_id" value="{{old('user_id')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="change" class="col-form-label">改變量</label>
                                        <input class="form-control" type="text" placeholder="改變量" id="change" name="change" value="{{old('change')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-textarea-input" class="col-form-label">內容</label>
                                        <textarea  class="form-control" cols="20" rows="4" placeholder="請輸入內容" id="message" name="message">{{old('message')}}</textarea>
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
