@extends('admin.layouts.index')
@section('title' , 'تراکنش ها')
@section('page-titr' , 'آرشیو تراکنش ها')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-centered m-0">

                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>شماره سفارش</th>
                            <th>سفارش دهنده</th>
                            <th>تعداد</th>
                            <th>قیمت</th>
                            <th>bazaar_key</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($payments->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center p-3 bg-soft-pink">موردی یافت نشد</td>
                            </tr>
                        @else

                            @foreach($payments as $item=>$payment)
                                <tr>
                                    <td>{{ $item+1 }}</td>
                                    <td>{{ $payment->order_id ?? '-' }}</td>
                                    <td>{{ $payment->user->information->userName ?? '-' }}</td>
                                    <td>{{ $payment->item->count ?? '-' }}</td>
                                    <td>{{ $payment->item->amount ?? '-' }}</td>
                                    <td>{{ $payment->purchase_token ?? '-' }}</td>
                                    <td>{{ $payment->status ? 'موفق' : 'ناموفق' }}</td>
{{--                                    <td>--}}
{{--                                        @switch($payment->status)--}}
{{--                                            @case('done')--}}
{{--                                            <span class="badge badge-info">--}}
{{--                                                                کامل شده--}}
{{--                                            </span>--}}
{{--                                            @break--}}
{{--                                            @case('progressing')--}}
{{--                                            <span class="badge badge-warning">--}}
{{--                                                                در حال انجام--}}
{{--                                            </span>--}}
{{--                                            @break--}}
{{--                                            @case('canceled')--}}
{{--                                            <span class="badge badge-danger">--}}
{{--                                                                کنسل شده--}}
{{--                                            </span>--}}
{{--                                            @break--}}
{{--                                        @endswitch--}}
{{--                                    </td>--}}
                                    <td>{{ convertDate($payment->date/1000) ?? '-' }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{ $payments->links() }}
                </div>
            </div>

        </div> <!-- end col -->
    </div>
@endsection
@section('script')

    <script>

    </script>
@endsection
