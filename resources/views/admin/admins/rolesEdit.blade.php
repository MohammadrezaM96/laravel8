@extends('admin.layouts.index')
@section('title' , 'ویرایش نقش')
@section('page-titr' , 'ویرایش نقش')
@section('content')
    <div class="row">
        @include('admin.message')
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-2" id="titleForm">تعریف نقش</h4>
                    <form action="{{ route('role.update' , $role->id) }}" method="post" novalidate=""
                          class="myForm needs-validation categoryForm">
                        @csrf
                        <div class="form-row justify-content-start ">

                            <div class="col-md-12 ">
                                <div class="input-field">
                                    <label for="name">
                                        <p class="m-0">نام نقش</p>
                                    </label>
                                    <input placeholder="name" class="form-control" name="name" type="text"
                                           id="name" required="" value="{{ $role->name }}">

                                    <div class="valid-tooltip">
                                        نام نقش معتبر می باشد
                                    </div>
                                    <div class="invalid-tooltip">
                                        لطفا نام نقش را وارد کنید
                                    </div>
                                </div>
                            </div>

                            <h5 class="col-md-12 text-primary mt-2">دسترسی ها</h5>

                            @foreach($permissions as $permission)
                                <div class="col-md-4">
                                    <div class="form-group m-0">
                                        <div class="checkbox checkbox-primary myCheckbox mt-2">
                                            <input
                                                id="{{ 'permission' . $permission->id }}"
                                                name="permissions[]"
                                                type="checkbox"
                                                value="{{ $permission->name }}"
                                                {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                            <label for="{{ 'permission' . $permission->id }}"
                                                   class="pointer">
                                                {{ $permission->persian_name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button class="btn btn-primary mt-3" type="submit">ویرایش</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        // $('.verify-user').click(function() {
        //     var btn = $(this);
        //     var id = btn.data('id');
        //     var name = btn.data('name');
        //     var title = 'آیا برای تایید کاربر اطمینان دارید؟';
        //     var text = 'تایید  کاربر  با نام کاربری "'+name+'"';
        //     var deleted_text = 'تایید شد';
        //     alert_row(title, text, base_url + 'user/post/verify', {id: id}, function() {
        //         $('span[data-id="'+id+'"]').removeClass();
        //         $('span[data-id="'+id+'"]').addClass('fa fa-check');
        //     });
        // });
        $('.delete_role').click(function () {
            var btn = $(this);
            var id = btn.data('id');
            var name = btn.data('name');
            var title = 'آیا برای حذف کاربر اطمینان دارید؟';
            var text = 'حذق کاربر با نام کاربری "' + name + '"';
            var deleted_text = 'کاربر  ' + name + 'حذف شد ';
            delete_row(title, text, deleted_text, "{{ route('role.delete') }}", {id: id}, function () {
                $('tr[data-id="' + id + '"]').fadeOut();
            });
        });
    </script>
@endsection
