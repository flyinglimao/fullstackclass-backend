@extends('layouts.app')

@section('title','貓咪後台登入')

@section('content')
<!-- login area start -->
<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-form-head">
                    <h4>貓咪後台</h4>

                    <p>請登入以獲得更多功能</p>

                </div>
                <div class="login-form-body">
                    <!-- start新加的名字任認證-->
                    <div class="form-gp">
                        <label for="exampleInputName1">使用者名稱</label>
                        <input type="text" id="exampleInputName1" class="{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="{{ old('name') }}" required autofocus>
                        <i class="ti-email"></i>
                    </div>
                    @if ($errors->has('name'))
                        <p class="alert alert-danger" role="alert">
                            <span>{{ $errors->first('name') }}</span>
                        </p>
                    @endif
                    @if (Session('duplicate_email'))
                        <p class="alert alert-danger" role="alert">
                            <span>{{ Session('duplicate_email')}}</span>
                        </p>
                    @endif
                <!-- end新加的名字任認證-->

                    <div class="form-gp">
                        <label for="exampleInputEmail1">電子郵件</label>
                        <input type="email" id="exampleInputEmail1" class="{{ $errors->has('email') ? ' is-invalid' : '' }}"
                               name="email" value="{{ old('email') }}" required>
                        <i class="ti-email"></i>
                    </div>
                    @if ($errors->has('email'))
                        <p class="alert alert-danger" role="alert">
                            <span>{{ $errors->first('email') }}</span>
                        </p>
                    @endif


                    <div class="form-gp">
                        <label for="exampleInputPassword1">密碼</label>
                        <input type="password" id="exampleInputPassword1" class="{{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password" required>
                        <i class="ti-lock"></i>

                    </div>
                    @if ($errors->has('password'))
                        <p class="alert alert-danger" role="alert">
                            <span>{{ $errors->first('password') }}</span>
                        </p>
                    @endif
                    <div class="row mb-4 rmber-area">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input"  name="remember"
                                       id="customControlAutosizing" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label"  style="position:static;" for="customControlAutosizing">記住我</label>

                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('password.request') }}">忘記密碼?</a>
                        </div>
                    </div>
                    <div class="submit-btn-area" >
                        <button id="form_submit" type="submit">登入 <i class="ti-arrow-right"></i></button>
                        <div class="login-other row mt-4" >
                            <div class="col-6">
                                <a class="fb-login" href="{{route('fb_login')}}">以facebook登入 <i class="fa fa-facebook"></i></a>
                            </div>
                            {{--<div class="col-6">--}}
                                {{--<a class="google-login" href="#">以google登入 <i class="fa fa-google"></i></a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <div class="form-footer text-center mt-5">
                        <p class="text-muted">沒有帳戶? 註冊獲得新帳戶! <a href="{{route('register')}}">立即註冊</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- login area end -->



@endsection
