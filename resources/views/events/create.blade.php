@extends('layouts.master')

@section('title','新增活動')

@section('index',route('events.index'))

@section('type','Event')

@section('content')



    <div class="main-content-inner"><!--不一樣的部分-->
        <div class="row">
            <div class="col-12">               <!-    col-lg-6 col-ml-12 -->
                <div class="row">
                    <!-- Textual inputs start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">新增活動</h4>
                                <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                <form action="{{route('events.store')}}" method="post" id="create" enctype="multipart/form-data">
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
                                        <label for="example-text-input" class="col-form-label">網址</label>
                                        <input class="form-control" type="url" placeholder="請輸入網址" id="example-text-input" name="url" value="{{old('url','http://www.google.com')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-form-label">主題</label>
                                        <input class="form-control" type="text" placeholder="請輸入主題" id="example-search-input" name="title" value="{{old('title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-type-input" class="col-form-label">敘述</label>
                                        <input class="form-control" type="text" placeholder="請輸入敘述" id="example-type-input" name="description" value="{{old('description')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="start_date">開始日期</label>
                                        <input type="datetime-local" name="start_date" id="start_date"
                                               class="form-control col-sm-4" style="display:inline" value="{{old('start_date')}}">
                                        <label for="end_date">結束日期</label>
                                        <input type="datetime-local" name="end_date" id="end_date"
                                               class="form-control col-sm-4" style="display:inline" value="{{old('end_date')}}">

                                    </div>


                                    <div class="form-group">
                                        <label for="hero_image">Hero_image</label>
                                        <input type="file" name="hero_image" id="hero_image" class="form-control" accept="image/jpeg">
                                    </div>
                                    <div class="form-group">
                                        <label for="side_image">Side_image</label>
                                        <input type="file" name="side_image" id="side_image" class="form-control"  accept="image/jpeg">
                                    </div>


                                    {{--<div class="form-group"><label for=""></label><input type="text"></div>--}}




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
