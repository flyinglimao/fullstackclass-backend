
@extends('layouts.master')

@section('title','Tag列表')

@section('index',route('tags.index'))

@section('type','Tag')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">
                                Tag列表
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
