@extends('layouts.master')

@section('title','使用者列表')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h4 class="header-title mb-0">使用者列表</h4>
                            <select class="custome-select border-0 pr-3">
                                <option selected>Last 24 Hours</option>
                                <option value="0">01 July 2018</option>
                            </select>
                        </div>
                        <div class="market-status-table mt-4">
                            <div class="table-responsive">
                                <table class="dbkit-table">
                                    <tr class="heading-td">
                                        {{--<td class="mv-icon">ID</td>--}}
                                        <td class="coin-name">使用者名稱</td>
                                        <td class="coin-name">暱稱</td>
                                        <td class="attachments">等級</td>
                                        <td class="attachments">信箱</td>
                                        <td class="attachments">電話</td>
                                        <td class="attachments">
                                            <a href="#" class="btn btn-xs btn-success">新增使用者</a>
                                        </td>
                                    </tr>
                                    @foreach($user_list as $user)
                                        <tr>
                                            {{--                                    <td class="mv-icon">{{$product->id}} </td>--}}
                                            <td class="coin-name">{{$user->realname}} </td>
                                            <td class="attachments">{{$user->username}} </td>
                                            <td class="coin-name">{{$user->level}} </td>
                                            <td class="attachments">{{$user->email}}</td>
                                            <td class="attachments">{{$user->phone}} <img src="{{asset('images/icon/market-value/triangle-down.png')}}" alt="icon"></td>
                                            <td class="attachments">
                                                <a href="#" class="btn btn-xs btn-primary">編輯</a>
                                                <button onclick="" class="btn btn-xs btn-danger">刪除</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <script>
                            function confirmDelete(adminId,adminName) {
                                $('#confirmModalBody').text('確定刪除管理者'+adminId+'號 '+adminName+" 嗎?");
                                $('#confirmModal').modal('toggle');
                                $('input#myNumber').val(adminId);

                            }
                        </script>
                        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">警告</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="confirmModalBody">
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="post" onsubmit="isSubmit()">
                                            @csrf
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                                            <button type="submit" class="btn btn-primary" id="is_submit">確認</button>
                                            <input type="hidden" id="myNumber" name="id" >
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function isSubmit() {
                                $('button#is_submit').attr('disabled',true);
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
