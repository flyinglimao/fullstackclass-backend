@extends('layouts.master')

@section('title','編輯訊息')

@section('index',route('messages.index'))

@section('type','Message')

@section('content')



    <div class="main-content-inner"><!--不一樣的部分-->
        <div class="row">
            <div class="col-12">               <!-    col-lg-6 col-ml-12 -->
                <div class="row">
                    <!-- Textual inputs start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">編輯訊息</h4>
                                <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                <form action="{{route('messages.update',$message->id)}}" method="post" id ="edit">
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
                                        <label for="example-text-input" class="col-form-label">送出者id</label>
                                        <input class="form-control" type="text" placeholder="請輸入id" id="example-text-input" name="sender_id" value="{{old('sender_id',$message->sender_id)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-form-label">收件者id</label>
                                        <input class="form-control" type="text" placeholder="請輸入id" id="example-search-input" name="receiver_id" value="{{old('receiver_id',$message->receiver_id)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-type-input" class="col-form-label">種類</label>
                                        <input class="form-control" type="text" placeholder="請輸入種類" id="example-type-input" name="type" value="{{old('type',$message->type)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-url-input" class="col-form-label">標題</label>
                                        <input class="form-control" type="text" placeholder="請輸入標題" id="example-url-input" name="title" value="{{old('title',$message->title)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-textarea-input" class="col-form-label">內容</label>
                                        <textarea  class="form-control" cols="20" rows="4" placeholder="請輸入內容" id="example-textarea-input" name="message">{{old('message',$message->message)}}</textarea>
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
