@extends('admin.layouts.index')
@section('title')
    ایجاد ویژگی
@endsection

@section('page-titr')
    ایجاد ویژگی
@endsection

@section('head')
        <link rel="stylesheet" href="{{ url('/') }}/front/css/lib/all.min.css" />
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>--}}
    <link href="{{ URL::to('/') }}/back/assets/css/iconPicker.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('product-attributes.store') }}" method="post"
                  class="myForm needs-validation categoryForm" id="frm" enctype="multipart/form-data">
                @csrf
                <div class="form-row justify-content-start">

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
                                        </div> <!-- end row -->
                                    </div>
                                @endforeach

                            </div> <!-- end tab-content -->
                        </div> <!-- end card-box-->

                    </div>

                    {{--                    <div class="col-md-12 mt-3">--}}
                    {{--                        <label for="firstname">--}}
                    {{--                            <p class="m-0"> آیکون </p>--}}
                    {{--                        </label>--}}
                    {{--                        <div class="input-group">--}}
                    {{--                            <span class="input-group-btn">--}}
                    {{--                                <a href="#" id="lfm" data-input="icon" data-preview="holder" class="btn btn-primary">--}}
                    {{--                                    <i class="fa fa-picture-o"></i> انتخاب--}}
                    {{--                                </a>--}}
                    {{--                            </span>--}}
                    {{--                            <input id="icon" class="form-control" type="text" name="icon">--}}
                    {{--                        </div>--}}
                    {{--                        <img id="holder" style="margin-top:15px;max-height:50px;">--}}
                    {{--                    </div>--}}


                    <div class="col-md-12">
                        <div>
                            <label class="settinglabel">انتخاب آیکون</label>
                            <input type="text" name="icon" class="icon-class-input" value="{{ old('icon') }}"/>
                            <button type="button" class="btn btn-primary picker-button">انتخاب آیکون</button>
                            <span class="demo-icon"></span>
                        </div>

                        <div id="iconPicker" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">انتخاب کنید</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <ul class="icon-picker-list">
                                                <li>
                                                    <a data-class="{item} {activeState}" data-index="{index}"
                                                       style="font-size: 20px;">
                                                        <i class="{item}"></i>
                                                        {{--                                                    <span class="name-class">{item}</span>--}}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">لغو
                                        </button>
                                        <button type="button" id="change-icon" class="btn btn-success">
                                            <span class="fa fa-check-circle-o"></span>
                                            انتخاب
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <button class="btn btn-primary mt-3 float-right" type="submit">ارسال</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ url('/') }}/front/js/lib/all.min.js"></script>
    <script src="{{ URL::to('/') }}/back/assets/js/iconPicker.js"></script>

{{--    <script>--}}
{{--        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}--}}
{{--        var route_prefix = "{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}";--}}
{{--        $('#lfm').filemanager('image', {prefix: route_prefix});--}}
{{--    </script>--}}

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
