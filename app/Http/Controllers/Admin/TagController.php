<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\TagArticle;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use View;

class TagController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tag::select('*')->withCount('tagArticles')->orderBy('created_at', 'desc');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return array($row->id, $row->name);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $metaTitle = 'Tag';
        return View::make("pages.admin.tag.index", compact('metaTitle'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.tag.index'))->with('failure', $validator->errors()->first());
        }

        $tag = Tag::create($data);

        return redirect(route('admin.tag.index'))->with('success', 'New tag has been added: ' . $tag->name);
    }

    public function edit($id)
    {
        $metaTitle = 'Edit Tag';
        $tag = Tag::findOrFail($id);
        return View::make("pages.admin.tag.edit", compact('metaTitle', 'tag'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.tag.edit', ['tag' => $id]))->with('failure', $validator->errors()->first());
        }

        $tag = Tag::find($id);
        $tag->update($data);

        return redirect(route('admin.tag.index'))->with('success', 'Tag has been updated');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        try {

            TagArticle::where('tag_id', $tag->id)->delete();
            $tag->delete();

            $data['messages'] = 'Deleted successfully';
            $data['type'] = 'success';

        } catch (\Exception$e) {
            $data['messages'] = $e->getMessage();
            $data['type'] = 'warning';
        }

        return response()->json($data, 200);
    }
}
