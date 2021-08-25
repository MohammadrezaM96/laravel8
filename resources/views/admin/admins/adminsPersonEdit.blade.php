@extends('admin.layouts.index')
@section('title' , 'Profile Edit')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @include('admin.message')
                    </div>
                    <h4 class="mb-3 header-title">ویرایش ادمین</h4>

                    <form action="{{ route('admin.person.update',$admin->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>نام و نام خانوادگی</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter Your Name"
                                value="{{ $admin->name }}">
                            @error('name')
                            <small class="form-text text-muted alert-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>رمز عبور</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <small class="form-text text-muted alert-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>تکرار رمز عبور</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                            <small class="form-text text-muted alert-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light float-right">
                            ویرایش
                        </button>
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    </div>
@endsection
