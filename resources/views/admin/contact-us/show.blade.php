@extends('admin.layouts.index')
@section('title')
    جزئیات پیام {{ $message->subject }}
@endsection
@section('page-titr')
    جزئیات پیام {{ $message->subject }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-text mr-1"></i>جزئیات پیام</h5>

                    <div>
                        <h4 class="font-13 text-muted text-uppercase">نام و نام خانوادگی فرستنده:</h4>
                        <p class="mb-3">
                            {{ $message->firstname . ' ' . $message->lastname }}
                        </p>

                        <h4 class="font-13 text-muted text-uppercase mb-1">ایمیل فرستنده:</h4>
                        <p class="mb-3"> {{ $message->email }}</p>


                        <h4 class="font-13 text-muted text-uppercase mb-1">عنوان:</h4>
                        <p class="mb-3"> {{ $message->subject }}</p>

                        <h4 class="font-13 text-muted text-uppercase mb-1">متن پیام:</h4>
                        <p class="mb-0"> {{ $message->message }}</p>

                        <h4 class="font-13 text-muted text-uppercase mb-1">تاریخ:</h4>
                        <p class="mb-3"> {{ \Morilog\Jalali\Jalalian::forge($message->created_at)->ago() }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
