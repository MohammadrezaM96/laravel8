@extends('admin.layouts.index')
@section('title')
    ادمین جدید
@endsection

@section('page-titr')
    ادمین جدید
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.message')
                    <form class="myForm needs-validation categoryForm" action="{{ route('admin.store') }}"
                          method="post" novalidate="">
                        @csrf
                        <div class="row justify-content-end">

                            <div class="col-md-12 mt-3">
                                <div class="input-field">
                                    <label for="firstname">
                                        <p class="m-0"> نام و نام خانوادگی </p>
                                    </label>
                                    <input placeholder="نام و نام خانوادگی" class="form-control" name="name" type="text"
                                           id="firstname" value="{{ old('name') }}" required="">
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
                                    <label for="username">
                                        <p class="m-0"> نام کاربری </p>
                                    </label>
                                    <input placeholder="نام کاربری" class="form-control" name="username" type="text"
                                           id="username" value="{{ old('username') }}" required="">
                                    <div class="valid-tooltip">
                                        نام کاربری معتبر می باشد
                                    </div>
                                    <div class="invalid-tooltip">
                                        لطفا نام کاربری را وارد کنید
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="input-field">
                                    <label for="password">
                                        <p class="m-0"> رمز عبور </p>
                                    </label>
                                    <input placeholder="رمز عبور" class="form-control" name="password" type="password"
                                           id="password">
                                    <div class="valid-tooltip">
                                        رمز عبور معتبر می باشد
                                    </div>
                                    <div class="invalid-tooltip">
                                        لطفا رمز عبور را وارد کنید
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="input-field">
                                    <label for="password_confirmation">
                                        <p class="m-0"> تکرار رمز عبور </p>
                                    </label>
                                    <input placeholder="تکرار رمز عبور" class="form-control"
                                           name="password_confirmation" type="password" id="password_confirmation">
                                    <div class="valid-tooltip">
                                        تکرار رمز عبور معتبر می باشد
                                    </div>
                                    <div class="invalid-tooltip">
                                        لطفا تکرار رمز عبور را وارد کنید
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <h5> نقش</h5>
                                <div class="dropdown bootstrap-select rounded">
                                    <select class="selectpicker rounded"
                                            required="" name="roles[]"
                                            data-style="btn-light"
                                            title="انتخاب نقش"
                                            tabindex="-98">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}">
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-2" type="submit">ارسال</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
