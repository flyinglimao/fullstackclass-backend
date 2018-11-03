@extends('layouts.master')

@section('title','商品編輯')

@section('content')


<div class="main-content-inner"><!--不一樣的部分-->
    <div class="row">
        <div class="col-12">
            <div class="row">
                <!-- Textual inputs start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Textual inputs</h4>
                            <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                            <form action="{{route('products.update',['product'=>$product->id])}}" method="post">
                            @csrf
                            @method('PATCH')<!--  這個咚咚可以讓你委裝成patch，因為html不允許用patch傳送  -->
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
