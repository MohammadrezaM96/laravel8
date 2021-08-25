<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::query()->orderByDesc('date')->paginate(12);

        return view('admin.payments.index' , compact('payments'));
    }
}
