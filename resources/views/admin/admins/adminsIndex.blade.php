@extends('admin.layouts.index')
@section('title' , 'آرشیو ادمین ها')
@section('page-titr' , 'آرشیو ادمین ها')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title mb-3">آرشیو ادمین ها</h4>
                <div class="table-responsive">

                    <table class="table mb-0 table-responsive-xs table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>نام و نام خانوادگی</th>
                            <th>نام کاربری</th>
                            <th>نقش</th>
                            <th>وضعیت</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->username }}</td>
                                <td>
                                    @foreach($admin->roles as $role)
                                        <span class="badge bg-soft-blue text-blue p-2">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if($admin->active == 1)
                                        <span class="badge bg-soft-success text-success p-2">فعال</span>
                                    @elseif($admin->active == 0)
                                        <span class="badge bg-soft-danger text-danger p-2">غیر فعال</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group2">
                                        <a href="{{ route('admin.edit' , $admin->id) }}" class="btn btn-success "
                                           data-toggle="tooltip" title="" data-original-title="ویرایش">
                                            <span class="mdi mdi-pencil"></span></a>
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
        $('.delete_admin').click(function () {
            var btn = $(this);
            var id = btn.data('id');
            var name = btn.data('name');
            var title = 'Are you sure you want to delete the Admin?';
            var text = 'Delete Admin :  "' + name + '"';
            var deleted_text = 'Admin  ' + name + 'Deleted ';
            delete_row(title, text, deleted_text, base_url + 'admin/post/delete', {id: id}, function () {
                $('tr[data-id="' + id + '"]').fadeOut();
            });
        });
    </script>


@endsection
