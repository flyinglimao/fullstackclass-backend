@extends('layouts.master')

@section('title','新增tag')

@section('index',route('tags.index'))

@section('type','Tag')

@section('content')

    <div class="main-content-inner"><!--不一樣的部分-->
        <div class="row">
            <div class="col-12">               <!-    col-lg-6 col-ml-12 -->
                <div class="row">
                    <!-- Textual inputs start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">新增tag</h4>
                                <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                <form action="{{route('tags.store')}}" method="post" id="create">


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
                                        <label for="example-text-input" class="col-form-label">標籤名稱</label>
                                        <input class="form-control" type="text" placeholder="請輸入標籤名稱" id="example-text-input" name="name" value="{{old('name')}}">
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
