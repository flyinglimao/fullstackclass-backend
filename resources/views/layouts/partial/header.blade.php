<!-- header area start -->
<div class="header-area">
    <div class="row align-items-center">
        <!-- nav and search button -->
        <div class="col-md-6 col-sm-8 clearfix">
            <div class="nav-btn pull-left">
                <button type="button" class="btn btn-rounded btn-primary">主選單</button>
            </div>
            <div class="search-box pull-left">
                <form action="#">
                    <input type="text" name="search" placeholder="Search..." required>
                    <i class="ti-search"></i>
                </form>
            </div>
        </div>
        <!-- profile info & task notification -->
        <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
                <!-- 全螢幕圖案-->
                <li id="full-view"><i class="ti-fullscreen"></i></li>
                <!-- 小螢幕圖案-->
                <li id="full-view-exit"><i class="ti-zoom-out"></i></li>

                <!-- 鈴鐺圖案-->
                <li class="dropdown">
                    <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                        <span>
                            @auth
                                {{Auth::user()->im_sender->count()}}
                            @else 0
                            @endauth
                        </span>
                    </i>
                    <div class="dropdown-menu bell-notify-box notify-box">

                        <span class="notify-title">You have
                            @auth
                            {{Auth::user()->im_sender->count()}}
                            @else 0
                            @endauth
                            sent to others  <a href="#">view all</a></span>
                        <div class="nofity-list">
                            @auth
                            @foreach(Auth::user()->im_sender as $message)
                            <a href="{{route('messages.edit',$message->id)}}" class="notify-item">
                                <div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
                                <div class="notify-text">
                                    <p>{{$message->title}}</p>
                                    <span>{{$message->message}}</span>
                                </div>
                            </a>
                            @endforeach
                            @endauth

                        </div>
                    </div>
                </li>
                <!-- 電郵圖案-->
                <li class="dropdown">
                    <i class="fa fa-envelope-o dropdown-toggle" data-toggle="dropdown"><span>
                            @auth
                                {{Auth::user()->im_receiver->count()}}
                            @else 0
                            @endauth
                        </span></i>
                    <div class="dropdown-menu notify-box nt-enveloper-box">
                        <span class="notify-title">目前有
                            @auth
                                {{Auth::user()->im_receiver->count()}}
                            @else 0
                            @endauth
                            個訊息<a href="#">看全部</a></span>
                        <div class="nofity-list">
                            @auth
                                @foreach(Auth::user()->im_receiver as $message)
                                    <a href="{{route('messages.edit',$message->id)}}" class="notify-item">
                                        <div class="notify-thumb">
                                            <img src="{{asset('images/author/author-img1.jpg')}}" alt="image">
                                        </div>
                                        <div class="notify-text">
                                            <p>{{$message->sender->name}}</p>
                                            <span>{{$message->message}}</span>
                                        </div>
                                    </a>
                                @endforeach
                            @endauth


                        </div>
                    </div>
                </li>
                {{--<li class="settings-btn">--}}
                    {{--<i class="ti-settings"></i>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
</div>
<!-- header area end -->


<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">貓咪後台</h4>
                <a href="@yield('index')">@yield('type')</a>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right" style="background: linear-gradient(to right, rgba(0, 0, 0, 0.29) 0%, #007bff 100%);">

                @auth
                    @if(isset(Auth::user()->profile))
                        <img class="avatar user-thumb" src="{{asset(Auth::user()->profile)}}" alt="{{Auth::user()->name}}">
                    @else
                        <img class="avatar user-thumb" src="{{asset('images/author/avatar.png')}}" alt="avatar">
                    @endif
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown" >
                    您好, {{Auth::user()->name}}
                    <i class="fa fa-angle-down">
                    </i>
                </h4>
                <div class="dropdown-menu" x-placement="bottom-start">
                    <a class="dropdown-item" href="{{route('home')}}">使用者資料</a>
                    <a class="dropdown-item" href="{{route('user.edit')}}">使用者設定</a>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button class="dropdown-item" type="submit">登出</button>
                    </form>
                </div>
                @else
                    <img class="avatar user-thumb" src="{{asset('images/author/avatar.png')}}" alt="avatar">
                    <h4 class="user-name" ><a style="color:white" href="{{route('login')}}" >請登入</a></h4>
                @endauth
            </div>
        </div>
    </div>
</div>
<!-- page container area start -->
