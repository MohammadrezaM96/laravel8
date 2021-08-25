@extends('admin.layouts.index')
@section('title' , 'لیست محصولات')
@section('page-titr' , 'لیست محصولات')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title mb-3">لیست محصولات</h4>
                <div class="table-responsive">

                    <table class="table mb-0 table-responsive-xs table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>متراژ</th>
                            <th>قیمت</th>
                            <th>تعداد اتاق خواب</th>
                            <th>سال ساخت</th>
                            <th>وضعیت</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($products->isEmpty())
                            <tr>
                                <td colspan="11" class="text-center p-3 bg-soft-pink">موردی یافت نشد</td>
                            </tr>
                        @else
                            @foreach($products as $item=>$product)
                                <tr data-id="{{ $product->id }}">
                                    <th scope="row">{{ $item+1 }}</th>
                                    <td>{{ $product->translate()->name ?? '-' }}</td>
                                    <td>{{ $product->meter ?? '-' }}</td>
                                    <td>{{ $product->price ?? '-' }}</td>
                                    <td>{{ $product->bedroom ?? '-' }}</td>
                                    <td>{{ $product->year_of_construction ?? '-' }}</td>
                                    <td>
                                        @if($product->status == 1)
                                            <span class="badge bg-soft-success text-success p-2">فعال</span>
                                        @else
                                            <span class="badge bg-soft-danger text-danger p-2">غیرفعال</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group2">
                                            @if($product->status == 0)
                                                <a href="{{ route('product.change.status' , $product->id) }}"
                                                   class="btn btn-light text-success" data-toggle="tooltip" title=""
                                                   data-original-title="فعال"><span
                                                        class="mdi mdi-check"></span>
                                                </a>
                                            @else
                                                <a href="{{ route('product.change.status' , $product->id) }}"
                                                   class="btn btn-light text-danger" data-toggle="tooltip" title=""
                                                   data-original-title="غیرفعال"><span
                                                        class="mdi mdi-close"></span>
                                                </a>
                                            @endif
                                            <a href="{{ route('product.edit' , $product->id) }}"
                                               class="btn btn-success "
                                               data-toggle="tooltip" title="" data-original-title="ویرایش">
                                                <span class="mdi mdi-pencil"></span></a>


{{--                                            <form action="{{ route('product.destroy',$product->id)}}" method="post">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
{{--                                                <button type="submit" class="btn btn-danger" data-toggle="tooltip"--}}
{{--                                                        title="" data-original-title="حذف"><span--}}
{{--                                                        class="mdi mdi-delete"></span></button>--}}
{{--                                            </form>--}}
                                                <button
                                                    class="btn btn-sm btn-danger waves-effect waves-light deleteItem"
                                                    data-id="{{ $product->id }}"
                                                    data-name="{{ $product->translate()->name ?? '' }}"
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
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('.deleteItem').click(function () {
            var btn = $(this);
            var url = "{{ route('product.ajax.delete') }}";
            var id = btn.data('id');
            var name = btn.data('name');
            var title = 'آیا مطمئن هستید که پروژه را حذف کنید؟';
            var text = 'حذف پروژه:   "' + name + '"';
            var deleted_text = 'پروژه  ' + name + 'حذف شد. ';
            delete_row(title, text, deleted_text, url , {id: id}, function () {
                $('tr[data-id="' + id + '"]').fadeOut();
            });
        });
    </script>


@endsection
