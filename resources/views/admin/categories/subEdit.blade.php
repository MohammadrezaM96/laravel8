@extends('admin.layouts.index')
@section('title')
    ویرایش پروژه
    {{$sub->name}}
@endsection

@section('page-titr')
    ویرایش پروژه

@endsection

{{--@section('head')--}}

{{--    <link href="{{ URL::to('/') }}/front/css/lib/image-uploader.min.css" rel="stylesheet" type="text/css"/>--}}
{{--@endsection--}}

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('product.category.sub.update',$sub->id) }}" method="post"
                  class="myForm needs-validation categoryForm" id="frm" enctype="multipart/form-data">
                @csrf
                <div class="form-row justify-content-start ">


                    <div class="col-md-12">
                        <div class="input-field">
                            <input type="text" class="form-control" id="name" name="name" placeholder="نام را وارد کنید"
                                   value="{{$sub->name}}">

                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <label for="content">محتوا</label>
                            <textarea id="my-editor" name="description" class="form-control"> {{ $sub->description }}</textarea>

                        </div>
                    </div>


                    <div class="col-md-12 mt-3">
                        <h5> دسته بندی محصولات </h5>
                        <div class="dropdown bootstrap-select rounded">
                            <div class="dropdown bootstrap-select rounded"><select class="selectpicker rounded"
                                                                                   name="product_category_id"
                                                                                   data-style="btn-light"
                                                                                   tabindex="-98">
                                    <option selected="">انتخاب دسته بندی</option>
                                    @foreach(\App\ProductCategory::where('status',1)->get() as $category)
                                        <option value="{{$category->id}}"
                                                @if($category->id == $sub->product_category_id) selected @endif>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="firstname">
                                <p class="m-0"> تصویرشاخص </p>
                            </label>
                            <div class="input-group">
                            <span class="input-group-btn">
                                <a href="#" id="lfm" data-input="image" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> انتخاب
                                </a>
                            </span>
                                <input id="image" class="form-control" type="text" name="image"
                                       value="{{$sub->image}}">
                            </div>
                            <img id="holder" src="{{$sub->image}}" style="margin-top:15px;max-height:200px;">
                        </div>

{{--                        <div class="col-md-12 mt-3">--}}
{{--                            <div class="form-row">--}}
{{--                                <div class="col-12 col-lg-10 mb-3">--}}
{{--                                    <label class="m-form-label" for="first_name"--}}
{{--                                    >تصاویر</label--}}
{{--                                    >--}}
{{--                                    <div class="image-model"></div>--}}

{{--                                    <div class="error-message"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                    </div>
                    <button class="btn btn-primary mt-3 float-right" type="submit">ارسال</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')

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
        CKEDITOR.replace('my-editor', options);

    </script>

    <script>
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
        var route_prefix = "{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}";
        $('#lfm').filemanager('image', {prefix: route_prefix});
    </script>

    <script !src="">
        function changeTab(node) {
            console.log(node.getAttribute('data-name'));
            tab = node.getAttribute('data-name');
            let url = new URL(window.location.href);
            let search_params = url.searchParams;
            search_params.set('tab', tab);
            url.search = search_params.toString();
            let new_url = url.toString();
            window.history.pushState({path: new_url}, '', new_url);
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            let url = new URL(window.location.href);
            let search_params = url.searchParams;
            let tab = search_params.get('tab') ?? 'fa';
            document.getElementById(tab).classList.add('active');
            document.getElementById(tab + '-link').classList.add('active');
        });
    </script>

    {{--    <script>--}}
    {{--        let preload = @json($subGallery)--}}
    {{--    </script>--}}
    {{--    <script src="{{ URL::to('/') }}/back/assets/js/imageWithPreload.js"></script>--}}
    {{--    <script src="{{ URL::to('/') }}/front/js/lib/image-uploader.min.js"></script>--}}

@endsection
