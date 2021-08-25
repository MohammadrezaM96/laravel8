<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\CityTranslation;
use App\Http\Controllers\Controller;
use App\Language;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $langs;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::query()->paginate(12);

        return view('admin.city.index' , [
            'langs' => $this->langs,
            'cities' => $cities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.city.create' , [
            'langs' => $this->langs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateForm($request);

        $data = new City();
        $data->save();

        foreach ($this->langs as $lang) {
            if ($request->input($lang->key . '_name')) {
                $translate = new CityTranslation();
                $translate->city_id = $data->id;
                $translate->locale = $lang->key;
                $translate->name = $request->input($lang->key . '_name');
                $translate->save();
            }
        }

        return redirect()->back()->withSuccess(__('messages.createSuccess'));
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
    public function edit(City $city)
    {
        return view('admin.city.edit' , [
            'langs' => $this->langs,
            'city' => $city
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $this->validateForm($request);

        foreach ($this->langs as $lang) {
            $translate = CityTranslation::where('city_id', $city->id)->where('locale', $lang->key)->first();
            $name = $request->input($lang->key . '_name');

            if (!empty($translate)) {
                if (empty($name)) {
                    $translate->delete();
                } else {
                    $translate->name = $name;
                    $translate->save();
                }
            } elseif (!empty($name) and !empty($description)) {
                $translate = new CityTranslation();
                $translate->city_id = $city->id;
                $translate->locale = $lang->key;
                $translate->name = $name;
                $translate->save();
            }
        }

        return redirect()->back()->withSuccess(__('messages.editSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // delete City
    public function destroy(Request $request)
    {
        $item = City::findOrFail($request->id);

        $item->delete();

        return 'حذف شد';

    }


    public function changestatus(City $city)
    {
        $city->status = !$city->status;
        $city->save();

        return redirect()->back()->withSuccess(__('messages.changeStatusSuccessfully'));
    }


    protected function validateForm($request)
    {
        $val = [];

        foreach ($this->langs as $lang) {
            $val = array_merge($val, [$lang->key . '_name' => 'required']);
        }
        return $request->validate($val);
    }
}
