<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class PageBuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->admin = auth('admin')->user();
            if (!$this->admin->can('canPageBuilder') and $this->admin->id != 1) {
                abort(404);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $pages = Page::query()->paginate(10);

        return view('admin.pageBuilder.index')->with([
            'pages' => $pages
        ]);
    }

    public function create()
    {
        return view('admin.pageBuilder.create');
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $slug = SlugService::createSlug(Page::class, 'slug', $request->title);
        $request->request->add(['slug' => $slug]);  // Add slug to request->all() "slug: $slug"

        Page::query()->create($request->all());

        return redirect()->back()->withSuccess(__('messages.createSuccess'));
    }

    public function edit(Page $page)
    {
        return view('admin.pageBuilder.edit')->with([
            'page' => $page,
        ]);
    }

    public function update(Request $request, Page $page)
    {
        $this->validateForm($request);

        if ($page->title != $request->title) {
            $slug = SlugService::createSlug(Page::class, 'slug', $request->title); //create slug
            $request->request->add(['slug' => $slug]);  // Add slug to request->all() "slug: $slug"
        }

        $request->show_header = $request->show_header ? $request->request->add(['show_header' => "1"]) : $request->request->add(['show_header' => "0"]);
        $request->show_footer = $request->show_footer ? $request->request->add(['show_footer' => "1"]) : $request->request->add(['show_footer' => "0"]);

        $page->update($request->except('_token'));

        return redirect()->back()->withSuccess(__('messages.editSuccess'));
    }

    public function changestatus(Page $page)
    {
        $page->active = !$page->active;
        $page->save();

        return redirect()->back()->withSuccess(__('messages.changeStatusSuccessfully'));
    }

    public function destroy(Request $request)
    {
        $item = Page::findOrFail($request->id);
        $item->delete();

        return 'حذف شد';
    }


    protected function validateForm($request)
    {
        return $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
    }
}
