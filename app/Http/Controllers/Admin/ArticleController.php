<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use App\Models\TagArticle;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use View;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Article::select('*')->with([
                'tagArticles' => function ($query) {
                    $query->with('tag');
                },
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
        $metaTitle = 'Article';
        return View::make("pages.admin.article.index", compact('metaTitle'));
    }

    public function create()
    {
        $metaTitle = 'Add Article';
        $tags = Tag::all();
        return View::make("pages.admin.article.create", compact('metaTitle', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|string|max:120',
            'content' => 'required',
            'description' => 'nullable|string|max:125',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.article.index'))->with('failure', $validator->errors()->first());
        }

        if ($request->thumbnail) {
            $imagePath = $request->file('thumbnail');
            $imageName = time() . '-' . Str::random(20) . '.' . $imagePath->getClientOriginalExtension();
            $storagePath = $request->file('thumbnail')->storeAs('thumbnail', $imageName, 'public');
            $data['thumbnail'] = $storagePath;
        }

        $data['author_id'] = Auth::user()->id;

        $article = Article::create($data);

        if (isset($request->tags) || $request->tags != '') {
            $tags = $request->tags;
            foreach ($tags as $key => $tag) {
                $tagArticle['tag_id'] = $tags[$key];
                $tagArticle['article_id'] = $article->id;
                TagArticle::create($tagArticle);
            }
        }

        return redirect(route('admin.article.index'))->with('success', 'New article has been published: ' . $article->name);
    }

    public function edit($id)
    {
        $metaTitle = 'Edit Article';
        $article = Article::findOrFail($id);
        $tags = Tag::all();
        return View::make("pages.admin.article.edit", compact('metaTitle', 'article', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required|string|max:120',
            'content' => 'required',
            'description' => 'nullable|string|max:125',
            'thumbnail_is_updated' => 'nullable',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.article.edit', ['article' => $id]))->with('failure', $validator->errors()->first());
        }

        $article = Article::find($id);

        if ($request->thumbnail_is_updated) {
            if ($request->thumbnail) {
                $imagePath = $request->file('thumbnail');
                $imageName = time() . '-' . Str::random(20) . '.' . $imagePath->getClientOriginalExtension();
                $storagePath = $request->file('thumbnail')->storeAs('thumbnail', $imageName, 'public');
            } else {
                $storagePath = null;
            }
            $data['thumbnail'] = $storagePath;
        }

        $article->update($data);

        TagArticle::where('article_id', $article->id)->forceDelete();

        if (isset($request->tags) || $request->tags != '') {
            $tags = $request->tags;
            foreach ($tags as $key => $tag) {
                $tagArticle['tag_id'] = $tags[$key];
                $tagArticle['article_id'] = $article->id;
                TagArticle::create($tagArticle);
            }
        }

        return redirect(route('admin.article.edit', ['article' => $article->id]))->with('success', 'Article has been updated');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        try {

            TagArticle::where('article_id', $article->id)->delete();
            $article->delete();

            $data['messages'] = 'Deleted successfully';
            $data['type'] = 'success';

        } catch (\Exception $e) {
            $data['messages'] = $e->getMessage();
            $data['type'] = 'warning';
        }

        return response()->json($data, 200);
    }
}
