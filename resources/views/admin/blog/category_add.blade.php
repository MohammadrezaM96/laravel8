@extends('admin.layouts.index')
@section('title')
   اضافه کردت دسته بندی
@endsection

@section('page-titr')
    اضافه کردت دسته بندی
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.message')
                    <form class="myForm needs-validation categoryForm" action="{{route('admin.blog.category_add_store')}}"
                          method="post" novalidate="">
                        @csrf
                        <div class="row justify-content-end">

                            <div class="col-md-12 mt-3">
                                <div class="input-field">
                                    <label for="firstname">
                                        <p class="m-0"> نام دسته بندی </p>
                                    </label>
                                    <input placeholder="نام دسته بندی" class="form-control" name="name" type="text"
                                           id="firstname" value="{{old('name')}}" required="">
                                    <div class="valid-tooltip">
                                        نام معتبر می باشد
                                    </div>
                                    <div class="invalid-tooltip">
                                        لطفا نام را وارد کنید
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="input-field">
                                    <label for="firstname">
                                        <p class="m-0"> اولویت </p>
                                    </label>
                                    <input placeholder="اولویت" class="form-control" name="flag" type="text"
                                           id="firstname" value="{{old('flag')}}" required="">
                                    <div class="valid-tooltip">
                                        اولویت معتبر می باشد
                                    </div>
                                    <div class="invalid-tooltip">
                                        لطفا اولویت را وارد کنید
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3 mt-md-0">
                                <label for="status">
                                    <p class="m-0"> وضعیت </p>
                                </label>
                                <div class="dropdown bootstrap-select rounded">
                                    <select class="selectpicker rounded"
                                            id="status"
                                            name="status"
                                            data-style="btn-light"
                                            title=" وضعیت "
                                            tabindex="-98">
                                        <option value="1"  selected>
                                            Active
                                        </option>
                                        <option value="0">
                                            Deactive
                                        </option>

                                    </select>
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary mt-2" type="submit">ثبت</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
