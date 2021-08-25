@extends('admin.layouts.index')
@section('title' , 'مطلب')
@section('page-titr' , 'مطلب')
@section('content')
    <div class="row">

        <div class="col-lg-12 col-xl-12">
            <div class="card-box">
                <ul class="nav nav-pills navtab-bg nav-justified">

                    <li class="nav-item">
                        <a href="#settings" data-toggle="tab" aria-expanded="false"
                           class="nav-link active">
                            لطفا فیلد های زیر رو تکمیل کنید
                        </a>
                    </li>
                </ul>
                <form method="post" action="{{route('admin.blog.post_edit',$post->id)}}" enctype="multipart/form-data">
                    @csrf

                    <div class="tab-content">

                        <!-- end tab-pane -->
                        <!-- end about me section content -->


                        <div class="tab-pane active" id="settings">


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">عنوان</label>
                                        <input type="text" class="form-control" id="title"
                                               name="title" placeholder="" value="{{$post->title}}"
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="dropdown bootstrap-select rounded">
                                        <label for="category">دسته بندی</label>
                                        <select class="selectpicker rounded"
                                                name="category"
                                                data-style="btn-light"
                                                title="دسته بندی"
                                                tabindex="-98">
                                            @foreach(\App\Blogcategory::where('status',1)->get() as $category)
                                                <option value="{{$category->id}}" @if($post->blogcategory_id == $category->id) selected @endif>
                                                    {{$category->name}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">محتوا</label>
                                        <textarea id="my-editor" name="desc" class="form-control"> {{$post->content}}</textarea>

                                    </div>
                                </div>

                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="view">بازدید</label>
                                        <input type="text" class="form-control" id="view"
                                               name="view" value="{{$post->view}}" placeholder=""
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">عکس</label>
                                        <input type="file" class="form-control" id="title"
                                               name="image" placeholder=""
                                        >
                                    </div>
                                </div>

                            </div> <!-- end row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img style="height: 400px;height: 200px" src="{{\Illuminate\Support\Facades\URL::to('/').'/'.$post->image}}">

                                    </div>
                                </div>


                            </div>
                            <!-- en -->

                            <div class="text-right">
                                <button type="submit"
                                        class="btn btn-success waves-effect waves-light mt-2"><i
                                        class="mdi mdi-content-save"></i> ثبت
                                </button>
                            </div>

                        </div>
                        <!-- end settings content-->

                    </div>
                </form> <!-- end tab-content -->
            </div> <!-- end card-box-->

        </div> <!-- end col -->

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


@endsection
