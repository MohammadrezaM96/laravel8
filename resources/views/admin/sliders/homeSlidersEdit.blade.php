@extends('admin.layouts.index')
@section('title' , 'Home Slider')
@section('head')
    <!-- Lightbox css -->
    <link href="{{ URL::to('/') }}/back/assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet"
          type="text/css"/>

    <!-- App css -->
    <link href="{{ URL::to('/') }}/back/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('/') }}/back/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::to('/') }}/back/assets/css/app.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                @include('admin.message')
                                <h4 class="header-title">Edit Slider {{ $slider->flag }}</h4>
                                <form method="post" action="{{ route('slider.update' , $slider->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-auto">
                                            Title English
                                            <input name="title_en" type="text" class="form-control mb-2" value="{{ $slider->translate('en')->title }}">
                                        </div>
                                        <div class="col-auto">
                                            Title Arabic
                                            <input name="title_ar" type="text" class="form-control mb-2" value="{{ $slider->translate('ar')->title }}">
                                        </div>
                                        <div class="col-auto">
                                            SubText English
                                            <input name="subtext_en" type="text" class="form-control mb-2" value="{{ $slider->translate('en')->subtext }}">
                                        </div>
                                        <div class="col-auto">
                                            SubText Arabic
                                            <input name="subtext_ar" type="text" class="form-control mb-2" value="{{ $slider->translate('ar')->subtext }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-auto">
                                            <input name="image" type="file" class="form-control mb-2"
                                                   id="inlineFormInput">
                                            <label class="custom-file-label" for="inlineFormInput">Choose file</label>
                                        </div>
                                        <div class="col-auto">
                                            <label class="sr-only" for="inlineFormInputGroup">Flag</label>
                                            <div class="input-group mb-2">
                                                <input name="flag" type="number" class="form-control"
                                                       id="inlineFormInputGroup" value="{{ $slider->flag }}">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light mb-2">
                                                Edit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="text-center mt-3">
                                    <img class="w-75" src="{{ URL::to('/') }}/storage/{{$slider->image_url}}">
                                </div>

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
            </div> <!-- container -->

        </div> <!-- content -->

    </div>
@endsection
@section('script')

    <!-- Magnific Popup-->
    <script src="{{ URL::to('/') }}/back/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Gallery Init-->
    <script src="{{ URL::to('/') }}/back/assets/js/pages/gallery.init.js"></script>

    <script>
        $(document).ready(function () {

            $('.custom-file-label').html("{{ $slider->image_url }}");

            $('#inlineFormInput').on('change', function () {
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            });
        });
    </script>
@endsection
