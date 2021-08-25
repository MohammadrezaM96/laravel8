<?php

namespace App\Http\Controllers\Admin;

use App\Blogcategory;
use App\Helpers\Upload;
use App\Http\Controllers\Controller;
use App\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function category(Request $request)
    {
        $blogCategories = Blogcategory::
        name($request->query('name'))
            ->active($request->query('status'))
            ->get();

        return view('admin.blog.category' , compact('blogCategories'));
    }

    public function show($id)
    {
        $category = Blogcategory::find($id);
        return view('admin.blog.category_edit', compact('category'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'flag' => 'required | numeric',
        ]);
        $category = Blogcategory::find($id);
        $category->translate('fa')->name = $request->name;
        $category->flag = $request->flag;
        $category->status = $request->status;
        $category->update();
        return redirect(route('admin.blog.category'))->with('success', 'دسته بندی ویرایش شد');


    }

    // delete category
    public function categoryDestroy(Request $request)
    {
        $item = Blogcategory::findOrFail($request->id);

        $item->delete();

        return 'حذف شد';

    }


//    public function delete($id)
//    {
//        $category = Blogcategory::find($id);
//        $category->delete();
//
//        return redirect(route('admin.blog.category'))->with('success', 'دسته بندی حذف شد');
//
//    }

    public function changestatus(Blogcategory $blogcategory)
    {
        if ($blogcategory->status == 1) {
            $blogcategory->status = 0;
        } else {
            $blogcategory->status = 1;
        }

        $blogcategory->save();

        return redirect()->back()->withSuccess(__('messages.changeStatusSuccessfully'));
    }


    public function add()
    {

        return view('admin.blog.category_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'flag' => 'required | numeric',
        ]);
        $category = new Blogcategory();
        $category->getNewTranslation('fa')->name = $request->name;
        $category->flag = $request->flag;
        $category->status = $request->status;
        $category->slug = SlugService::createSlug(Blogcategory::class, 'slug', $request->name);
        $category->save();
        return redirect(route('admin.blog.category'))->with('success', 'دسته بندی اضافه  شد');


    }

    public function posts(Request $request)
    {
        $posts = Post::
        title($request->query('title'))
            ->active($request->query('status'))
            ->paginate($request->query('paginate') ?? 10);;
        return view('admin.blog.post', compact('posts'));
    }

    public function post_show($id)
    {
        $post = Post::find($id);
        return view('admin.blog.show', compact('post'));
    }

    public function post_add()
    {

        return view('admin.blog.add');
    }

    public function post_edit(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'desc' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


        $post = Post::find($id);
        $post->title = $request->title;
        $post->blogcategory_id = $request->category;
        $post->content = $request->desc;
        $post->slug = SlugService::createSlug(Blogcategory::class, 'slug', $request->title);
        $post->view = $request->view;
        if ($request->file('image')) {

            $image = Upload::uploadFile($request->file('image'), 'posts', null);
            $post->image = $image['url'];

        }
        if ($post->update()) {
            return redirect(route('admin.blog.post', $id))->with('success', 'مطلب ویرایش شد');

        } else {
            return redirect()->back()->with('error', 'مشکلی بوجود آمده است');

        }

    }

    public function post_store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'desc' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


        $post = new Post();
        $post->title = $request->title;
        $post->blogcategory_id = $request->category;
        $post->admin_id = Auth::guard('admin')->user()->id;
        $post->content = $request->desc;
        $post->slug = SlugService::createSlug(Blogcategory::class, 'slug', $request->title);
        $post->view = $request->view;
        if ($request->file('image')) {

            $image = Upload::uploadFile($request->file('image'), 'posts', null);
            $post->image = $image['url'];

        }
        if ($post->save()) {
            return redirect(route('admin.blog.post'))->with('success', 'مطلب اضافه شد');

        } else {
            return redirect()->back()->with('error', 'مشکلی بوجود آمده است');

        }

    }

    public function post_delete($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect(route('admin.blog.post'))->with('success', 'مطلب حذف شد');

    }

    public function post_changeStatus(Post $post)
    {
        $post->status = !$post->status;
        $post->save();
        $post->save();

        return redirect()->back()->withSuccess(__('messages.changeStatusSuccessfully'));
    }

    // delete Post
    public function post_destroy(Request $request)
    {
        $item =Post::findOrFail($request->id);

        $item->delete();

        return 'حذف شد';

    }
}
