<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Language;
use App\ProductCategory;
use App\Sub;

use App\ProductCategoryTranslation;
use App\SubGallery;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    private $langs;


    public function index(Request $request)
    {
        $productCategories = ProductCategory::query()->paginate(15);

        return view('admin.products.categories.index', [
            'productCategories' => $productCategories
        ]);

    }

    public function create()
    {
        $langs = Language::all();

        return view('admin.products.categories.create', [
            'langs' => $langs
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $data = new ProductCategory();

        $data->meta_description = $request->meta_description;
        $data->image = $request->image;
        $data->slug = SlugService::createSlug(ProductCategory::class, 'slug', $request->fa_name);
        //$data->flag = ProductCategory::query()->orderByDesc('flag')->first()->flag + 1;
        $data->save();

        foreach ($this->langs as $lang) {
            if ($request->input($lang->key . '_name')) {
                $translate = new ProductCategoryTranslation();
                $translate->product_category_id = $data->id;
                $translate->locale = $lang->key;
                $translate->name = $request->input($lang->key . '_name');
                $translate->description = $request->input($lang->key . '_description');
                $translate->save();
            }
        }

        return redirect()->back()->withSuccess(__('messages.createSuccess'));
    }

    public function edit(ProductCategory $productCategory, Request $request)
    {
        return view('admin.products.categories.edit', [
            'productCategory' => $productCategory,
            'langs' => $this->langs
        ]);
    }

    public function update(ProductCategory $productCategory, Request $request)
    {
        $this->validateForm($request);


        if ($request->fa_name != $productCategory->translate('fa')->name) {
            $productCategory->slug = SlugService::createSlug(ProductCategory::class, 'slug', $request->fa_name);
        }

        $productCategory->meta_description = $request->meta_description;
        $productCategory->image = $request->image;
        $productCategory->save();

        foreach ($this->langs as $lang) {
            $translate = ProductCategoryTranslation::where('product_category_id', $productCategory->id)->where('locale', $lang->key)->first();
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
                $translate = new ProductCategoryTranslation();
                $translate->product_category_id = $productCategory->id;
                $translate->locale = $lang->key;
                $translate->name = $name;
                $translate->description = $description;
                $translate->save();
            }
        }

        return redirect()->back()->withSuccess(__('messages.editSuccess'));

    }

    protected function validateForm($request)
    {
        $val = [
            'meta_description' => 'required',
            'image' => 'required',
        ];

        foreach ($this->langs as $lang) {
            $val = array_merge($val, [$lang->key . '_name' => 'required']);
            $val = array_merge($val, [$lang->key . '_description' => 'required']);
        }
        return $request->validate($val);
    }

    public function changeStatus(ProductCategory $productCategory)
    {
        if ($productCategory->status == 1) {
            $productCategory->status = 0;
        } else {
            $productCategory->status = 1;
        }
        $productCategory->save();

        return redirect()->back()->withSuccess(__('messages.changeStatusSuccessfully'));
    }


    //Ajax Functions For Video
    public function fastEdit(ProductCategory $productCategory, Request $request)
    {
        $productCategory[$request->name] = $request->value;
        $productCategory->save();

        return 'Change Details SuccessFully';
    }


    // delete category
    public function destroy(Request $request)
    {
        $item = ProductCategory::findOrFail($request->id);

        $item->delete();

        return 'حذف شد';

    }


    public function sub(Request $request)
    {
        $subs = Sub::query()->paginate(40);

        return view('admin.categories.sub', [
            'subs' => $subs
        ]);

    }

    public function sub_create(Request $request)
    {

        return view('admin.categories.subCreate');

    }

    public function sub_edit(Request $request, $id)
    {
        $sub = Sub::find($id);

//        $gallery = $sub->medias()->where('type', 'gallery')->select('id', 'src')->get();


//        $subGallery = [];
//
//        foreach ($gallery as $key => $image) {
//            $subGallery[$key] = [
//                'id' => $image->id,
//                'src' => url('/') . '/' . $image->src
//            ];
//        }
        return view('admin.categories.subEdit')->with([
            'sub' => $sub,
//            'subGallery' => $subGallery
        ]);

    }

    public function sub_store(Request $request)
    {
        $data = new Sub();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->product_category_id = $request->product_category_id;
        $data->slug = SlugService::createSlug(Sub::class, 'slug', $request->name);

        $data->image = $request->image;
        $data->save();

//
//        if ($request->gallery) {
//            foreach ($request->gallery as $key => $media) {
//                $id = uniqid();
//                $name = $id . '.' . $media->getClientOriginalExtension();
//
//                $path = Storage::disk('public')->putFileAs('subs', $media, $name);
//
//                $picture = new SubGallery();
//                $picture->sub_id = $data->id;
//                $picture->src = 'storage/' . $path;
//                $picture->type = 'gallery';
//                $picture->flag = $key + 1;
//                $picture->save();
//            }
//        }else{
//            return redirect()->back()->withErrors('لطفا تصاویر پروژه را وارد کنید.');
//        }

        return redirect()->back()->withSuccess(__('messages.createSuccess'));

    }

    public function sub_update(Request $request, $id)
    {

        $sub = Sub::find($id);
        $sub->name = $request->name;
        $sub->description = $request->description;
        $sub->product_category_id = $request->product_category_id;
        $sub->slug = SlugService::createSlug(Sub::class, 'slug', $request->name);

        $sub->image = $request->image;
        $sub->update();



//        if ($request->gallery) {
//            foreach ($request->gallery as $key => $media) {
//                $id = uniqid();
//                $name = $id . '.' . $media->getClientOriginalExtension();
//
//                $path = Storage::disk('public')->putFileAs('subs', $media, $name);
//
//                $picture = new SubGallery();
//                $picture->sub_id = $sub->id;
//                $picture->src = 'storage/' . $path;
//                $picture->type = 'gallery';
//                $picture->flag = $sub->medias()->where('type', 'gallery')->orderByDesc('flag')->first()->flag + 1;
//                $picture->save();
//            }
//        }else{
//            return redirect()->back()->withErrors('لطفا تصاویر پروژه را وارد کنید.');
//        }

        return redirect()->back()->withSuccess(__('messages.createSuccess'));

    }

    // delete sub
    public function sub_destroy(Request $request)
    {
        $item = Sub::findOrFail($request->id);

        $item->delete();

        return 'حذف شد';

    }

}
