<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- for ajax use-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('images/icon/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{asset('css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('css/default-css.css')}}">

    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <!-- modernizr css -->
    <script src="{{asset('js/vendor/modernizr-2.8.3.min.js')}}"></script>

</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- preloader area start -->
<div id="preloader">
    <div class="loader"></div>
</div>
<!-- preloader area end -->




<div class="page-container">

@include("layouts.partial.sidebar")
<!-- main content area start -->
    <div class="main-content">
    @include("layouts.partial.header")

    <!-- page title area start -->
    @yield('content')
        <!-- page title area end -->

    </div>
    <!-- main content area end -->
    @include("layouts.partial.footer")
</div>
@include('layouts.partial.offset')


<!-- page container area end -->
<script src="{{asset('js/popper.min.js')}}"></script>

<!-- jquery latest version -->
<script src="{{asset('js/vendor/jquery-2.2.4.min.js')}}"></script>
<!-- bootstrap 4 js -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/metisMenu.min.js')}}"></script>
<script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('js/jquery.slicknav.min.js')}}"></script>



<!-- start chart js -->
{{--<script src={{asset('js/Chart.min.js')}}></script>--}}
<!-- start highcharts js -->
{{--<script src={{asset('js/highcharts.js')}}></script>--}}
<!-- start zingchart js -->
{{--<script src={{asset('js/zingchart.min.js')}}></script>--}}
{{--<script>--}}
    {{--zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";--}}
    {{--ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];--}}
{{--</script>--}}
<!-- all line chart activation -->
{{--<script src="{{asset('js/line-chart.js')}}"></script>--}}
<!-- all pie chart -->
{{--<script src="{{asset('js/pie-chart.js')}}"></script>--}}
<!-- others plugins -->
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>


<!-- start送ajax給DynamicSelectController-->
<script>
    $(document).ready(function(){
        function send_ajax(){
            console.log('use send_ajax() function!!');
            let target = $(".dynamic");
            let myid = target.attr("id");                //找dynamic class的 id
            let value = target.val();                    //獲得dynamic class的 value
            let dependent = target.data('dependent');    //獲得dynamic class的 dependent
            let _token=$('input[name="_token"]').val();
            $.ajax({
                url:"{{route('dynamicdependent.fetch')}}",
                method:"POST",
                data:{
                    select:myid,
                    value:value,
                    _token:_token,
                    dependent:dependent,
                },
                success:function (result) {
                    $('#'+dependent).html(result);
                }
            })
        }
        $('.dynamic').change(send_ajax);
        $('#category_id').change(function(){
            $('#subcategory_id').val('');
        });

    });
</script>
<!-- end送ajax給DynamicSelectController-->

<!-- start刪除警告視窗-->
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
                <form method="post"  id="del">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                    <button type="button" class="btn btn-primary" onclick="disableButton(this,'#del')">確認</button>
                    <input type="hidden" id="myNumber" name="myNumber" >
                    <input type="hidden" id="myModel" name="myModel">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end刪除警告視窗-->

<!-- start啟動刪除視窗-->
<script>
    function disableButton(button_tag,form_tag) {
        console.log('disable the button');
        $(button_tag).attr('disabled',true);
        $(form_tag).submit();

    }

    function confirmDelete(itemId,itemTitle,displayType,itemModel) {

        console.log('use confirmDelete() function!!');
        //pop out the window
        $('#confirmModal').modal('toggle');
        //fill in the warning text
        $('#confirmModalBody').text('確定刪除'+displayType+itemId+'號 '+itemTitle+" 嗎?");
        //got the right url
        let url = '{{route('item.destroy', 'item_id')}}';
        url = url.replace('item_id', itemId);
        url = url.replace('item',itemModel);
        $('#del').attr('action', url);
        return true;
    }
</script>
<!-- end啟動刪除視窗-->



</body>

</html>
