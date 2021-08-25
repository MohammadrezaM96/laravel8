@extends('admin.layouts.index')
@section('title' , ' دسته بندی بلاگ')
@section('page-titr' , ' دسته بندی بلاگ')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                @include('admin.message')
                <form class="form-inline mb-3" method="get">

                    <div class="col-md-2 mt-3 mt-md-0">
                        <input type="text" class="form-control w-100" id="first_name" name="name"
                               value="{{ app('request')->input('name') }}"
                               placeholder="عنوان ">
                    </div>



                    <div class="col-md-3 mt-3 mt-md-0">
                        <div class="dropdown bootstrap-select rounded">
                            <select class="selectpicker rounded"
                                    name="status"
                                    data-style="btn-light"
                                    title="همه وضعیت ها"
                                    tabindex="-98">
                                <option value="" <?php if(app('request')->input('status') == null) echo 'selected' ?> >
                                    همه وضعیت ها
                                </option>
                                <option value="0" <?php if(app('request')->input('status') == 0) echo 'selected' ?>>
                                    Deactive
                                </option>
                                <option value="1" <?php if(app('request')->input('status') == 1) echo 'selected' ?>>
                                    Active
                                </option>
                            </select>
                        </div>
                    </div>





                    <div class="col-md-6 col-sm-6 mt-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1 mt-3 mt-md-0"> جستجو
                        </button>
                    </div>

                </form>
                <div class="col-md-12 col-sm-6 mt-2">

                    <div class="btn-group2 fa-pull-left">
                        <a href="{{route('admin.blog.category_add')}}" class="btn btn-success delete_blog"
                           data-toggle="tooltip" title="" data-original-title="حذف">
                            <span class="mdi mdi-plus"></span>اضافه کردن دسته بندی</a>
                    </div>
                </div>
                <br>
                <h4 class="header-title mb-3"> دسته بندی بلاگ</h4>
                <div class="table-responsive">

                    <table class="table mb-0 table-responsive-xs table-hover table-striped">
                        <thead>
                        <tr>

                            <th>نام</th>
                            <th>slug - نام مستعار</th>
                            <th>وضعیت</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blogCategories as $category)
                            <tr data-id="{{ $category->id }}">
                            {{ $category->status }}

                                <td>{{ $category->translate()->name }}</td>

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
                                        <a href="{{ route('admin.blog.category.change.status' , $category->id) }}"
                                           class="btn btn-light text-success" data-toggle="tooltip" title=""
                                           data-original-title="فعال"><span
                                                class="mdi mdi-check"></span>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.blog.category.change.status' , $category->id) }}"
                                           class="btn btn-light text-danger" data-toggle="tooltip" title=""
                                           data-original-title="غیرفعال"><span
                                                class="mdi mdi-close"></span>
                                        </a>
                                    @endif
                                        <a href="{{route('admin.blog.category_edit',$category->id)}}" class="btn btn-success "
                                           data-toggle="tooltip" title="" data-original-title="ویرایش">
                                            <span class="mdi mdi-pencil"></span></a>

                                        <button
                                            class="btn btn-sm btn-danger waves-effect waves-light deleteItem"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->translate()->name ?? '' }}"
                                            data-toggle="tooltip" title="" data-original-title="حذف"><i
                                                class="mdi mdi-delete"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
            var url = "{{ route('admin.blog.category.ajax.delete') }}";
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

@endsection
