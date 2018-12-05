@extends('layouts.master')

@section('title','商品編輯')

@section('index',route('products.index'))

@section('type','Product')

@section('content')
    <script>
        $(document).ready(function(){
            function presend(){
                let target = $(".dynamic");
                let myid = target.attr("id");                //找dynamic class的 id: category_id
                let cat_value = target.val();                    //獲得dynamic class的 value
                let dependent = target.data('dependent');    //獲得dynamic class的 dependent
                let _token=$('input[name="_token"]').val();
                let sub_value = $('#sub_id').val();
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

<div class="main-content-inner"><!--不一樣的部分-->
    <div class="row">
        <div class="col-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">編輯商品</h4>
                            <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                            <form action="{{route('products.update',['product'=>$product->id])}}" method="post" id="edit" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')<!--  這個咚咚可以讓你委裝成patch，因為html不允許用patch傳送  -->
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
                                @endif
                            <div class="form-group">
                                <input class="form-control" type="submit" onclick="disableButton(this,'#edit')" value="提交">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="col-form-label">title</label>
                                <input class="form-control" type="text" value="{{old('title',$product->title)}}" id="example-text-input" name="title">
                            </div>
                            <div class="form-group">
                                <label for="example-search-input" class="col-form-label">subtitle</label>
                                <input class="form-control" type="text" value="{{old('subtitle',$product->subtitle)}}" id="example-search-input" name="subtitle">
                            </div>
                            <div class="form-group">
                                <label for="example-textarea-input" class="col-form-label">description</label>
                                <textarea  class="form-control" cols="20" rows="4" id="example-textarea-input" name="description">{{old('description',$product->description)}}</textarea>
                            </div>
                            <!-- tag!!-->
                            <div class="form-group">
                                <span class="text-muted mb-3 d-block">標籤:</span>
                                @foreach($tags as $id => $tag)
                                    @if($id!=0 && $id%4==0)
                                        <div class="mb-3"></div>
                                    @endif
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="{{$tag->id}}" value="{{$tag->id}}" class="custom-control-input"
                                               @if(session('old'))
                                               {{ (old($tag->id) ==$tag->id)?'checked':''}}
                                               @else
                                               {{$product->tags->contains($tag->id)?'checked':''}}
                                               @endif
                                               id="customCheck{{$id}}">
                                        <label class="custom-control-label" for="customCheck{{$id}}" style="width:100px">#{{$tag->name}}</label>
                                    </div>
                                @endforeach
                            </div>


                            <div class="form-group">
                                <label for="example-text-input" class="col-form-label">type</label>
                                <input class="form-control" type="text" value="{{old('type',$product->type)}}" id="example-text-input" name="type">
                            </div>
                            <div class="form-group">
                                <label for="example-tel-input" class="col-form-label">author</label>
                                <input class="form-control" type="tel" value="{{old('author',$product->author)}}" id="example-tel-input" name="author">
                            </div>
                            <div class="form-group">
                                <label for="author_description" class="col-form-label">作者敘述</label>
                                <input class="form-control" type="text" placeholder="請輸入作者敘述" id="author_description" name="author_description" value="{{old('author_description',$product->author_description)}}">
                            </div>
                            <div class="form-group">
                                <label for="interpreter" class="col-form-label">譯者</label>
                                <input class="form-control" type="text" placeholder="請輸入譯者" id="interpreter" name="interpreter" value="{{old('interpreter',$product->interpreter)}}">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="">publisher</label>
                                <input class="form-control" type="text" value="{{old('publisher',$product->publisher)}}" id="inputPassword"  name="publisher">
                            </div>
                            <div class="form-group">
                                <label for="publish_year" class="">出版年份</label>
                                <input class="form-control" type="text" value="{{old('publish_year',$product->publish_year)}}" id="publish_year"  name="publish_year">
                            </div>
                            <div class="form-group">
                                <label for="example-number-input" class="col-form-label">isbn</label>
                                <input class="form-control" type="text" value="{{old('isbn',$product->isbn)}}" id="example-number-input" name="isbn">
                            </div>
                            <div class="form-group">
                                <input type="hidden" value="{{old('subcategory_id',$product->subcategory->subcategory_id)}}" id="sub_id">
                                <label for="category_id" class="col-form-label">category</label>
                                <select name="category_id" id="category_id" class="form-control dynamic" data-dependent="subcategory_id">
                                    <option value="">請選擇</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ (old('category_id',$product->category_id)
                                         == $category->id)?"selected" : ""}}>{{$category->name}}</option>
                                    @endforeach
                                </select>

                                <label for="subcategory_id" class="col-form-label">subcategory</label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="">請選擇</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="example-list_price-input" class="col-form-label">list_price</label>
                                <input class="form-control" type="text" value="{{old('list_price',$product->list_price)}}" id="example-list_price-input" name="list_price">
                            </div>
                            <div class="form-group">
                                <label for="example-sale_price-input" class="col-form-label">sale_price</label>
                                <input class="form-control" type="text" value="{{old('sale_price',$product->sale_price)}}" id="example-sale_price-input" name="sale_price">
                            </div>
                            <div class="form-group">
                                <label for="example-stock-input" class="col-form-label">stock</label>
                                <input class="form-control" type="text" value="{{old('stock',$product->stock)}}" id="example-stock-input" name="stock">
                            </div>
                            <div class="form-group">
                                <label for="picture" class="col-form-label">picture</label>
                                <input class="form-control" type="file" value="{{old('picture',$product->picture)}}" id="picture" name="picture">
                            </div>


                            </form>
                            {{csrf_field()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
