@extends('layouts.master')
@section('title','test')
@section('content')
<div class="main-content-inner">
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">
                            商品目錄
                        </h4>
                    </div>
                    <div class="market-status-table mt-4">
                        <div class="table-responsive">
                            <table class="dbkit-table">
                                <tr class="heading-td">
                                    <td class="coin-name">書名</td>
                                    <td class="attachments">種類</td>
                                    <td class="attachments">定價</td>
                                    <td class="attachments">特價</td>
                                    <td class="buy">庫存</td>
                                    <td class="sell">上架時間</td>
                                    <td class="attachments">
                                        <a href="#" class="btn btn-xs btn-success">新增商品</a>
                                    </td>
                                </tr>

                                    <tr></tr>
                                    <tr></tr>
                                    <tr></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
