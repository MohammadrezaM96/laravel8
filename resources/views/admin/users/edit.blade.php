@extends('admin.layouts.index')
@section('title')
    ویرایش کاربر
@endsection

@section('page-titr')
    ویرایش کاربر
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="myForm needs-validation categoryForm" action="{{ route('user.update' , $user->id) }}" method="post" novalidate>
                        @method('PATCH')
                        @csrf
                        <div class="row justify-content-end">

                            <div class="col-md-12 mt-3">
                                <div class="input-field">
                                    <label for="followerCoin">
                                        <p class="m-0"> سکه های فالوئر </p>
                                    </label>
                                    <input placeholder="followerCoin" class="form-control" name="followerCoin" type="text" id="followerCoin" value="{{ $user->coin->followerCoin }}"
                                           required />
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div class="input-field">
                                    <label for="likeCoin">
                                        <p class="m-0"> سکه های لایک </p>
                                    </label>
                                    <input placeholder="likeCoin" class="form-control" name="likeCoin" type="text" id="likeCoin" value="{{ $user->coin->likeCoin }}"
                                           required />
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary mt-2" type="submit">ویرایش</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
