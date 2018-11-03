@extends('layouts.master')

@section('title','新增商品')

@section('content')


    <div class="main-content-inner"><!--不一樣的部分-->
        <div class="row">
            <div class="col-12">               <!--    col-lg-6 col-ml-12 -->
                <div class="row">
                    <!-- Textual inputs start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">新增管理員</h4>
                                <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                <form  action="{{route('admins.store')}}" method="post" id="form1">
                                    @csrf
                                    <div class="form-group">
                                        <button class="form-control" type="button" id="is_submit1" onclick="passwordConfirm()">提交</button>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">username</label>
                                        <input value="測試" class="form-control" type="text" placeholder="請輸入username" id="example-text-input" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-display_name" class="col-form-label">display_name</label>
                                        <input value="測試" class="form-control" type="text" placeholder="請輸入display_name" id="example-display_name" name="display_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd1" class="col-form-label">password</label>
                                        <input value="123" class="form-control" type="password" placeholder="請輸入password" id="pwd1" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd2" class="col-form-label">再次輸入password</label>
                                        <input value="123" class="form-control" type="password" placeholder="再次輸入password" id="pwd2" name="double_check">
                                    </div>

                                    <div class="form-group">
                                        <input  class="form-control" type="hidden" id="wrong_pwd" disabled="true" value="密碼錯誤">
                                    </div>

                                    <div class="form-group">
                                        <label for="example-password-input" class="col-form-label">permissions</label>
                                        <input value="測試"  class="form-control" placeholder="請輸入permissions" id="example-password-input" name="permissions">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">email</label>
                                        <input value="測試" class="form-control" type="text" placeholder="請輸入email" id="example-url-input" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-tel-input" class="col-form-label">phone</label>
                                        <input value="測試" class="form-control" type="tel" placeholder="請輸入phone" id="example-tel-input" name="phone">
                                    </div>

                                    <div class="form-group">
                                        <button class="form-control" type="button" onclick="passwordConfirm()"  id="is_submit2">提交</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Textual inputs end -->
                    <script>
                        function passwordConfirm(){
                            let pwd1 = $('#pwd1').val();
                            let pwd2 = $('#pwd2').val();
                            console.log(pwd1);
                            console.log(pwd2);
                            if (pwd1 === pwd2){
                                document.getElementById('wrong_pwd').type="hidden";
                                $('button#is_submit1').attr('disabled',true);
                                document.getElementById('is_submit2').disabled=true;
                                document.forms['form1'].submit();
                            }else {
                                console.log('錯誤的密碼');
                                document.getElementById('wrong_pwd').type="text";
                            }
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
    <script>

    </script>

@endsection
