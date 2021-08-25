@extends('admin.layouts.index')
@section('title' , 'کاربران')
@section('page-titr' , 'آرشیو کاربران')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">

                <form class="form-inline mb-3" method="get">

                    <div class="col-md-3 mt-3 mt-md-0">
                        <input type="text" class="form-control w-100" id="username" name="username"
                               value="{{ app('request')->input('username') }}"
                               placeholder="نام کاربر">
                    </div>

                    <div class="col-md-3 mt-3 mt-md-0">
                        <input type="text" class="form-control w-100" id="phone" name="phone"
                               value="{{ app('request')->input('phone') }}"
                               placeholder="موبایل">
                    </div>

                    <div class="col-md-3 mt-3 mt-md-0">
                        <div class="dropdown bootstrap-select rounded">
                            <select class="selectpicker rounded"
                                    name="block"
                                    data-style="btn-light"
                                    title="همه وضعیت ها"
                                    tabindex="-98">
                                <option value="" <?php if (app('request')->input('block') == null) echo 'selected' ?> >
                                    همه وضعیت ها
                                </option>
                                <option
                                    value="0" <?php if (app('request')->input('block') == 0 and app('request')->input('block') != null) echo 'selected' ?>>
                                    Active
                                </option>
                                <option value="1" <?php if (app('request')->input('block') == 1) echo 'selected' ?>>
                                    Block
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 mt-3 mt-md-0">
                        <div class="dropdown bootstrap-select rounded">
                            <select class="selectpicker rounded"
                                    name="paginate"
                                    data-style="btn-light"
                                    title="نمایش در صفحه"
                                    tabindex="-98">

                                <option
                                    value="10" <?php if (app('request')->input('paginate') == 10) echo 'selected' ?>>
                                    10 رکورد
                                </option>
                                <option
                                    value="50" <?php if (app('request')->input('paginate') == 50) echo 'selected' ?>>
                                    50 رکورد
                                </option>
                                <option
                                    value="100" <?php if (app('request')->input('paginate') == 100) echo 'selected' ?>>
                                    100 رکورد
                                </option>
                                <option
                                    value="500" <?php if (app('request')->input('paginate') == 500) echo 'selected' ?>>
                                    500 رکورد
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 mt-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1 mt-3 mt-md-0"> جستجو
                        </button>
                    </div>

                    {{--                    <div class="col-md-6 col-sm-6 mt-2 text-right">--}}
                    {{--                        <div class="btn-group">--}}
                    {{--                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"--}}
                    {{--                                    aria-haspopup="true" aria-expanded="false"> Export <i--}}
                    {{--                                    class="mdi mdi-chevron-down"></i></button>--}}
                    {{--                            <div class="dropdown-menu" x-placement="top-start">--}}

                    {{--                                <a class="dropdown-item" href="{{ route('user.excel.export' , ['download' => 'xlsx']) }}">--}}
                    {{--                                    download .xlsx--}}
                    {{--                                </a>--}}

                    {{--                                <a class="dropdown-item" href="{{ route('user.excel.export' , ['download' => 'csv']) }}">--}}
                    {{--                                    download .csv--}}
                    {{--                                </a>--}}

                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </form>


                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-centered m-0">

                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>نام کاربری</th>
                            <th>تصویر پروفایل</th>
                            <th>سکه فالوئر</th>
                            <th>سکه لایک</th>
                            <th>وضعیت</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center p-3 bg-soft-pink">موردی یافت نشد</td>
                            </tr>
                        @else

                            @foreach($users as $item=>$user)
                                <tr>
                                    <td>{{ $item+1 }}</td>
                                    <td>{{ $user->information->userName ?? '-' }}</td>
                                    <td>
                                        <img src="{{ $user->information->image }}"
                                             alt="{{ $user->information->userName }}"
                                             style="height: 100px; width: 100px">
                                    </td>
                                    <td>{{ $user->coin->followerCoin . ' عدد' ?? '-' }}</td>
                                    <td>{{ $user->coin->likeCoin . ' عدد' ?? '-' }}</td>
                                    <td>
                                        @if($user->block == 1)
                                            <span class="badge bg-soft-danger text-danger p-2">Block</span>
                                        @else
                                            <span class="badge bg-soft-success text-success p-2">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group2">
                                            {{--                                            @if($user->block == 0)--}}
                                            {{--                                                <a href="{{ route('user.status.change' , $user->id) }}"--}}
                                            {{--                                                   class="btn btn-light text-danger" data-toggle="tooltip" title=""--}}
                                            {{--                                                   data-original-title="block کردن"><span--}}
                                            {{--                                                        class="mdi mdi-close"></span></a>--}}
                                            {{--                                            @else--}}

                                            <a href="{{ route('admin.user.orders' , $user->id) }}"
                                               class="btn btn-light text-success" data-toggle="tooltip" title=""
                                               data-original-title="سفارشات"><span
                                                    class="mdi mdi-details"></span></a>


                                            <a href="{{ route('user.edit' , $user->id) }}"
                                               class="btn btn-light text-warning" data-toggle="tooltip" title=""
                                               data-original-title="ویرایش"><span
                                                    class="mdi mdi-pencil"></span></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>

        </div> <!-- end col -->
    </div>
@endsection
@section('script')

    <script>

    </script>
@endsection
