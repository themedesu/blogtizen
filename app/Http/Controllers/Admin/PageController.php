<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Tag;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use View;

class PageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Page::select('*')->with([
                'author',
            ])->orderBy('created_at', 'DESC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('author', function ($row) {
                    return $row->author->name;
                })
                ->addColumn('time', function ($row) {
                    return array($row->created_at, $row->updated_at);
                })
                ->addColumn('action', function ($row) {
                    return array($row->id, $row->title_slice, $row->url);
                })
                ->rawColumns(['author', 'time', 'action'])

                ->make(true);
        }
        $metaTitle = 'Page';
        return View::make("pages.admin.page.index", compact('metaTitle'));
    }

    public function create()
    {
        $metaTitle = 'Add Page';
        $tags = Tag::all();
        return View::make("pages.admin.page.create", compact('metaTitle', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|string|max:120',
            'content' => 'required',
            'description' => 'nullable|string|max:125',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.page.index'))->with('failure', $validator->errors()->first());
        }

        $data['author_id'] = Auth::user()->id;

        $page = Page::create($data);

        return redirect(route('admin.page.index'))->with('success', 'New page published successfully: ' . $page->title_slice);
    }

    public function edit($id)
    {
        $metaTitle = 'Edit Page';
        $page = Page::findOrFail($id);
        return View::make("pages.admin.page.edit", compact('metaTitle', 'page'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|string|max:120',
            'content' => 'required',
            'description' => 'nullable|string|max:125',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.page.edit', ['page' => $id]))->with('failure', $validator->errors()->first());
        }

        $page = Page::find($id);

        $page->update($data);

        return redirect(route('admin.page.edit', ['page' => $page->id]))->with('success', 'The page has been successfully modified');
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        try {

            $page->delete();

            $data['messages'] = 'Deleted successfully.';
            $data['type'] = 'success';

        } catch (\Exception$e) {
            $data['messages'] = $e->getMessage();
            $data['type'] = 'warning';
        }

        return response()->json($data, 200);
    }
}
