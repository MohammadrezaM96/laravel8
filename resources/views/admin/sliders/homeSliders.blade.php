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
                                <h3 class="header-title font-20">Add Slider</h3>
                                <form class="mt-2" method="post" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-auto">
                                            Title English
                                            <input name="title_en" type="text" class="form-control mb-2" placeholder="Title English">
                                        </div>
                                        <div class="col-auto">
                                            Title Arabic
                                            <input name="title_ar" type="text" class="form-control mb-2" placeholder="Title Arabic">
                                        </div>
                                        <div class="col-auto">
                                            SubText English
                                            <input name="subtext_en" type="text" class="form-control mb-2" placeholder="SubText English">
                                        </div>
                                        <div class="col-auto">
                                            SubText Arabic
                                            <input name="subtext_ar" type="text" class="form-control mb-2" placeholder="SubText Arabic">
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
                                                       id="inlineFormInputGroup" placeholder="Number Slide">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light mb-2">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>

                <hr>

                <div class="row filterable-content">

                    @foreach($sliders as $slider)
                        <div class="col-sm-6 col-xl-3 filter-item all web illustrator">
                            <div class="gal-box">
                                <a href="{{ URL::to('/') }}/storage/{{$slider->image_url}}" class="image-popup"
                                   title="Screenshot-1">
                                    <img src="{{ URL::to('/') }}/storage/{{$slider->image_url}}" class="img-fluid"
                                         alt="work-thumbnail">
                                </a>
                                <div class="gall-info">
                                    <h4 class="font-16 mt-0">Title: {{ $slider->translate('en')->title }}</h4>
                                        <span class="text-muted">SubText: {{ $slider->translate('en')->subtext }}</span>
                                </div>
                                <div class="row justify-content-around">
                                    <h4 class="font-16 mt-0 btn btn-info btn-sm text-center">Number {{ $slider->flag }}</h4>
                                    <a href="{{ route('slider.edit' , $slider->id) }}" class="font-16 btn btn-success btn-sm text-center" style="height: 35px">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                </div> <!-- gallery info -->
                            </div> <!-- end gal-box -->
                        </div> <!-- end col -->
                    @endforeach
                </div>
                <!-- end row -->

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
        $('#inlineFormInput').on('change', function () {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
@endsection
