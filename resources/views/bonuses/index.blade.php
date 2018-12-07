
@extends('layouts.master')

@section('title','紅利列表')

@section('index',route('bonuses.index'))

@section('type','Bonus Index')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
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
                                            <form  method="get" id="this_form" action="{{route('bonuses.index')}}">
                                                <div>
                                                    <label for="id" class="col-form-label uniform_label_length">id</label>
                                                    <input type="text" class="simple col-sm-3" id="id" name="id" value="{{request('id')}}">
                                                    <label for="message" class="col-form-label uniform_label_length">訊息</label>
                                                    <input type="text" name="message" class="simple col-sm-3" id="message" value="{{request('message')}}">
                                                </div>
                                                <div>
                                                    <label class="col-form-label uniform_label_length">變化量</label>
                                                    <input type="text" class="simple col-sm-2" name="lower" placeholder="lower limit" value="{{request('lower')}}">
                                                    ~~
                                                    <input type="text" class="simple col-sm-2" name="upper" placeholder="upper limit" value="{{request('upper')}}">
                                                </div>
                                                <div>
                                                    <label for="orderby" class="col-form-label uniform_label_length">排序方式</label>
                                                    <select name="item" id="orderby" class="simple col-sm-3" >
                                                        <option value="">請選擇</option>
                                                        <option value="created_at" {{ (request('item') == 'created_at'?'selected':'') }}>建立時間</option>
                                                        <option value="change" {{ (request('item') == 'change'?'selected':'') }}>變化量</option>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">
                                @if(Request::url() != Request::fullurl())
                                    搜尋結果: {{$total.'筆資料'}}
                                @else
                                    紅利列表: {{$total.'筆資料'}}
                                @endif
                            </h4>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table">
                                    <tr class="heading-td">
                                        {{--<td class="mv-icon">ID</td>--}}
                                        <td class="attachments">交易編號</td>
                                        <td class="attachments">使用者id</td>
                                        <td class="attachments">使用者bonus餘額</td>

                                        <td class="attachments">變化量</td>
                                        <td class="attachments">訊息</td>

                                        <td class="attachments">
                                            <a href="{{route('bonuses.create')}}" class="btn btn-xs btn-success">新增紅利紀錄</a>
                                        </td>
                                    </tr>
                                    @foreach($bonuses as $bonus)
                                        <tr>
                                            <td class="coin-name">{{$bonus->order_id}} </td>

                                            <td class="attachments">{{$bonus->user_id}} </td>
                                            <td class="attachments">{{$bonus->user->bonus}} </td>

                                            <td class="attachments">{{$bonus->change}}
                                                @if ($bonus->change<0)
                                                    <img src="{{asset('images/icon/market-value/triangle-down.png')}}" alt="icon">
                                                @else
                                                    <img src="{{asset('images/icon/market-value/triangle-up.png')}}" alt="icon">
                                                @endif
                                            </td>
                                            <td class="attachments">{{$bonus->message}}</td>

                                            <td class="attachments">
                                                <a href="#" class="btn btn-xs btn-primary">編輯</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div>{{$bonuses->appends(Request::except('page'))->onEachSide(1)->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
