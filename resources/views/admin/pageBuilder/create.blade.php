@extends('admin.layouts.index')
@section('title' , 'صفحه جدید')
@section('page-titr' , 'صفحه جدید')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="myForm"
                          action="{{ route('page.store') }}">
                        @csrf
                        <div class="col-md-12 mt-3">
                            <div class="input-field">
                                <input placeholder="عنوان صفحه" class="form-control" name="title" type="text"
                                       id="title" value="{{ old('title') }}" required="">
                                <label for="title">
                                    <p class="m-0">عنوان صفحه </p>
                                </label>
                                <div class="valid-tooltip">
                                    عنوان صفحه معتبر می باشد
                                </div>
                                <div class="invalid-tooltip">
                                    لطفا عنوان صفحه را وارد کنید
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="input-field">

                                <h4 class="mb-1">توضیحات صفحه(برای سئو)</h4>

                                <textarea class="form-control" name="tiny_description" rows="3"
                                          class="">{!! old('tiny_description') !!}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div class="input-field">

                                <h4 class="mb-1">محتوای صفحه (html)</h4>

                                <textarea class="form-control" id="my-editor" name="content"
                                          class="">{!! old('content') !!}</textarea>
                            </div>
                        </div>


                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <div class="checkbox checkbox-primary myCheckbox mt-2">
                                    <input
                                        id="show_header"
                                        name="show_header"
                                        type="checkbox"
                                        value="1">
                                    <label for="show_header" class="pointer">
                                       قرارگرفتن در header وبسایت
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <div class="checkbox checkbox-primary myCheckbox mt-2">
                                    <input
                                        id="show_footer"
                                        name="show_footer"
                                        type="checkbox"
                                        value="1">
                                    <label for="show_footer" class="pointer">
                                       قرارگرفتن در footer وبسایت
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary mt-3" type="submit">ارسال</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
            {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
        var route_prefix = "{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}";
        $('#lfm').filemanager('image', {prefix: route_prefix});
    </script>
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            language: 'fa',
            contentsLangDirection: 'rtl',
        };
    </script>
    <script>
        CKEDITOR.replace('my-editor', options);
    </script>
@endsection
