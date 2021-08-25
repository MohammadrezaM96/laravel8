<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from coderthemes.com/ubold/layouts/light-rtl/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Oct 2019 22:37:49 GMT -->
<head>
    <meta charset="utf-8"/>
    <title>پنل ادمین - ورود</title>

    <!-- App favicon -->


    <!-- App css -->
    <link href="{{ URL::to('/') }}/back/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('/') }}/back/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('/') }}/back/assets/css/app.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('/') }}/back/assets/css/own.min.css" rel="stylesheet" type="text/css"/>

</head>

<body class="authentication-bg authentication-bg-pattern">

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern">

                    <div class="card-body p-4">


                        <p class="text-center">جهت ورود به پنل مدیریت نام کاربری و رمز عبور خود را وارد کنید</p>
                        <form action="{{ route('admin.login.submit') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label>نام کاربری</label>
                                <input
                                    class="form-control @error('username') is-invalid @enderror"
                                    name="username"
                                    type="text"
                                    required
                                    placeholder="نام کاربری خود را وارد کنید">
                            </div>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="form-group mb-3">
                                <label for="password">رمز عبور</label>
                                <input
                                    class="form-control"
                                    name="password"
                                    type="password"
                                    required=""
                                    id="password"
                                    placeholder="رمز عبور خود را وارد کنید">
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit">ورود به پنل مدیریت</button>
                            </div>

                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->


                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->



<!-- Vendor js -->
<script src="{{ URL::to('/') }}/back/assets/js/vendor.min.js"></script>

<!-- App js -->
<script src="{{ URL::to('/') }}/back/assets/js/app.min.js"></script>

</body>

<!-- Mirrored from coderthemes.com/ubold/layouts/light-rtl/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 30 Oct 2019 22:37:49 GMT -->
</html>
