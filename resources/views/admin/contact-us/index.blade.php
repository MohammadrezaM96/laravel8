@extends('admin.layouts.index')
@section('title' , 'آرشیو پیام ها')
@section('page-titr' , 'آرشیو پیام ها')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title mb-3">آرشیو پیام ها</h4>
                <div class="table-responsive">

                    <table class="table mb-0 table-responsive-xs table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام و نام خانوادگی</th>
                            <th>شماره تماس</th>
                            <th>ایمیل</th>
                            <th>تاریخ</th>
                            <th>وضعیت</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @if($messages->isEmpty())--}}
{{--                            <tr>--}}
{{--                                <td colspan="10" class="text-center p-3 bg-soft-pink">موردی یافت نشد</td>--}}
{{--                            </tr>--}}
{{--                        @else--}}
                            @foreach($messages as $item=>$message)
                                <tr data-id="{{ $message->id }}">
                                    <th scope="row">{{ $item+1 }}</th>
                                    <td>{{ $message->name ?? '' }}</td>
                                    <td>{{ $message->phone ?? '' }}</td>
                                    <td>{{ $message->email ?? '' }}</td>
                                    <td>
                                        {{ $message->created_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        @if($message->status == 1)
                                            <span class="badge bg-soft-success text-success p-2">خوانده شده</span>
                                        @else
                                            <span class="badge bg-soft-danger text-danger p-2">خوانده نشده</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="btn-group2">

                                            @if($message->status == 0)
                                                <a href="{{ route('contact-us.change.flag' , $message->id) }}"
                                                   class="btn btn-light text-success" data-toggle="tooltip" title=""
                                                   data-original-title="فعال"><span
                                                        class="mdi mdi-check"></span>
                                                </a>
                                            @else
                                                <a href="{{ route('contact-us.change.flag' , $message->id) }}"
                                                   class="btn btn-light text-danger" data-toggle="tooltip" title=""
                                                   data-original-title="غیرفعال"><span
                                                        class="mdi mdi-close"></span>
                                                </a>
                                            @endif

                                            <a href="{{ route('contact-us.show' , $message->id) }}"
                                               class="btn btn-sm btn-success waves-effect waves-light"
                                               data-toggle="tooltip" title="" data-original-title="مشاهده"><i
                                                    class="mdi mdi-details"></i></a>

                                            <button class="btn btn-sm btn-danger waves-effect waves-light deleteItem"
                                                    data-id="{{ $message->id }}"
                                                    data-name="{{ $message->name }}"
                                                    data-toggle="tooltip" title="" data-original-title="حذف"><i
                                                    class="mdi mdi-delete"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
{{--                        @endif--}}
                        </tbody>
                    </table>

                </div>
            </div>
            {{ $messages->links() }}
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('.deleteItem').click(function () {
            var btn = $(this);
            var url = "{{ route('contact-us.ajax.delete') }}";
            var id = btn.data('id');
            var name = btn.data('name');
            var title = 'آیا مطمئن هستید که پیام را حذف کنید؟';
            var text = 'حذف پیام:   "' + name + '"';
            var deleted_text = 'پیام  ' + name + 'حذف شد. ';
            delete_row(title, text, deleted_text, url , {id: id}, function () {
                $('tr[data-id="' + id + '"]').fadeOut();
            });
        });
    </script>


@endsection
