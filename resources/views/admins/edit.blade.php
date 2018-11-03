@extends('layouts.master')

@section('title','商品編輯')

@section('content')


    <div class="main-content-inner"><!--不一樣的部分-->
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <!-- Textual inputs start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Textual inputs</h4>
                                <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                <form action="{{route('admins.update',['admin'=>$admin->id])}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <input class="form-control" type="submit" value="提交">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">username</label>
                                        <input class="form-control" type="text" value="{{$admin->username}}" id="example-text-input" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-form-label">display_name</label>
                                        <input class="form-control" type="text" value="{{$admin->display_name}}" id="example-search-input" name="display_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">email</label>
                                        <input class="form-control" type="text" value="{{$admin->email}}" id="example-text-input" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-tel-input" class="col-form-label">phone</label>
                                        <input class="form-control" type="tel" value="{{$admin->phone}}" id="example-tel-input" name="phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="">permissions</label>
                                        <input class="form-control" type="text" value="{{json_decode($admin->permissions)->{'權限'} }}" id="inputPassword"  name="permissions">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="submit" value="提交">
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
