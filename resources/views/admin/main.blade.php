@extends('admin.layouts.index')
@section('title' , 'داشبورد')
@section('page-titr' , 'داشبورد')
@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-4">
                        <div class="avatar-lg rounded-circle shadow-lg bg-primary border-primary border">
                            <i class="mdi mdi-postage-stamp font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">0</span>
                            </h3>
                            <p class="text-muted mb-1 text-truncate">تعداد بلاگ ها</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-4">
                        <div class="avatar-lg rounded-circle shadow-lg bg-success border-success border">
                            <i class="fe-play font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span
                                    data-plugin="counterup">0</span></h3>
                            <p class="text-muted mb-1 text-truncate">تعداد بازدید ها</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-4">
                        <div class="avatar-lg rounded-circle shadow-lg bg-blue border-blue border">
                            <i class="fe-archive font-22 avatar-title text-white"></i>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="text-right">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">0</span>
                            </h3>
                            <p class="text-muted mb-1 text-truncate">تعداد پروژه ها</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        {{--        <div class="col-xl-12">--}}
        {{--            <div class="card-box">--}}
        {{--                <h4 class="header-title mb-3">آخرین ویویدهای آپلود شده</h4>--}}

        {{--                <div class="table-responsive">--}}
        {{--                    <table class="table table-borderless table-hover table-centered m-0">--}}

        {{--                        <thead class="thead-light">--}}
        {{--                        <tr>--}}
        {{--                            <th>id کاربر</th>--}}
        {{--                            <th>نام کاربر</th>--}}
        {{--                            <th>نام ویدیو</th>--}}
        {{--                            <th>زمان ویدیو</th>--}}
        {{--                            <th>فرمت ویدیو</th>--}}
        {{--                            <th>تاریخ آپلود</th>--}}
        {{--                        </tr>--}}
        {{--                        </thead>--}}
        {{--                        <tbody>--}}
        {{--                        <tr>--}}
        {{--                            <td colspan="7" class="text-center p-3 bg-soft-pink">موردی یافت نشد</td>--}}
        {{--                        </tr>--}}
        {{--                        </tbody>--}}
        {{--                    </table>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div> <!-- end col -->--}}


        <div class="col-xl-12">
            <div class="card-box">
                <h4 class="header-title mb-3">آخرین تیکت های ارسال شده</h4>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-centered m-0">

                        <thead class="thead-light">
                        <tr>
                            <th>شماره</th>
                            <th>نام و نام خانوادگی</th>
                            <th>شماره تماس</th>
                            <th>ایمیل</th>
                            <th>تاریخ</th>
                            <th>وضعیت</th>
                            <th>جزئیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
{{--                            @foreach(\App\ContactUs::all() as $item=>$contactUs)--}}
{{--                                <td>--}}
{{--                                    {{ $item+1 }}--}}
{{--                                </td>--}}

{{--                                <td>--}}
{{--                                    {{ $contactUs->name ?? ' ' }}--}}
{{--                                </td>--}}

{{--                                <td>--}}
{{--                                    {{ $contactUs->phone ?? ' ' }}--}}
{{--                                </td>--}}

{{--                                <td>--}}
{{--                                    {{ $contactUs->email ?? ' ' }}--}}
{{--                                </td>--}}

{{--                                <td>--}}
{{--                                    {{ $contactUs->created_at->diffForHumans() }}--}}
{{--                                </td>--}}

{{--                                <td>--}}
{{--                                    @if($contactUs->status == 1)--}}
{{--                                        <span class="badge bg-soft-success text-success p-2">خوانده شده</span>--}}
{{--                                    @else--}}
{{--                                        <span class="badge bg-soft-danger text-danger p-2">خوانده نشده</span>--}}
{{--                                    @endif--}}
{{--                                </td>--}}

{{--                                <td>--}}
{{--                                    <a href="{{ route('contact-us.show' , $contactUs->id) }}" data-toggle="tooltip"--}}
{{--                                       title=""--}}
{{--                                       class="btn btn-xs btn-secondary" data-original-title="جزئیات"><i--}}
{{--                                            class="mdi mdi-comment-multiple-outline"></i></a>--}}
{{--                                </td>--}}
{{--                            @endforeach--}}
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Chart JS -->
    <script src="{{ URL::to('/') }}/back/assets/libs/chart-js/Chart.bundle.min.js"></script>

@endsection
