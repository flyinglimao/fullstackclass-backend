@extends('layouts.app')

@section('content')
<!-- start old register-->

<!-- login area start -->

<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="login-form-head">
                    <h4>Sign up</h4>
                    <p>Hello there, Sign up and Join with Us</p>
                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="exampleInputName1">Full Name</label>
                        <input type="text" id="exampleInputName1" class="{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ old('name') }}" required autofocus>
                        <i class="ti-user"></i>
                        @if ($errors->has('name'))
                            <p class="alert alert-danger" role="alert">
                                <span>{{ $errors->first('name') }}</span>
                            </p>
                        @endif
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" id="exampleInputEmail1" class="{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               name="email" value="{{ old('email') }}" required>
                        <i class="ti-email"></i>
                        @if ($errors->has('email'))
                            <p class="alert alert-danger" role="alert">
                                <span>{{ $errors->first('email') }}</span>
                            </p>
                        @endif
                    </div>
                    <div class="form-gp" >
                        <label for="isAdmin">Admin</label><br>

                        <select name="admin" id="isAdmin" class="{{ $errors->has('admin') ? ' is-invalid' : '' }}" required>
                            <option value="">請選擇</option>
                            <option value="0">一般會員</option>
                            <option value="1">管理員</option>
                        </select>
                        <i class="fa fa-user"></i>
                        @if ($errors->has('admin'))
                            <p class="alert alert-danger" role="alert">
                                <span>{{ $errors->first('admin') }}</span>
                            </p>
                        @endif
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" id="exampleInputPassword1" class="{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password" required>
                        <i class="ti-lock"></i>
                        @if ($errors->has('password'))
                            <p class="alert alert-danger" role="alert">
                                <span>{{ $errors->first('password') }}</span>
                            </p>
                        @endif
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputPassword2">Confirm Password</label>
                        <input type="password" id="exampleInputPassword2" name="password_confirmation" required>
                        <i class="ti-lock"></i>
                    </div>


                    <div class="form-gp">
                        <div class="custom-file">
                            <label for="inputGroupFile01">Choose file</label>
                        </div>

                        <div class="custom-file">
                            <input type="file"  id="inputGroupFile01" name="profile" accept="image/jpeg">
                            <i class="fa fa-file-image-o"></i>
                        </div>

                    </div>



                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                        <div class="login-other row mt-4">
                            <div class="col-6">
                                <a class="fb-login" href="#">Sign up with <i class="fa fa-facebook"></i></a>
                            </div>
                            <div class="col-6">
                                <a class="google-login" href="#">Sign up with <i class="fa fa-google"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-footer text-center mt-5">
                        <p class="text-muted">Already have an account? <a href="{{route('login')}}">Sign in</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- login area end -->
@endsection
