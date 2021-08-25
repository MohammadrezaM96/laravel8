<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8"/>
    <title>پنل ادمین - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::to('/') }}/back/assets/images/favicon.ico">

    <!-- Plugins css -->
    <link href="{{ URL::to('/') }}/back/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css"/>

    {{--    <link rel="stylesheet" href="{{url('/')}}/back/assets/css/sweetalert.css">--}}
    <link rel="stylesheet" href="{{url('/')}}/back/assets/libs/sweetalert2/sweetalert2.min.css">

    <!-- App css -->
    <link href="{{ URL::to('/') }}/back/assets/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ URL::to('/') }}/back/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('/') }}/back/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('/') }}/back/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('/') }}/back/assets/css/app.min.css" rel="stylesheet" type="text/css"/>

    {{--    toastr css--}}
    <link href="{{ URL::to('/') }}/back/assets/css/toastr.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('/') }}/back/assets/css/bootstrap-editable.css" rel="stylesheet" type="text/css"/>


    <script><?php echo 'var base_url =\'' . url("/") . '/administrator/\'' ?></script>
    <script><?php echo 'var base_url_storage =\'' . url("/") . '/\'' ?></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{--    <script type="text/javascript" src="{{asset('back/assets/js/sweetalert.min.js')}}"></script>--}}
    <script type="text/javascript" src="{{url('/')}}/back/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    @yield('head')
    <link href="{{ URL::to('/') }}/back/assets/css/own.min.css" rel="stylesheet" type="text/css"/>

</head>

<body dir="rtl">

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#"
                   role="button" aria-haspopup="false" aria-expanded="false">
                    {{--                    <img src="{{ URL::to('/') }}/back/assets/images/users/user-1.jpg" alt="user-image"--}}
                    {{--                         class="rounded-circle">--}}
                    <span class="pro-user-name ml-1">
                                {{ auth('admin')->user()->name ?? '' }} <i class="mdi mdi-chevron-down"></i>
                            </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('admin.person.edit' , auth()->user()->id ?? '') }}"
                       class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>پروفایل</span>
                    </a>


                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <form action="{{ route('admin.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success btn-block"> خروج</button>
                    </form>

                </div>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo text-center">
                        <span class="logo-lg">
                            <img src="{{ URL::to('/') }}/back/assets/images/logo-dark.png" alt="" height="18">
                            <!-- <span class="logo-lg-text-light">UBold</span> -->
                        </span>
                <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">U</span> -->
                            <img src="{{ URL::to('/') }}/back/assets/images/logo-sm.png" alt="" height="24">
                        </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>
        </ul>
    </div>
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu">

        <div class="slimscroll-menu">
            <div class="slimscroll-menu in">
                <div id="sidebar-menu" class="active">

                    <ul class="metismenu in" id="side-menu">
                        <li class="active">
                            <a href="{{ route('admin.dashboard') }}" class="active">
                                <i class="fe-airplay"></i>
                                <span> داشبورد </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-view-list"></i>

                                <span>مدیریت کاربران</span>

                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level collapse" aria-expanded="false">


                                <li>

                                    <a href="{{ route('user.index') }}"> لیست کاربران </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.create') }}">تعریف کاربر جدید</a>

                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-contactless-payment"></i>

                                <span>تراکنش ها</span>

                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level collapse" aria-expanded="false">
                                <li>
                                    <a href="{{ route('admin.payments.index') }}"> لیست تراکنش ها </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);">
                                <i class="mdi mdi-settings"></i>
                                <span>تنظیمات</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level collapse" aria-expanded="false">

                                <li>
                                    <a href="{{ route('setting.index','config') }}"> تنظیمات سایت</a>
                                </li>
                                <li>
                                    <a href="{{ route('setting.index','socialmedia') }}">شبکه های اجتماعی</a>
                                </li>
                                <li>
                                    <a href="{{ route('setting.index','info') }}">اطلاعات</a>
                                </li>
                                <li>
                                    <a href="{{ route('setting.index','WhereIsTurkey') }}">ترکیه کجاست؟</a>
                                </li>

                            </ul>
                        </li>
                    </ul>

                </div>


                <div class="clearfix"></div>
            </div>
            <div class="slimScrollBar"
                 style="background: rgb(158, 165, 171); width: 8px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 65.8979px;"></div>
            <div class="slimScrollRail"
                 style="width: 8px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
        </div>


    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">@yield('page-titr')
                            </h4>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0 text-white">Settings</h5>
    </div>
    <div class="slimscroll-menu">
        <!-- User box -->
        <div class="user-box">
            <div class="user-img">
                <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme"
                     class="rounded-circle img-fluid">
                <a href="javascript:void(0);" class="user-edit"><i class="mdi mdi-pencil"></i></a>
            </div>

            <h5><a href="javascript: void(0);">Geneva Kennedy</a></h5>
            <p class="text-muted mb-0"><small>Admin Head</small></p>
        </div>

        <!-- Settings -->
        <hr class="mt-0"/>
        <h5 class="pl-3">Basic Settings</h5>
        <hr class="mb-0"/>

        <div class="p-3">
            <div class="checkbox checkbox-primary mb-2">
                <input id="Rcheckbox1" type="checkbox" checked>
                <label for="Rcheckbox1">
                    Notifications
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="Rcheckbox2" type="checkbox" checked>
                <label for="Rcheckbox2">
                    API Access
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="Rcheckbox3" type="checkbox">
                <label for="Rcheckbox3">
                    Auto Updates
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="Rcheckbox4" type="checkbox" checked>
                <label for="Rcheckbox4">
                    Online Status
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-0">
                <input id="Rcheckbox5" type="checkbox" checked>
                <label for="Rcheckbox5">
                    Auto Payout
                </label>
            </div>
        </div>

        <!-- Timeline -->
        <hr class="mt-0"/>
        <h5 class="px-3">Messages <span class="float-right badge badge-pill badge-danger">25</span></h5>
        <hr class="mb-0"/>
        <div class="p-3">
            <div class="inbox-widget">
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/user-2.jpg" class="rounded-circle" alt="">
                    </div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Tomaslau</a></p>
                    <p class="inbox-item-text">I've finished it! See you so...</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/user-3.jpg" class="rounded-circle" alt="">
                    </div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Stillnotdavid</a></p>
                    <p class="inbox-item-text">This theme is awesome!</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/user-4.jpg" class="rounded-circle" alt="">
                    </div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a></p>
                    <p class="inbox-item-text">Nice to meet you</p>
                </div>

                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/user-5.jpg" class="rounded-circle" alt="">
                    </div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Shahedk</a></p>
                    <p class="inbox-item-text">Hey! there I'm available...</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/user-6.jpg" class="rounded-circle" alt="">
                    </div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Adhamdannaway</a></p>
                    <p class="inbox-item-text">This theme is awesome!</p>
                </div>
            </div> <!-- end inbox-widget -->
        </div> <!-- end .p-3-->

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<script src="{{ URL::to('/') }}/back/assets/js/jquery.min.js"></script>

{{--    Own js--}}
<script src="{{ URL::to('/') }}/back/assets/js/own.min.js"></script>


<script src="{{ URL::to('/') }}/back/assets/js/image.js"></script>


<!-- Vendor js -->
<script src="{{ URL::to('/') }}/back/assets/js/vendor.min.js"></script>


<!-- Dashboar 1 init js-->
<script src="{{ URL::to('/') }}/back/assets/js/pages/dashboard-1.init.js"></script>

<!-- App js-->
<script src="{{ URL::to('/') }}/back/assets/js/app.min.js"></script>
<script src="{{ URL::to('/') }}/back/assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
<script src="{{ URL::to('/') }}/back/assets/libs/select2/select2.min.js"></script>


<script src="{{ URL::to('/') }}/back/assets/js/toastr.min.js"></script>
<script src="{{ URL::to('/') }}/back/assets/js/bootstrap-editable.min.js"></script>

<script>
    $(document).ready(function () {
        if ("{{ session('success') }}") {
            toastr['success']("{{ session('success') }}");
        } else if ("{{ $errors->any() }}") {

            @foreach($errors->all() as $error)
                toastr['error']("{{ $error }}");
            @endforeach
        }

    });


</script>

@yield('script')
{{--    Own js--}}
{{--<script src="{{ URL::to('/') }}/back/assets/js/image.js"></script>--}}
</body>

</html>
