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
                                    <div class="form-group">
                                        <label for="example-number-input" class="col-form-label">isbn</label>
                                        <input class="form-control" type="text"  id="example-number-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-category-input" class="col-form-label">category</label>
                                        <input class="form-control" type="text"  id="example-category-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-list_price-input" class="col-form-label">list_price</label>
                                        <input class="form-control" type="text"  id="example-list_price-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-sale_price-input" class="col-form-label">sale_price</label>
                                        <input class="form-control" type="text"  id="example-sale_price-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-stock-input" class="col-form-label">stock</label>
                                        <input class="form-control" type="text"  id="example-stock-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-datetime-local-input" class="col-form-label">Date and time</label>
                                        <input class="form-control" type="datetime-local" value="2018-07-19T15:30:00" id="example-datetime-local-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-form-label">Date</label>
                                        <input class="form-control" type="date" value="2018-03-05" id="example-date-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-month-input" class="col-form-label">Month</label>
                                        <input class="form-control" type="month" value="2018-05" id="example-month-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-week-input" class="col-form-label">Week</label>
                                        <input class="form-control" type="week" value="2018-W32" id="example-week-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-time-input" class="col-form-label">Time</label>
                                        <input class="form-control" type="time" value="13:45:00" id="example-time-input">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Select</label>
                                        <select class="form-control">
                                            <option>Select</option>
                                            <option>Large select</option>
                                            <option>Small select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Custom Select</label>
                                        <select class="custom-select">
                                            <option selected="selected">Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input-lg" class="col-form-label">Large</label>
                                        <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" id="example-text-input-lg">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input-sm" class="col-form-label">Small</label>
                                        <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm" id="example-text-input-sm">
                                    </div>
                                    <div class="form-group has-primary">
                                        <label for="inputHorizontalPrimary" class="col-form-label">Email</label>
                                        <input type="email" class="form-control form-control-primary" id="inputHorizontalPrimary" placeholder="name@example.com">
                                        <div class="form-control-feedback">Primary! You've done it.</div>
                                        <small class="form-text text-muted">Example help text that remains unchanged.</small>
                                    </div>
                                    <div class="form-group has-warning">
                                        <label for="inputHorizontalWarning" class="col-form-label">Email</label>
                                        <input type="email" class="form-control form-control-warning" id="inputHorizontalWarning" placeholder="name@example.com">
                                        <div class="form-control-feedback">Shucks, check the formatting of that and try again.
                                        </div><small class="form-text text-muted">Example help text that remains unchanged.
                                        </small>
                                    </div>
                                    <div class="form-group mb-0 has-danger">
                                        <label for="inputHorizontalDnger" class="col-form-label">Email</label>
                                        <input type="email" class="form-control form-control-danger" id="inputHorizontalDnger" placeholder="name@example.com">
                                        <div class="form-control-feedback">Sorry, that username's taken. Try another?</div><small class="form-text text-muted">Example help text that remains unchanged.</small>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <!-- Textual inputs end -->


                </div>
            </div>
        </div>
    </div>

@endsection
