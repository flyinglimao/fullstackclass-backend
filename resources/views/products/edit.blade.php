@extends('layouts.master')

@section('title','商品編輯')

@section('content')


<div class="main-content-inner"><!--不一樣的部分-->
    <div class="row">
        <div class="col-lg-6 col-ml-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Textual inputs</h4>
                            <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                            <form action="{{route('products.update',['product'=>$product->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="submit" value="提交">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="col-form-label">title</label>
                                <input class="form-control" type="text" value="{{$product->title}}" id="example-text-input" name="title">
                            </div>
                            <div class="form-group">
                                <label for="example-search-input" class="col-form-label">subtitle</label>
                                <input class="form-control" type="text" value="{{$product->subtitle}}" id="example-search-input" name="subtitle">
                            </div>
                            <div class="form-group">
                                <label for="example-textarea-input" class="col-form-label">description</label>
                                <textarea  class="form-control" cols="20" rows="4" id="example-textarea-input" name="description">{{$product->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="col-form-label">type</label>
                                <input class="form-control" type="text" value="{{$product->type}}" id="example-text-input" name="type">
                            </div>
                            <div class="form-group">
                                <label for="example-tel-input" class="col-form-label">author</label>
                                <input class="form-control" type="tel" value="{{$product->author}}" id="example-tel-input" name="author">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="">publisher</label>
                                <input class="form-control" type="text" value="{{$product->publisher}}" id="inputPassword"  name="publisher">
                            </div>
                            <div class="form-group">
                                <label for="example-number-input" class="col-form-label">isbn</label>
                                <input class="form-control" type="text" value="{{$product->isbn}}" id="example-number-input" name="isbn">
                            </div>
                            <div class="form-group">
                                <label for="example-category-input" class="col-form-label">category</label>
                                <input class="form-control" type="text" value="{{$product->category}}" id="example-category-input" name="category">
                            </div>
                            <div class="form-group">
                                <label for="example-list_price-input" class="col-form-label">list_price</label>
                                <input class="form-control" type="text" value="{{$product->list_price}}" id="example-list_price-input" name="list_price">
                            </div>
                            <div class="form-group">
                                <label for="example-sale_price-input" class="col-form-label">sale_price</label>
                                <input class="form-control" type="text" value="{{$product->sale_price}}" id="example-sale_price-input" name="sale_price">
                            </div>
                            <div class="form-group">
                                <label for="example-stock-input" class="col-form-label">stock</label>
                                <input class="form-control" type="text" value="{{$product->stock}}" id="example-stock-input" name="stock">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="submit" value="提交">
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
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Textual inputs end -->
                <!-- Radios start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Radios</h4>
                            <p class="text-muted mb-3">For even more customization and cross browser consistency, use our completely custom form elements to replace the browser defaults. They’re built on top of semantic and accessible markup, so they’re solid replacements for any default form control.</p>
                            <form action="#">
                                <b class="text-muted mb-3 d-block">Radios:</b>
                                <div class="custom-control custom-radio">
                                    <input type="radio" checked id="customRadio1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Checked Radios</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Unchecked Radios</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" checked disabled id="customRadio3" name="customRadio33" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio3">Disabled Radios</label>
                                </div>
                                <b class="text-muted mb-3 mt-4 d-block">Inline Radios:</b>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" checked id="customRadio4" name="customRadio2" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio4">Checked Radios</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadio5" name="customRadio2" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio5">Unchecked Radios</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" checked disabled id="customRadio6" name="customRadio3" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio6">Disabled Radios</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Radios end -->
                <!-- Checkboxes start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Checkboxes</h4>
                            <p class="text-muted mb-3">For even more customization and cross browser consistency, use our completely custom form elements to replace the browser defaults. They’re built on top of semantic and accessible markup, so they’re solid replacements for any default form control.</p>
                            <form action="#">
                                <b class="text-muted mb-3 d-block">Checkbox:</b>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" checked class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">checked Checkbox</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label" for="customCheck2">Unchecked Checkbox</label>
                                </div>
                                <div class="mb-3"></div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" checked disabled class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label" for="customCheck3">checked Checkbox</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" disabled class="custom-control-input" id="customCheck4">
                                    <label class="custom-control-label" for="customCheck4">Unchecked Checkbox</label>
                                </div>
                                <b class="text-muted mb-3 mt-4 d-block">Inline Checkbox:</b>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" checked class="custom-control-input" id="customCheck5">
                                    <label class="custom-control-label" for="customCheck5">checked Checkbox</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="customCheck6">
                                    <label class="custom-control-label" for="customCheck6">Unchecked Checkbox</label>
                                </div>
                                <div class="mb-3"></div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" checked disabled class="custom-control-input" id="customCheck7">
                                    <label class="custom-control-label" for="customCheck7">checked Checkbox</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" disabled class="custom-control-input" id="customCheck8">
                                    <label class="custom-control-label" for="customCheck8">Unchecked Checkbox</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Checkboxes end -->
                <!-- button with dropdown start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Buttons with dropdowns</h4>
                            <p class="text-muted mb-3">For even more customization and cross browser consistency, use our completely custom form elements to replace the browser defaults. They’re built on top of semantic and accessible markup, so they’re solid replacements for any default form control.</p>
                            <form action="#">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div role="separator" class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div role="separator" class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div role="separator" class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button">
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" aria-label="Text input with dropdown button">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div role="separator" class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- button with dropdown end -->
            </div>
        </div>
        <div class="col-lg-6 col-ml-12">
            <div class="row">
                <!-- basic form start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Basic form</h4>
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your
                                        email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- basic form end -->
                <!-- basic form start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Inline form</h4>
                            <form>
                                <div class="form-row align-items-center">
                                    <div class="col-sm-3 my-1">
                                        <label class="sr-only" for="inlineFormInputName">Name</label>
                                        <input type="text" class="form-control" id="inlineFormInputName" placeholder="Jane Doe">
                                    </div>
                                    <div class="col-sm-3 my-1">
                                        <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">@</div>
                                            </div>
                                            <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-auto my-1">
                                        <div class="form-check">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                                <label class="custom-control-label" for="customControlAutosizing">Remember me
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto my-1">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- basic form end -->
                <!-- Input Sizes start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Input Sizes</h4>
                            <input class="form-control form-control-lg mb-4" type="text" placeholder=".form-control-lg">
                            <input class="form-control mb-4" type="text" placeholder="Default input">
                            <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
                        </div>
                    </div>
                </div>
                <!-- Input Sizes end -->
                <!-- Input Sizes Rounded start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Input Sizes Rounded</h4>
                            <input class="form-control form-control-lg input-rounded mb-4" type="text" placeholder=".form-control-lg">
                            <input class="form-control mb-4 input-rounded" type="text" placeholder="Default input">
                            <input class="form-control form-control-sm input-rounded" type="text" placeholder=".form-control-sm">
                        </div>
                    </div>
                </div>
                <!-- Input Sizes Rounded end -->
                <!-- Input Grid start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Input Grid</h4>
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" placeholder=".col-sm-3">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder=".col-sm-6">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder=".col-sm-9">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" placeholder=".col-sm-12">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Input Grid end -->

            </div>
        </div>
    </div>
</div>

@endsection
