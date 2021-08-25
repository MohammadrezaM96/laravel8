<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Helpers\Upload;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Setting;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    protected $admin;

    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->admin = auth('admin')->user();
            if (!$this->admin->can('canEdit') and $this->admin->id != 1) {
                abort(404);
            }
            return $next($request);
        });

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($setting_name)
    {
        if(count(Setting::where('group',$setting_name)->get())> 0){
         $settings=Setting::where('group',$setting_name)->get();
         $group=$setting_name;
        return view('admin.settings.site-setting',compact('settings','group'));
        }else{
            abort(404);
        }
    }

    public function update(Request $req)
    {
        $group=$req->group;
        $data = $req->except('_token','group');

      foreach ($data as $key=>$req){

          $setting=Setting::where('name',$key)->first();
            if ($setting->type=='file'){
                $img=Upload::uploadFile($req,$setting->group,null);
                $setting->value=$img['url'];

            }else{
                $setting->value=$req;
            }
            $setting->update();
      }

        return redirect(route('setting.index',$group))->with('success','تنظیمات ویرایش شد ویرایش شد');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
