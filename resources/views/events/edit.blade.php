@extends('layouts.master')

@section('title','活動編輯')

@section('content')


    <div class="main-content-inner"><!--不一樣的部分-->
        <div class="sales-report-area mt-5 mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-report mb-xs-30">
                        <div class="card">
                            <div class="card-body">
                                <div class="s-report-inner pr--20 pt--5 mb-0">
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 >Hero_image</h4>
                                    </div>
                                </div>
                                <img src="{{asset($event->hero_image)}}" alt="no image" style="border:2px antiquewhite dashed;">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="s-report-inner pr--20 pt--5 mb-0">
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 >預覽Hero_image</h4>
                                    </div>
                                </div>
                                <img src="#" alt="no image" id="show_hero_image" style="border:2px antiquewhite dashed;">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="s-report-inner pr--20 pt--5 mb-0">
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 >Side_image</h4>
                                    </div>
                                </div>
                                <img src="{{asset($event->side_image)}}" alt="no image" style="border:2px antiquewhite dashed;">
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="s-report-inner pr--20 pt--5 mb-0">
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 >預覽Side_image</h4>
                                    </div>
                                </div>
                                <img src="#" alt="no image" id="show_side_image" style="border:2px antiquewhite dashed;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="single-report mb-xs-30">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('events.update',$event->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">ERROR!!</h4>
                                            <p style="background-color:#f8d7da">請修正以下表單</p>
                                            <hr>
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">網址</label>
                                        <input class="form-control" type="url" placeholder="請輸入網址" id="example-text-input" name="url" value="{{old('url',$event->url)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-form-label">主題</label>
                                        <input class="form-control" type="text" placeholder="請輸入主題" id="example-search-input" name="title" value="{{old('title',$event->title)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-type-input" class="col-form-label">敘述</label>
                                        <input class="form-control" type="text" placeholder="請輸入敘述" id="example-type-input" name="description" value="{{old('description',$event->description)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">開始日期</label>
                                        <input type="datetime-local" name="start_date" id="start_date"
                                               class="form-control col-sm-4" style="display:inline"
                                               value="{{old('start_date',Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s.u',json_decode($event->time_interval)->start->date)->format('Y-m-d\TH:i:s'))}}">
                                        <label for="end_date">結束日期</label>
                                        <input type="datetime-local" name="end_date" id="end_date"
                                               class="form-control col-sm-4" style="display:inline"
                                               value="{{old('end_date',Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s.u',json_decode($event->time_interval)->end->date)->format('Y-m-d\TH:i:s'))}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="preview_hero_image">Hero_image</label>
                                        <input type="file" name="hero_image" id="preview_hero_image" class="form-control" accept="image/jpeg">
                                    </div>
                                    <div class="form-group">
                                        <label for="preview_side_image">Side_image</label>
                                        <input type="file" name="side_image" id="preview_side_image" class="form-control"  accept="image/jpeg">
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="form-control">提交</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function (){
            $('#preview_hero_image').change(function () {
                readURL(this,'hero');
            });
            $('#preview_side_image').change(function () {
                readURL(this,'side')
            });
            function readURL(input,type){
                console.log('#readURL');
                if(input.files && input.files[0]&& type==="hero"){
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        console.log(e.target.result);
                        $("#show_hero_image").attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }else{
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        console.log(e.target.result);
                        $("#show_side_image").attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        })
    </script>

@endsection
