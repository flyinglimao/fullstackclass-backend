
@extends('layouts.master')

@section('title','分類列表')

@section('index',route('categories.index'))

@section('type','Category')

@section('content')

    @if (session('alert'))
        <div class="alert alert-danger">
            {{ session('alert') }}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <script>
        var msg = '{{Session('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">
                                分類列表
                            </h4>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table">
                                    <tr class="heading-td">
                                        {{--<td class="mv-icon">ID</td>--}}
                                        <td class="coin-name">編號</td>

                                        <td class="attachments">送出者</td>

                                        <td class="attachments">
                                            <a href="{{route('categories.create')}}" class="btn btn-xs btn-success">新增主分類</a>
                                        </td>
                                    </tr>
                                </table>
                                    @foreach($categories as $id=>$category)
                                        <a class="card-link" data-toggle="collapse" href="#accordion1{{$id}}">
                                            <table class="dbkit-table">
                                                <tr class="heading-td">
                                                    <td class="coin-name">{{$category->id}}</td>
                                                    <td class="attachments">{{$category->name}}</td>
                                                    <td class="attachments"></td>
                                                </tr>
                                            </table>
                                        </a>

                                        <div id="accordion1{{$id}}" class="collapse" data-parent="#accordion1{{$id}}">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-between align-items-center">
                                                    <h4 class="header-title mb-0">
                                                        <a href="{{route('categories.edit',$category->id)}}" class="btn btn-xs btn-primary">編輯主分類</a>
                                                        <button onclick='confirmDelete("{{$category->id}}","{{$category->name}}","主分類","categories")'
                                                                class="btn btn-xs btn-danger" id="{{$id}}">刪除</button>
                                                    </h4>
                                                </div>
                                                <div class="market-status-table mt-4">
                                                    <div class="table-responsive">
                                                        <table class="dbkit-table">
                                                            <tr class="heading-td">
                                                                <td class="attachments">主分類id</td>
                                                                <td class="attachments">次分類id</td>
                                                                <td class="attachments">商品名稱</td>
                                                                <td class="attachments">
                                                                    <a href="{{route('subcategories.create',['category'=>$category->id])}}" class="btn btn-xs btn-success">新增次分類</a>
                                                                </td>
                                                            </tr>
                                                            @foreach($category->subcategories as $subcategory)
                                                                <tr class="heading-td">
                                                                    <td class="attachments">{{$subcategory->category_id}}</td>
                                                                    <td class="attachments">{{$subcategory->subcategory_id}}</td>
                                                                    <td class="attachments">{{$subcategory->name}}</td>
                                                                    <td class="attachments">
                                                                        <a href="{{route('subcategories.edit',$subcategory->id)}}" class="btn btn-xs btn-primary">編輯</a>
                                                                        <button onclick='confirmDelete("{{$subcategory->id}}","{{$subcategory->name}}","副分類","subcategories")'
                                                                                class="btn btn-xs btn-danger">刪除</button>

                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                        <div>{{$categories->onEachSide(1)->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
