@extends('layouts.master')

@section('title','新增商品')

@section('index',route('products.index'))

@section('type','Product')

@section('content')


    <div class="main-content-inner"><!--不一樣的部分-->
        <div class="row">
            <div class="col-12">               <!-    col-lg-6 col-ml-12 -->
                <div class="row">
                    <!-- Textual inputs start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">新增商品</h4>
                                <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                {{csrf_field()}}
                                <form action="{{route('products.store')}}" method="post" id="create" enctype="multipart/form-data">
                                    @csrf
                                    <!-- 錯誤訊息 -->
                                    @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <h4 class="alert-heading">ERROR!!</h4>
                                        <p>請修正以下表單</p>
                                        <hr>
                                        <p class="mb-0">
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>

                                    </div>

                                    <script>
                                        $(document).ready(function(){
                                            function presend(){
                                                let target = $(".dynamic");
                                                let myid = target.attr("id");                //找dynamic class的 id
                                                let cat_value = target.val();                    //獲得dynamic class的 value
                                                let dependent = target.data('dependent');    //獲得dynamic class的 dependent
                                                let sub_value = $('#sub_id').val()
                                                let _token=$('input[name="_token"]').val();
                                                console.log(myid);
                                                console.log('|'+cat_value+'|');
                                                console.log(dependent);
                                                console.log(sub_value);
                                                $.ajax({
                                                    url:"{{route('dynamicdependent.prefetch')}}",
                                                    method:"POST",
                                                    data:{
                                                        select:myid,
                                                        sub_id:sub_value,
                                                        cat_id:cat_value,
                                                        _token:_token,
                                                        dependent:dependent,
                                                    },
                                                    success:function (result) {
                                                        $('#'+dependent).html(result);
                                                    }
                                                });
                                            }
                                            presend();
                                        });

                                    </script>
                                    @endif


                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">書名</label>
                                        <input class="form-control" type="text" placeholder="請輸入title" id="example-text-input" name="title" value="{{old('title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-form-label">標題</label>
                                        <input class="form-control" type="text" placeholder="請輸入subtitle" id="example-search-input" name="subtitle" value="{{old('subtitle')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-textarea-input" class="col-form-label">敘述</label>
                                        <textarea  class="form-control" cols="20" rows="4" placeholder="請輸入description" id="example-textarea-input" name="description">{{old('description')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">type</label>
                                        <input class="form-control" type="text" placeholder="請輸入type" id="example-url-input" name="type" value="{{old('type')}}">
                                    </div>
                                    <div class="form-group">
                                         <label for="category_id" class="col-form-label">主分類</label>
                                         <select name="category_id" id="category_id" class="form-control dynamic" data-dependent="subcategory_id">
                                             <option value="">請選擇</option>
                                             @foreach($categories as $category)
                                                 <option value="{{$category->id}}" {{(old('category_id')==$category->id)?"selected":""}}>{{$category->name}}</option>
                                             @endforeach
                                         </select>
                                        <input type="hidden" value="{{old('subcategory_id')}}" id="sub_id">
                                        <label for="subcategory_id" class="col-form-label">次分類</label>
                                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                                            <option value="">請選擇</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                         <label for="example-text-input" class="col-form-label">作者</label>
                                         <input class="form-control" type="text" placeholder="請輸入author" id="example-url-input" name="author" value="{{old('author')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="author_description" class="col-form-label">作者敘述</label>
                                        <input class="form-control" type="text" placeholder="請輸入作者敘述" id="author_description" name="author_description" value="{{old('author_description')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="interpreter" class="col-form-label">譯者</label>
                                        <input class="form-control" type="text" placeholder="請輸入譯者" id="interpreter" name="interpreter" value="{{old('interpreter')}}">
                                    </div>
                                    <!-- start tags-->
                                    <div class="form-group">
                                        <span class="text-muted mb-3 d-block">標籤:</span>
                                    @foreach($tags as $id => $tag)
                                        @if($id!=0 && $id%4==0)
                                                <div class="mb-3"></div>
                                        @endif
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" name="{{$tag->id}}" value="{{$tag->id}}" class="custom-control-input"
                                                   {{ (old($tag->id) ==$tag->id)?'checked':''}} id="customCheck{{$id}}">
                                            <label class="custom-control-label" for="customCheck{{$id}}" style="width:100px">#{{$tag->name}}</label>
                                        </div>
                                    @endforeach
                                    </div>
                                    <!-- end tags-->
                                    <div class="form-group">
                                        <label for="inputPassword" class="">出版商</label>
                                        <input class="form-control" type="text" placeholder="請輸入publisher" id="inputPassword"  name="publisher" value="{{old('publisher')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="publish_year" class="col-form-label">出版年分</label>
                                        <input class="form-control" type="text" id="publish_year" name="publish_year" value="{{old('publish_year')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-number-input" class="col-form-label">ISBN</label>
                                        <input class="form-control" type="text" placeholder="請輸入isbn" id="example-number-input" name="isbn" value="{{old('isbn')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="example-list_price-input" class="col-form-label">定價</label>
                                        <input class="form-control" type="text" placeholder="請輸入list_price" id="example-list_price-input" name="list_price" value="{{old('list_price')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-sale_price-input" class="col-form-label">售價</label>
                                        <input class="form-control" type="text" placeholder="請輸入sale_price" id="example-sale_price-input" name="sale_price" value="{{old('sale_price')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-stock-input" class="col-form-label">庫存</label>
                                        <input class="form-control" type="text" placeholder="請輸入stock" id="example-stock-input" name="stock" value="{{old('stock')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="picture" class="col-form-label">picture</label>
                                        <input class="form-control" type="file"  id="picture" name="picture" value="{{old('picture')}}">
                                    </div>

                                    <div class="form-group">
                                        <button class="form-control" type="submit"onclick="disableButton(this,'#create')">提交</button>
                                    </div>
                                </form>
                                {{csrf_field()}}
                            </div>
                        </div>
                    </div>
                    <!-- Textual inputs end -->
                </div>
            </div>
        </div>
    </div>


@endsection
