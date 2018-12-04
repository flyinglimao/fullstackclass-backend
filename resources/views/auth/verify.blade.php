@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        <h4 class="alert-heading">{{ __('Verify Your Email Address') }}</h4>
                        <p>
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif

                            Before proceeding, please check your email---
                            {{Auth::user()->email}}<br>
                            for a verification link.<br>
                            If you did not receive the email,
                            <a href="{{ route('verification.resend') }}">click here to request another</a>.
                        </p>
                    </div>
                </div>

                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    Before proceeding, please check your email---
                    {{Auth::user()->email}}<br>
                    for a verification link.<br>
                    If you did not receive the email,
                    <a href="{{ route('verification.resend') }}">click here to request another</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
