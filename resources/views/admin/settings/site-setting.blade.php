@extends('admin.layouts.index')
@section('title' , 'Site Setting')

@section('content')
    <div class="content-page" style="margin: 0">
        <div class="content mt-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @include('admin.message')
                            </div>
                            <h4 class="mb-3 header-title">تنظیمات </h4>
                            <form action="{{ route('settings.update') }}"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                <input value="{{$group}}" type="hidden"  name="group">

                                @foreach($settings as $setting)

                                    <div class="form-group mt-3">
                                        <label>{{$setting->description}}</label>
                                        <div class="input-group">
                                                @if($setting->type == 'textarea')
                                                <textarea style="width: 100%" id="my-editor{{ $setting->id }}" name="{{$setting->name}}" class="form-control my-editor"> {{$setting->value}}</textarea>

                                            @else

                                                <input value="{{$setting->value}}" type="{{$setting->type}}"  class="form-control" id="{{$setting->name}}" name="{{$setting->name}}">
                                            @endif
                                               @if($setting->type == 'file') <label class="custom-file-label" for="{{$setting->name}}"> {{$setting->value}} </label>@endif

                                        </div>
                                    </div>

                                @endforeach
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    ویرایش
                                </button>
                            </form>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
            </div>
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
        $('.my-editor').each(function(e){
            CKEDITOR.replace( this.id, options);
        });

    </script>

@endsection
