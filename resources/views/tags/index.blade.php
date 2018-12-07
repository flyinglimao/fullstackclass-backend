
@extends('layouts.master')

@section('title','Tag列表')

@section('index',route('tags.index'))

@section('type','Tag Index')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <!-- start 進階搜尋-->
                <div class="card">
                    <div class="card-body">
                        <div id="accordion1" class="according">
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#accordion11">進階搜尋</a>
                                </div>
                                <div id="accordion11" class="collapse " data-parent="#accordion1">
                                    <div class="card-body">
                                        <div class="d-sm-flex justify-content-between align-items-center">
                                            <h4 class="header-title mb-0">
                                                搜尋方式
                                            </h4>
                                        </div>
                                        <div class="market-status-table mt-4">
                                            <form  method="get" id="this_form" action="{{route('tags.index')}}">
                                                <div>
                                                    <label for="id" class="col-form-label uniform_label_length">ID</label>
                                                    <input type="text" name="id" class="simple col-sm-3" id="id" value="{{request('id')}}">
                                                    <label for="name" class="col-form-label uniform_label_length">名稱</label>
                                                    <input type="text" name="name" class="simple col-sm-3" id="name" value="{{request('name')}}">
                                                </div>
                                                <div>
                                                    <label for="orderby" class="col-form-label uniform_label_length">排序方式</label>
                                                    <select name="item" id="orderby" class="simple col-sm-3" >
                                                        <option value="">請選擇</option>
                                                        <option value="created_at"{{ (request('item') == 'created_at'?'selected':'') }}>建立時間</option>
                                                        <option value="id"{{ (request('item') == 'id'?'selected':'') }}>ID</option>
                                                    </select>
                                                    <select name="order" class="simple col-sm-3">
                                                        <option value="">請選擇</option>
                                                        <option value="desc" {{ (request('order') == 'desc'?'selected':'') }}>由高至低(以前到現在)</option>
                                                        <option value="asc"  {{ (request('order') == 'asc'?'selected':'') }}>由低至高(現在到以前)</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <button type="submit" class="mybtn btn-primary mt-4 pr-4 pl-4">查詢</button>
                                                </div>

                                            </form>
                                        </div>
                                        {{csrf_field()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end   進階搜尋-->
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">
                                @if(Request::url() != Request::fullurl())
                                    搜尋結果: {{$total.'筆資料'}}
                                @else
                                    標籤列表: {{$total.'筆資料'}}
                                @endif

                            </h4>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table">
                                    <tr class="heading-td">
                                        {{--<td class="mv-icon">ID</td>--}}
                                        <td class="coin-name">編號</td>
                                        <td class="attachments">tag 名稱</td>
                                        <td class="attachments">
                                            <a href="{{route('tags.create')}}" class="btn btn-xs btn-success">新增tag</a>
                                        </td>
                                    </tr>
                                    @foreach($tags as $tag)
                                        <tr>
                                            <td class="coin-name">{{$tag->id}} </td>
                                            <td class="attachments">{{$tag->name}} </td>
                                            <td class="attachments">
                                                <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-xs btn-primary">編輯</a>
                                                <button onclick='beforeDelete("{{$tag->id}}","{{$tag->name}}","標籤","tags")' class="btn btn-xs btn-danger">刪除</button>
                                            </td>
                                        </tr>
                                        <input type="hidden" value="{{$tag->products->count()}}" id="number_of_products{{$tag->id}}">
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div>{{$tags->onEachSide(1)->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function beforeDelete(itemId,itemTitle,displayType,itemModel){
            let ele = '#number_of_products'+itemId;
            let count = $(ele).val();
            console.log(count);
            if (count !== "0"){
                let msg = confirm('你確定要刪除這個標籤，仍然有數個商品有此標籤!!');
                if (msg){
                    confirmDelete(itemId,itemTitle,displayType,itemModel);
                }
            }else{
                confirmDelete(itemId,itemTitle,displayType,itemModel);
            }
        }

    </script>


@endsection
