@extends('admin.layouts.index')
@section('title' , 'پست ها')
@section('page-titr' , 'پست ها')
@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-centered m-0">

                        <thead class="thead-light">
                        <tr>
                            <th>شماره</th>
                            <th>لینک پست</th>
                            <th>تصویر پست</th>
                            <th>ابزار</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($posts->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center p-3 bg-soft-pink">موردی یافت نشد</td>
                            </tr>
                        @else
                            @foreach($posts as $item=>$post)
                                <tr data-id="{{ $post->id }}">
                                    <td>{{ $item+1 }}</td>
                                    <td>{{ $post->post_link ?? '-' }}</td>
                                    <td>
                                        <img style="width: 100px;height: 100px"
                                             src="{{\Illuminate\Support\Facades\URL::to('/').'/'.  $post->image_link }}" alt="{{ $post->post_link ?? '-' }}">

                                    </td>
                                    <td>
                                        <div class="btn-group2">
                                            <a href="{{ route('instagram.edit' , $post->id) }}"
                                               class="btn btn-sm btn-success waves-effect waves-light"
                                               data-toggle="tooltip" title="" data-original-title="ویرایش"><i
                                                    class="mdi mdi-pencil"></i></a>

                                                <button
                                                    class="btn btn-sm btn-danger waves-effect waves-light deleteItem"
                                                    data-id="{{ $post->id }}"
                                                    data-name="{{ $post->id ?? '-' }}"
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
            var url = "{{ route('instagram.ajax.delete') }}";
            var id = btn.data('id');
            var name = btn.data('name');
            var title = 'آیا مطمئن هستید که پست را حذف کنید؟';
            var text = 'حذف پست:   "' + name + '"';
            var deleted_text = 'پست  ' + name + 'حذف شد. ';
            delete_row(title, text, deleted_text, url , {id: id}, function () {
                $('tr[data-id="' + id + '"]').fadeOut();
            });
        });
    </script>
@endsection
