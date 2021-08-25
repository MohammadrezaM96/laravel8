<?php

namespace App\Http\Controllers\Admin;

use App\ContactUs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $messages = ContactUs::paginate(12);

        return view('admin.contact-us.index')->with([
            'messages' => $messages
        ]);
    }


    public function show(ContactUs $contactUs)
    {
        $contactUs->status = 1;
        $contactUs->save();

        return view('admin.contact-us.show')->with([
            'message' => $contactUs
        ]);
    }

    public function changeFlag(ContactUs $contactUs)
    {
        if ($contactUs->status == 1) {
            $contactUs->status = 0;
        } else {
            $contactUs->status = 1;
        }
        $contactUs->save();

        return redirect()->back()->withSuccess(__('messages.changeStatusSuccessfully'));
    }


    public function destroy(Request $request)
    {
        $item = ContactUs::findOrFail($request->id);

        $item->delete();

        return 'حذف شد';

    }
}
