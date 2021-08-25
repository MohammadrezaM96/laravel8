@extends('admin.layouts.index')
@section('title' , 'کاربران')
@section('page-titr' , 'آرشیو کاربران')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-centered m-0">

                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>نوع سفارش</th>
                            <th>تعداد سفارش</th>
                            <th>تعداد انجام شده</th>
                            <th>سفارش برای</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($orders->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center p-3 bg-soft-pink">موردی یافت نشد</td>
                            </tr>
                        @else

                            @foreach($orders as $item=>$order)
                                <tr>
                                    <td>{{ $item+1 }}</td>
                                    <td>
                                        @switch($order->type)
                                            @case('follower')
                                            فالوئر
                                            @break
                                            @case('like')
                                            لایک
                                            @break
                                            @case('comment')
                                            کامنت
                                            @break
                                        @endswitch
                                    </td>
                                    <td>{{ $order->count }}</td>
                                    <td>{{ $order->registered }}</td>
                                    <td>{{ $order->forFrom }}</td>
                                    <td>
                                        @switch($order->status)
                                            @case('done')
                                            <span class="badge badge-info">
                                                                کامل شده
                                            </span>
                                            @break
                                            @case('progressing')
                                            <span class="badge badge-warning">
                                                                در حال انجام
                                            </span>
                                            @break
                                            @case('canceled')
                                            <span class="badge badge-danger">
                                                                کنسل شده
                                            </span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>{{ convertDate($order->date/1000) }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>

        </div> <!-- end col -->
    </div>
@endsection
@section('script')

    <script>

    </script>
@endsection
