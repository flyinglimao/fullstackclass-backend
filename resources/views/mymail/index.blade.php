@extends('layouts.master')

@section('title','測試各種mail url')

@section('content')
@auth




<form method="POST" action="{{ route('password.email') }}">
    @csrf
        @if (session('status'))
            <div class="alert alert-danger" role="alert">
                {{ session('status') }}
            </div>
        @endif
    <input type="hidden"  class="{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   name="email" value="{{ Auth::user()->email}}">
    <h4><button id="form_submit" type="submit">Password reset <i class="ti-arrow-right"></i></button></h4>
</form>

<h4><a href="{{ route('verification.resend') }}">Email verify</a></h4>

<h4><a href="{{route('mails.index2')}}">測試寄信order 2</a></h4>
    @if(session('index2'))
        {{session('index2')}}
    @endif
<h4><a href="{{route('mails.index3')}}">測試寄信order 3</a></h4>
@if(session('index3'))
    {{session('index3')}}
@endif
@endauth

@endsection
