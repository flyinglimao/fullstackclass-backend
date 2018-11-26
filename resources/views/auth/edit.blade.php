@extends('layouts.master')

@section('title','使用者設定')

@section('content')


<div class="main-content-inner"><!--不一樣的部分-->
    <div class="sales-report-area mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="single-report mb-xs-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="s-report-inner pr--20 pt--5 mb-0">
                                <div class="s-report-title d-flex justify-content-between">
                                    <h4 >目前頭貼</h4>
                                </div>
                            </div>
                            <img src="{{asset('storage/user/user1.jpg')}}" alt="no image">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="s-report-inner pr--20 pt--5 mb-0">
                                <div class="s-report-title d-flex justify-content-between">
                                    <h4 >預覽頭貼</h4>
                                </div>
                            </div>
                            <img src="#" alt="no image" id="show_image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="single-report mb-xs-30">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('user.update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <h4 class="alert-heading">ERROR!!</h4>
                                        <p style="background-color:#f8d7da">請修正以下表單</p>
                                        <hr>
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <input type="hidden" value="{{Auth::user()->id}}">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-form-label">使用者名稱</label>
                                    <input class="form-control" type="text" value="{{old("name",Auth::user()->name)}}" id="example-text-input" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="example-email-input" class="col-form-label">電子郵件</label>
                                    <input class="form-control" type="text" value="{{old("email",Auth::user()->email)}}" id="example-email-input" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="example-admin-input" class="col-form-label">權限</label>
                                    <input class="form-control" type="text" value="{{(int)Auth::user()->admin?'管理員':'會員'}}" disabled id="example-admin-input">
                                </div>
                                <div class="form-group">
                                    <label for="preview_file" class="col-form-label">上傳圖片</label>
                                    <input class="form-control" type="file"  id="preview_file" name="profile" accept="image/jpeg">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control">提交</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $('#preview_file').change(function () {
            readURL(this);
        });
        function readURL(input){
            console.log('#readURL');
            if(input.files && input.files[0]){
                let reader = new FileReader();
                reader.onload = function (e) {
                    console.log(e.target.result);
                    $("#show_image").attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    })
</script>

@endsection
