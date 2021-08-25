@extends('admin.layouts.index')
@section('title')
    ویرایش شهر {{ $city->name }}
@endsection

@section('page-titr')
    ویرایش شهر {{ $city->name }}
@endsection
@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('city.update' , $city->id) }}" method="post"
                  class="myForm needs-validation categoryForm" id="frm" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
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
                                                           value="{{ $city->translate($lang->key)->name ?? ' ' }}">
                                                    {{--                                                    <label for="{{ $lang->key . '_name' }}">{{$lang->key}} name</label>--}}
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>
                                @endforeach

                            </div> <!-- end tab-content -->
                        </div> <!-- end card-box-->
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
