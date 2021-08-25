@extends('admin.layouts.index')
@section('title' , 'آرشیو دسته بندی محصولات')
@section('page-titr' , 'آرشیو دسته بندی محصولات')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title mb-3">آرشیو دسته بندی محصولات</h4>
                <div class="table-responsive">

                    <table class="table mb-0 table-responsive-xs table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>توضیحات</th>
                            <th>توضیحات متا</th>
                            <th>slug</th>
                            <th>وضعیت</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($categories->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center p-3 bg-soft-pink">موردی یافت نشد</td>
                            </tr>
                        @else
                            @foreach($productCategories as $item=>$category)
                                <tr data-id="{{ $category->id }}">
                                    <th scope="row">{{ $item+1 }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description ? mb_substr(strip_tags($category->description) , 0 , 100).' . . .' : '-'}}</td>
                                    <td>{{ $category->meta_description ? mb_substr(strip_tags($category->meta_description) , 0 , 100).' . . .' : '-'}}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if($category->status == 1)
                                            <span class="badge bg-soft-success text-success p-2">فعال</span>
                                        @else
                                            <span class="badge bg-soft-danger text-danger p-2">غیرفعال</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group2">
                                            @if($category->status == 0)
                                                <a href="{{ route('product.category.change.status' , $category->id) }}"
                                                   class="btn btn-light text-success" data-toggle="tooltip" title=""
                                                   data-original-title="فعال"><span
                                                        class="mdi mdi-check"></span>
                                                </a>
                                            @else
                                                <a href="{{ route('product.category.change.status' , $category->id) }}"
                                                   class="btn btn-light text-danger" data-toggle="tooltip" title=""
                                                   data-original-title="غیرفعال"><span
                                                        class="mdi mdi-close"></span>
                                                </a>
                                            @endif
                                            <a href="{{ route('product.category.edit' , $category->id) }}"
                                               class="btn btn-success "
                                               data-toggle="tooltip" title="" data-original-title="ویرایش">
                                                <span class="mdi mdi-pencil"></span></a>

                                                <button
                                                    class="btn btn-sm btn-danger waves-effect waves-light deleteItem"
                                                    data-id="{{ $category->id }}"
                                                    data-name="{{ $category->name . ' ' . $category->family }}"
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
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('.deleteItem').click(function () {
            var btn = $(this);
            var url = "{{ route('product.category.ajax.delete') }}";
            var id = btn.data('id');
            var name = btn.data('name');
            var title = 'آیا مطمئن هستید که دسته بندی را حذف کنید؟';
            var text = 'حذف دسته بندی:   "' + name + '"';
            var deleted_text = 'دسته بندی  ' + name + 'حذف شد. ';
            delete_row(title, text, deleted_text, url , {id: id}, function () {
                $('tr[data-id="' + id + '"]').fadeOut();
            });
        });
    </script>

    <script type="text/javascript">
        //turn to inline mode
        $.fn.editable.defaults.mode = 'popup';
        {{--$('#videoStatus').editable({--}}
        {{--    value: "{{ $video->status }}",--}}
        {{--    source: [--}}
        {{--        {value: 0, text: 'در انتظار تایید'},--}}
        {{--        {value: 1, text: 'تایید شده'}--}}
        {{--    ]--}}
        {{--});--}}
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('[data-name=status]').editable({
                source: [
                    {value: 0, text: 'فعال'},
                    {value: 1, text: 'غیرفعال'},
                ]
            });
        });

        function refresh() {
            setTimeout(() => {
                window.location.reload();

            }, 1000)
        }
    </script>
@endsection
