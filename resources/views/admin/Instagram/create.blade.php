@extends('admin.layouts.index')
@section('title' , 'صفحه جدید')
@section('page-titr' , 'صفحه جدید')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="myForm"
                          action="{{ route('instagram.store') }}">
                        @csrf
                        <div class="col-md-12 mt-3">
                            <div class="input-field">
                                <input placeholder="لینک پست" class="form-control" name="post_link" type="text"
                                       id="post_link" value="{{ old('post_link') }}" required="">
                                <label for="post_link">
                                    <p class="m-0">لینک پست </p>
                                </label>
                                <div class="valid-tooltip">
                                    لینک پست معتبر می باشد
                                </div>
                                <div class="invalid-tooltip">
                                    لطفا لینک پست را وارد کنید
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <h5 for="image">
                                <p class="m-0"> عکس پست </p>
                            </h5>
                            <div class="input-group">
                            <span class="input-group-btn">
                                <a href="#" id="lfm" data-input="image" data-preview="holderIcon2"
                                   class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> انتخاب
                                </a>
                            </span>
                                <input id="image" class="form-control" type="text" name="image_link"
                                       required="">
                            </div>
                            <img id="holderIcon2" style="margin-top:15px;height:400px;width: 400px;">
                        </div>

                        <div class="col-md-4 mt-3">
                            <div class="form-group">
                                <div class="checkbox checkbox-primary myCheckbox mt-2">
                                    <input
                                        id="show_footer"
                                        name="is_video"
                                        type="checkbox"
                                        value="1">
                                    <label for="show_footer" class="pointer">
                                       پست مورد نظر ویدیو می باشد!
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
