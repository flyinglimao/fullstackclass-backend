@extends('layouts.app')

@section('content')
<!-- this is reset password form-->
<!-- 套樣板了 -->

<!-- start old reset form-->
{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Reset Password') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('password.update') }}">--}}
                        {{--@csrf--}}

                        {{--<input type="hidden" name="token" value="{{ $token }}">--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Reset Password') }}--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}



<!-- login area start -->
<!-- end old reset form-->
<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="login-form-head">
                    <h4>{{ __('Reset Password') }}</h4>
                    <p>Hey! Reset Your Password and comeback again</p>
                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                        <i class="ti-email"></i>
                    </div>
                    @if ($errors->has('email'))
                        <div class="alert alert-danger" role="alert">
                            <span>{{ $errors->first('email') }}</span>
                        </div>
                    @endif
                    <div class="form-gp">
                        <label for="exampleInputPassword1">{{ __('Password') }}</label>
                        <input type="password" id="exampleInputPassword1" name="password" required>
                        <i class="ti-lock"></i>
                    </div>
                    @if ($errors->has('password'))
                        <div class="alert alert-danger" role="alert">
                            <span>{{ $errors->first('password') }}</span>
                        </div>
                    @endif
                    <div class="form-gp">
                        <label for="exampleInputPassword2">{{ __('Confirm Password') }}</label>
                        <input type="password" id="exampleInputPassword2" name="password_confirmation" required>
                        <i class="ti-lock"></i>
                    </div>
                    <div class="submit-btn-area mt-5">
                        <button id="form_submit" type="submit">{{ __('Reset Password') }} <i class="ti-arrow-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- login area end -->

@endsection
