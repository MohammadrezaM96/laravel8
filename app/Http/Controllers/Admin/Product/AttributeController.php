<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Language;
use App\ProductAttribute;
use App\ProductAttributeTranslation;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Version;

class AttributeController extends Controller
{
    private $langs;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = ProductAttribute::query()->paginate(12);

        return view('admin.productAttributes.index' , [
            'langs' => $this->langs,
            'attributes' => $attributes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.productAttributes.create' , [
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

        $data = new ProductAttribute();
        $data->icon = $request->icon;
        $data->save();

        foreach ($this->langs as $lang) {
            if ($request->input($lang->key . '_name')) {
                $translate = new ProductAttributeTranslation();
                $translate->product_attribute_id = $data->id;
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
    public function edit(ProductAttribute $product_attribute)
    {
        return view('admin.productAttributes.edit' , [
            'langs' => $this->langs,
            'attribute' => $product_attribute
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductAttribute $product_attribute)
    {
        $this->validateForm($request);

        $product_attribute->icon = $request->icon;
        $product_attribute->save();

        foreach ($this->langs as $lang) {
            $translate = ProductAttributeTranslation::where('product_attribute_id', $product_attribute->id)->where('locale', $lang->key)->first();
            $name = $request->input($lang->key . '_name');

            if (!empty($translate)) {
                if (empty($name)) {
                    $translate->delete();
                } else {
                    $translate->name = $name;
                    $translate->save();
                }
            } elseif (!empty($name) and !empty($description)) {
                $translate = new ProductAttributeTranslation();
                $translate->product_attribute_id = $product_attribute->id;
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
//    public function destroy(ProductAttribute $product_attribute)
//    {
//        ProductAttributeTranslation::query()->where('product_attribute_id' , $product_attribute->id)->delete();
//        $product_attribute->delete();
//
//        return redirect()->back()->withSuccess(__('messages.deleteSuccess'));
//    }

    public function destroy(Request $request)
    {
        $product_attribute = ProductAttribute::findOrFail($request->id);;
        ProductAttributeTranslation::query()->where('product_attribute_id' , $product_attribute->id)->delete();
        $product_attribute->delete();

        return 'حذف شد';

    }


    protected function validateForm($request)
    {
        $val = [
            'icon' => 'required',
        ];

        foreach ($this->langs as $lang) {
            $val = array_merge($val, [$lang->key . '_name' => 'required']);
        }
        return $request->validate($val);
    }
}
