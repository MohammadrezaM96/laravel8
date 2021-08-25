@extends('admin.layouts.index')
@section('title')
    تعریف محصول جدید
@endsection

@section('page-titr')
    تعریف محصول جدید
@endsection

@section('head')
    <link href="{{ URL::to('/') }}/front/css/lib/image-uploader.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="myForm needs-validation categoryForm" action="{{ route('product.store') }}"
                          method="post" novalidate="" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-start">

                            <div class="col">
                                <div class="card-box">
                                    <ul class="nav nav-pills navtab-bg nav-justified">
                                        @foreach($langs as $lang)
                                            <li class="nav-item">
                                                <a onclick="changeTab(this)" href="{{'#'. $lang->key}}"
                                                   data-toggle="tab" id="{{$lang->key . '-link'}}"
                                                   data-name="{{$lang->key}}" aria-expanded="false" class="nav-link">
                                                    {{$lang->name}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach($langs as $lang)
                                            <div class="tab-pane" id="{{$lang->key}}">
                                                <div class="row">
                                                    {{--                                                    <div class="col-md-12">--}}
                                                    {{--                                                        <div class="input-field">--}}
                                                    {{--                                                            <input type="text" class="form-control" id="{{ $lang->key . '_name' }}" name="{{ $lang->key . '_name' }}"--}}
                                                    {{--                                                                   placeholder="Enter category name" value="{{ old($lang->key . '_name') }}">--}}
                                                    {{--                                                            <label for="{{ $lang->key . '_name' }}">{{$lang->key}} name</label>--}}
                                                    {{--                                                        </div>--}}
                                                    {{--                                                    </div> <!-- end col -->--}}

                                                    <div class="col-md-12 mt-3">
                                                        <div class="input-field">

                                                            <input placeholder="نام محصول({{ $lang->name }})"
                                                                   class="form-control"
                                                                   name="{{ $lang->key . '_name' }}" type="text"
                                                                   id="{{ $lang->key . '_name' }}"
                                                                   value="{{ old($lang->key . '_name') }}">
                                                            <label for="{{ $lang->key . '_name' }}">
                                                                <p class="m-0">نام {{$lang->name}} </p>
                                                            </label>
                                                            {{--                                                            <div class="valid-tooltip">--}}
                                                            {{--                                                                The title is valid--}}

                                                            {{--                                                            </div>--}}
                                                            {{--                                                            <div class="invalid-tooltip">--}}
                                                            {{--                                                                Please enter title--}}

                                                            {{--                                                            </div>--}}
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-3">
                                                        <div class="input-field">

                                                            <h4 class="mb-1">توضیحات محصول</h4>

                                                            <textarea id="my-editor-{{ $lang->key }}"
                                                                      name="{{ $lang->key . '_description' }}"
                                                                      class="">{!! old('content', 'توضیحات درباره ی محصول(' . $lang->name . ')') !!}</textarea>
                                                        </div>
                                                    </div>

                                                </div> <!-- end row -->
                                            </div>
                                        @endforeach

                                    </div> <!-- end tab-content -->
                                </div> <!-- end card-box-->

                            </div>

                            <div class="col-md-12 mt-3">
                                <h5> دسته بندی محصولات </h5>
                                <div class="dropdown bootstrap-select rounded">
                                    <select class="selectpicker rounded"
                                            name="cat_id"
                                            data-style="btn-light"
                                            tabindex="-98">
                                        <option selected="">انتخاب دسته بندی</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <h5> دسته بندی پروژه ها </h5>
                                <div class="dropdown bootstrap-select rounded">
                                    <select class="selectpicker rounded"
                                            name="sub_id"
                                            data-style="btn-light"
                                            tabindex="-98">
                                        <option selected="">انتخاب دسته بندی</option>
                                        @foreach($subs as $sub)
                                            <option value="{{ $sub->id }}">
                                                {{ $sub->name ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <h5> شهر </h5>
                                <div class="dropdown bootstrap-select rounded">
                                    <select class="selectpicker rounded"
                                            name="city_id"
                                            data-style="btn-light"
                                            tabindex="-98">
                                        <option selected="">انتخاب شهر</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">
                                                {{ $city->name ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="input-field">
                                    <input placeholder="کد محصول" class="form-control" name="code" type="text"
                                           id="code" value="{{ old('code') }}" required="">
                                    <label for="code">
                                        <p class="m-0"> کد محصول </p>
                                    </label>
                                    <div class="valid-tooltip">
                                        کد معتبر می باشد
                                    </div>
                                    <div class="invalid-tooltip">
                                        لطفا کد را وارد کنید
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="input-field">
                                    <input placeholder="قیمت" class="form-control" name="price" type="text"
                                           id="price" value="{{ old('price') }}">
                                    <label for="price">
                                        <p class="m-0"> قیمت لیست (دلار)</p>
                                    </label>
                                    <div class="valid-tooltip">
                                        قیمت معتبر می باشد
                                    </div>
                                    <div class="invalid-tooltip">
                                        لطفا قیمت را وارد کنید
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="input-field">
                                    <input placeholder="متراژ" class="form-control" name="meter" type="number"
                                           id="meter" value="{{ old('meter') }}" required="">
                                    <label for="meter">
                                        <p class="m-0"> متراژ </p>
                                    </label>
                                    <div class="valid-tooltip">
                                        متراژ معتبر می باشد
                                    </div>
                                    <div class="invalid-tooltip">
                                        لطفا متراژ را وارد کنید
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="input-field">
                                    <input placeholder="تعداد اتاق خواب" class="form-control" name="bedroom"
                                           type="number"
                                           id="bedroom" value="{{ old('bedroom') }}" required="">
                                    <label for="bedroom">
                                        <p class="m-0"> تعداد اتاق خواب </p>
                                    </label>
                                    <div class="valid-tooltip">
                                        تعداد اتاق خواب معتبر می باشد
                                    </div>
                                    <div class="invalid-tooltip">
                                        لطفا تعداد اتاق خواب را وارد کنید
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="input-field">
                                    <input placeholder="سال ساخت" class="form-control" name="year_of_construction"
                                           type="number"
                                           id="year_of_construction" value="{{ old('year_of_construction') }}"
                                           required="">
                                    <label for="year_of_construction">
                                        <p class="m-0"> سال ساخت </p>
                                    </label>
                                    <div class="valid-tooltip">
                                        سال ساخت معتبر می باشد
                                    </div>
                                    <div class="invalid-tooltip">
                                        لطفا سال ساخت را وارد کنید
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <h5 for="image">
                                    <p class="m-0"> تصویر شاخص محصول </p>
                                </h5>
                                <div class="input-group">
                            <span class="input-group-btn">
                                <a href="#" id="lfm2" data-input="image" data-preview="holderIcon2"
                                   class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> انتخاب
                                </a>
                            </span>
                                    <input id="image" class="form-control" type="text" name="image"
                                           required="">
                                </div>
                                <img id="holderIcon2" style="margin-top:15px;height:619px;width: 100%;">
                            </div>

                            <div class="col-md-6 mt-3">
                                <div class="form-row">
                                    <div class="col-12 col-lg-10 mb-3">
                                        <label class="m-form-label" for="first_name"
                                        >تصاویر</label
                                        >
                                        <div class="image-model"></div>

                                        <div class="error-message"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <img src="{{ url('/') }}/back/img/sample-gallery-product.png" class="mt-3 img-fluid">
                            </div>


                            <hr>

                            <h4>ویژگی ها:</h4><br>
                            @foreach($attributes as $attribute)
                                <div class="col-md-4">
                                    <div class="form-group m-0">
                                        <div class="checkbox checkbox-primary myCheckbox mt-2">
                                            <input
                                                id="{{ 'attribute' . $attribute->id }}"
                                                name="attributes[]"
                                                type="checkbox"
                                                value="{{ $attribute->id }}">
                                            <label for="{{ 'attribute' . $attribute->id }}"
                                                   class="pointer">
                                                {{ $attribute->translate()->name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <button class="btn btn-primary mt-2" type="submit">submit</button>
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

    <script>
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
        var route_prefix = "{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}";
        $('#lfm2').filemanager('image', {prefix: route_prefix});
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
        @foreach($langs as $lang)
        var lang = "{{ $lang->key }}";
        CKEDITOR.replace('my-editor-' + lang, options);
        @endforeach
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


    <script>
        let preload = null
    </script>
    <script src="{{ URL::to('/') }}/back/assets/js/image.js"></script>
    <script src="{{ URL::to('/') }}/front/js/lib/image-uploader.min.js"></script>
@endsection
