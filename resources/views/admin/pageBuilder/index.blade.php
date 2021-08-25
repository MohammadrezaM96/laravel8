@extends('admin.layouts.index')
@section('title' , 'صفحات')
@section('page-titr' , 'صفحات')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-centered m-0">

                        <thead class="thead-light">
                        <tr>
                            <th>شماره</th>
                            <th>نام صفحه</th>
                            <th>slug</th>
                            <th>وضعیت</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($pages->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center p-3 bg-soft-pink">موردی یافت نشد</td>
                            </tr>
                        @else
                            @foreach($pages as $item=>$page)
                                <tr data-id="{{ $page->id }}">
                                    <td>{{ $item+1 }}</td>
                                    <td>{{ $page->title ?? '-' }}</td>
                                    <td>{{ $page->slug ?? '-' }}</td>
                                    <td>
                                        @if($page->active == 1)
                                            <span class="badge bg-soft-success text-success p-2">فعال</span>
                                        @else
                                            <span class="badge bg-soft-danger text-danger p-2">غیرفعال</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group2">

                                            @if($page->active == 0)
                                                <a href="{{ route('page.change.active' , $page->id) }}"
                                                   class="btn btn-light text-success" data-toggle="tooltip" title=""
                                                   data-original-title="فعال"><span
                                                        class="mdi mdi-check"></span>
                                                </a>
                                            @else
                                                <a href="{{ route('page.change.active' , $page->id) }}"
                                                   class="btn btn-light text-danger" data-toggle="tooltip" title=""
                                                   data-original-title="غیرفعال"><span
                                                        class="mdi mdi-close"></span>
                                                </a>
                                            @endif

                                            <a href="{{ route('page.edit' , $page->id) }}"
                                               class="btn btn-sm btn-success waves-effect waves-light"
                                               data-toggle="tooltip" title="" data-original-title="ویرایش"><i
                                                    class="mdi mdi-pencil"></i></a>

                                                <button
                                                    class="btn btn-sm btn-danger waves-effect waves-light deleteItem"
                                                    data-id="{{ $page->id }}"
                                                    data-name="{{ $page->title ?? '-' }}"
                                                    data-toggle="tooltip" title="" data-original-title="حذف"><i
                                                        class="mdi mdi-delete"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
@section('script')

    <script type="text/javascript">
        $('.deleteItem').click(function () {
            var btn = $(this);
            var url = "{{ route('page.ajax.delete') }}";
            var id = btn.data('id');
            var name = btn.data('name');
            var title = 'آیا مطمئن هستید که صفحه را حذف کنید؟';
            var text = 'حذف صفحه:   "' + name + '"';
            var deleted_text = 'صفحه  ' + name + 'حذف شد. ';
            delete_row(title, text, deleted_text, url , {id: id}, function () {
                $('tr[data-id="' + id + '"]').fadeOut();
            });
        });
    </script>
@endsection
