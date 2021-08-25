@extends('admin.layouts.index')
@section('title' , 'زیر دسته ها')
@section('page-titr' , 'آرشیو زیر دسته ها')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title mb-3">آرشیو زیر دسته ها</h4>
                <div class="table-responsive">

                    <table class="table mb-0 table-responsive-xs table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>دسته بندی</th>
                            <th>دسته مادر</th>
                            <th>slug - نام مستعار</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subs as $key=>$sub)
                            <tr data-id="{{ $sub->id }}">
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $sub->name ?? '' }}</td>
                                <td>{!! str_limit($sub->description , 100) ?? '' !!}</td>
                                @if($sub->product_category_id == null)
                                    <td> -</td>
                                @else
                                    <td>{{ \App\ProductCategory::find($sub->product_category_id)->name ?? '-' }}</td>
                                @endif
                                <td>{{ $sub->slug ?? '' }}</td>
                                <td>
                                    -
                                </td>
                                <td>
                                    <div class="btn-group2">
                                        <a href="{{ route('product.category.sub.edit' , $sub->id) }}"
                                           class="btn btn-success "
                                           data-toggle="tooltip" title="" data-original-title="ویرایش">
                                            <span class="mdi mdi-pencil"></span></a>
                                        <button
                                            class="btn btn-sm btn-danger waves-effect waves-light deleteItem"
                                            data-id="{{ $sub->id }}"
                                            data-name="{{ $sub->name }}"
                                            data-toggle="tooltip" title="" data-original-title="حذف"><i
                                                class="mdi mdi-delete"></i></button>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $subs->links() }}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('.deleteItem').click(function () {
            var btn = $(this);
            var url = "{{ route('product.sub.ajax.delete') }}";
            var id = btn.data('id');
            var name = btn.data('name');
            var title = 'آیا مطمئن هستید که دسته بندی را حذف کنید؟';
            var text = 'حذف دسته بندی:   "' + name + '"';
            var deleted_text = 'دسته بندی  ' + name + 'حذف شد. ';
            delete_row(title, text, deleted_text, url, {id: id}, function () {
                $('tr[data-id="' + id + '"]').fadeOut();
            });
        });
    </script>
@endsection
