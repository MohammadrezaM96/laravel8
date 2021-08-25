<?php

namespace App\Http\Controllers\Admin\Product;

use App\City;
use App\Http\Controllers\Controller;
use App\Language;
use App\Product;
use App\ProductAttribute;
use App\ProductCategory;
use App\ProductMedia;
use App\Sub;

use App\ProductTranslation;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $langs;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::query()->paginate(10);

        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = $this->langs;
        $categories = ProductCategory::all();
        $subs = Sub::all();

        $cities = City::all();
        $attributes = ProductAttribute::all();


        return view('admin.products.create', [
            'langs' => $langs,
            'categories' => $categories,
            'subs' => $subs,

            'cities' => $cities,
            'attributes' => $attributes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateForm($request);

        $data = new Product();
        $data->product_category_id = $request->cat_id;
        $data->sub_id = $request->sub_id ?? null;

        $data->city_id = $request->city_id;
        $data->code = $request->code;
        $data->price = $request->price;
        $data->meter = $request->meter;
        $data->bedroom = $request->bedroom;
        $data->year_of_construction = $request->year_of_construction;
        $data->slug = $data->slug = SlugService::createSlug(Product::class, 'slug', $request->fa_name);
        $data->save();

        $data->attributes()->attach($request->input('attributes'));

        //store medias
        $image = new ProductMedia();
        $image->product_id = $data->id;
        $image->src = $request->image;
        $image->type = 'cover';
        $image->save();

        if ($request->gallery) {
            foreach ($request->gallery as $key => $media) {
                $id = uniqid();
                $name = $id . '.' . $media->getClientOriginalExtension();

                $path = Storage::disk('public')->putFileAs('products', $media, $name);

                $picture = new ProductMedia();
                $picture->product_id = $data->id;
                $picture->src = 'storage/' . $path;
                $picture->type = 'gallery';
                $picture->flag = $key + 1;
                $picture->save();
            }
        } else {
            return redirect()->back()->withErrors('لطفا تصاویر پروژه را وارد کنید.');
        }


        foreach ($this->langs as $lang) {
            if ($request->input($lang->key . '_name') and $request->input($lang->key . '_description')) {
                $translate = new ProductTranslation();
                $translate->product_id = $data->id;
                $translate->locale = $lang->key;
                $translate->name = $request->input($lang->key . '_name');
                $translate->description = $request->input($lang->key . '_description');
                $translate->save();
            }
        }

        return redirect()->back()->withSuccess(__('messages.createSuccess'));


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $langs = $this->langs;
        $categories = ProductCategory::all();
        $cities = City::all();
        $attributes = ProductAttribute::all();
        $subs = Sub::all();


        $gallery = $product->medias()->where('type', 'gallery')->select('id', 'src')->get();


        $productGallery = [];

        foreach ($gallery as $key => $image) {
            $productGallery[$key] = [
                'id' => $image->id,
                'src' => url('/') . '/' . $image->src
            ];
        }

        return view('admin.products.edit', [
            'product' => $product,
            'langs' => $langs,
            'categories' => $categories,
            'subs' => $subs,

            'cities' => $cities,
            'attributes' => $attributes,
            'productGallery' => $productGallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $this->validateForm($request);

        if ($request->fa_name != $product->translate('fa')->name) {
            $product->slug = SlugService::createSlug(Product::class, 'slug', $request->fa_name);
        }

        $product->product_category_id = $request->cat_id;
        $product->city_id = $request->city_id;
        $product->sub_id = $request->sub_id ?? null;

        $product->code = $request->code;
        $product->price = $request->price;
        $product->meter = $request->meter;
        $product->bedroom = $request->bedroom;
        $product->year_of_construction = $request->year_of_construction;
        $product->save();

        $product->attributes()->sync($request->input('attributes'));

        //store medias
        $coverProduct = $product->medias()->where('type', 'cover')->first();
        if ($request->image != $coverProduct->src) {
            $coverProduct->src = $request->image;
            $coverProduct->save();
        }

        $galleryMedia = $product->medias()->where('type', 'gallery')->get();

        if ($request->preloaded) {
            foreach ($galleryMedia as $value) {
                if (!in_array($value->id, $request->preloaded)) {
                    $value->delete();
                }
            }
        }


        if ($request->gallery) {
            foreach ($request->gallery as $key => $media) {
                $id = uniqid();
                $name = $id . '.' . $media->getClientOriginalExtension();

                $path = Storage::disk('public')->putFileAs('products', $media, $name);

                $picture = new ProductMedia();
                $picture->product_id = $product->id;
                $picture->src = 'storage/' . $path;
                $picture->type = 'gallery';
                $picture->flag = $product->medias()->where('type', 'gallery')->orderByDesc('flag')->first()->flag + 1;
                $picture->save();
            }
        }


        if (!$request->gallery and !$request->preloaded) {
            return redirect()->back()->withErrors('لطفا تصاویر پروژه را وارد کنید.');
        }


        foreach ($this->langs as $lang) {
            $translate = ProductTranslation::where('product_id', $product->id)->where('locale', $lang->key)->first();
            $name = $request->input($lang->key . '_name');
            $description = $request->input($lang->key . '_description');

            if (!empty($translate)) {
                if (empty($name) or empty($description)) {
//                    BlogTranslation::query()->where('blog_id', $blog->id)->where('locale', $lang->key)->delete();
                    $translate->delete();
                } else {
                    $translate->name = $name;
                    $translate->description = $description;
                    $translate->save();
                }
            } elseif (!empty($name) and !empty($description)) {
                $translate = new ProductTranslation();
                $translate->product_id = $product->id;
                $translate->locale = $lang->key;
                $translate->name = $name;
                $translate->body = $description;
                $translate->save();
            }
        }

        return redirect()->back()->withSuccess(__('messages.editSuccess'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Product $product)
//    {
//        ProductTranslation::query()->where('product_id' , $product->id)->delete();
//        $product->medias()->delete();
//        $product->attributes()->delete();
//        $product->delete();
//
//        return redirect()->back()->withSuccess(__('messages.deleteSuccess'));
//    }

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->id);

        ProductTranslation::query()->where('product_id', $product->id)->delete();
        $product->medias()->delete();
        $product->attributes()->delete();
        $product->delete();

        return 'حذف شد';
    }

    public function changeStatus(Product $product)
    {
        if ($product->status == 1) {
            $product->status = 0;
        } else {
            $product->status = 1;
        }
        $product->save();

        return redirect()->back()->withSuccess(__('messages.changeStatusSuccessfully'));
    }


    protected function validateForm($request)
    {
        $val = [
            'city_id' => 'required',
            'cat_id' => 'required',
            'code' => 'required',
            'meter' => 'required',
            'year_of_construction' => 'required',
            'bedroom' => 'required',
        ];

        foreach ($this->langs as $lang) {
            $val = array_merge($val, [$lang->key . '_name' => 'required']);
            $val = array_merge($val, [$lang->key . '_description' => 'required']);
        }
        return $request->validate($val);
    }
}
