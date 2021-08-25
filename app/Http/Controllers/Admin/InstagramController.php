<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\InstagramPost;
use Illuminate\Http\Request;

class InstagramController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->admin = auth('admin')->user();
            if (!$this->admin->can('canInstagram') and $this->admin->id != 1) {
                abort(404);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $posts = InstagramPost::query()->paginate(10);

        return view('admin.instagram.index')->with([
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('admin.instagram.create');
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

//        $slug = SlugService::createSlug(Page::class, 'slug', $request->title);
//        $request->request->add(['slug' => $slug]);  // Add slug to request->all() "slug: $slug"

        InstagramPost::query()->create($request->except('_token'));

        return redirect()->back()->withSuccess(__('messages.createSuccess'));
    }

    public function edit(InstagramPost $instagramPost)
    {
        return view('admin.instagram.edit')->with([
            'post' => $instagramPost,
        ]);
    }

    public function update(Request $request, InstagramPost $instagramPost)
    {
        $this->validateForm($request);

//        if ($page->title != $request->title) {
//            $slug = SlugService::createSlug(Page::class, 'slug', $request->title); //create slug
//            $request->request->add(['slug' => $slug]);  // Add slug to request->all() "slug: $slug"
//        }

        $request->is_video = $request->is_video ? $request->request->add(['is_video' => "1"]) : $request->request->add(['is_video' => "0"]);

        $instagramPost->update($request->except('_token'));

        return redirect()->back()->withSuccess(__('messages.editSuccess'));
    }

    public function destroy(Request $request)
    {
        $item = InstagramPost::findOrFail($request->id);
        $item->delete();

        return 'حذف شد';
    }


    protected function validateForm($request)
    {
        return $request->validate([
            'post_link' => 'required',
            'image_link' => 'required'
        ]);
    }
}
