@extends('admin.layouts.index')
@section('title')
    ایجاد دسته بندی
@endsection

@section('page-titr')
    ایجاد دسته بندی
@endsection
@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('product.category.store') }}" method="post"
                  class="myForm needs-validation categoryForm" id="frm" enctype="multipart/form-data">
                @csrf
                <div class="form-row justify-content-start ">

                    <div class="col">
                        <div class="card-box">
                            <ul class="nav nav-pills navtab-bg nav-justified">
                                @foreach($langs as $lang)
                                    <li class="nav-item">
                                        <a onclick="changeTab(this)" href="{{'#'. $lang->key}}" data-toggle="tab"
                                           id="{{$lang->key . '-link'}}"
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
                                            <div class="col-md-12">
                                                <div class="input-field">
                                                    <input type="text" class="form-control"
                                                           id="{{ $lang->key . '_name' }}"
                                                           name="{{ $lang->key . '_name' }}"
                                                           placeholder="نام را وارد کنید"
                                                           value="{{ old($lang->key . '_name') }}">
                                                    {{--                                                    <label for="{{ $lang->key . '_name' }}">{{$lang->key}} name</label>--}}
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-md-12 mt-3">
                                                <div class="input-field">
                                                    <textarea class="form-control" name="{{ $lang->key . '_description' }}"
                                                              id="{{ $lang->key . '_description' }}" rows="3"
                                                              required="">{{ old($lang->key . '_description') }}</textarea>
                                                    <label for="{{ $lang->key . '_description' }}">
                                                        <p class="m-0"> توضیحات </p>
                                                    </label>
                                                    <div class="valid-tooltip">
                                                        توضیحات معتبر می باشد
                                                    </div>
                                                    <div class="invalid-tooltip">
                                                        توضیحات معتبر را وارد کنید
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                    </div>
                                @endforeach

                            </div> <!-- end tab-content -->
                        </div> <!-- end card-box-->

                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="input-field">
                            <textarea class="form-control" name="meta_description" id="meta_description" rows="3"
                                      required=""></textarea>
                            <label for="meta_description">
                                <p class="m-0"> توضیحات متا </p>
                            </label>
                            <div class="valid-tooltip">
                                نام معتبر می باشد
                            </div>
                            <div class="invalid-tooltip">
                                نام معتبر را وارد کنید
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="firstname">
                            <p class="m-0"> تصویر </p>
                        </label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a href="#" id="lfm" data-input="image" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> انتخاب
                                </a>
                            </span>
                            <input id="image" class="form-control" type="text" name="image">
                        </div>
                        <img id="holder" style="margin-top:15px;max-height:200px;">
                    </div>

                </div>
                <button class="btn btn-primary mt-3 float-right" type="submit">ارسال</button>
            </form>
        </div>
    </div>
@endsection

@section('script')


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
@endsection
