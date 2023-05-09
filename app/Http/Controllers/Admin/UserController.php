<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use View;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = User::select('*')->orderBy('level', 'ASC')->orderBy('created_at', 'ASC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return array($row->id, $row->name);
                })
                ->addColumn('level', function ($row) {
                    switch ($row->level) {
                        case 1:
                            return 'SuperAdmin';
                            break;
                        case 2:
                            return 'Admin';
                            break;
                        default:
                            return 'NULL';
                            break;
                    }
                })
                ->rawColumns(['level', 'action'])
                ->make(true);
        }
        $metaTitle = 'User';
        return View::make("pages.admin.user.index", compact('metaTitle'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:50',
            'password' => 'required|min:6|confirmed',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (User::whereEmail($value)->count() > 0) {
                        $fail($attribute . ' telah digunakan.');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.super.user.index'))->with('failure', $validator->errors()->first());
        }

        $data['password'] = bcrypt($request->password);
        $user = User::create($data);

        return redirect(route('admin.super.user.index'))->with('success', 'New user added successfully: ' . $user->name);
    }

    public function edit($id)
    {
        $metaTitle = 'Edit User';
        $user = User::findOrFail($id);
        return View::make("pages.admin.user.edit", compact('metaTitle', 'user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:50',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) use ($id) {
                    if (User::withTrashed()->where('id', '!=', $id)->whereEmail($value)->count() > 0) {
                        $fail($attribute . ' already used');
                    }
                },
            ],
            'password_new' => 'nullable|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.super.user.edit', ['user' => $id]))->with('failure', $validator->errors()->first());
        }

        $user = User::find($id);

        if (!empty($request->password_new)) {
            $data['password'] = bcrypt($request->password_new);
        }

        $user->update($data);

        return redirect(route('admin.super.user.edit', ['user' => $user->id]))->with('success', 'User successfully modified');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        try {
            if (Auth::user()->id == $user->id) {
                throw new \Exception("Unable to perform deletion");
            }
            Article::where('author_id', $user->id)->delete();
            $user->delete();
            $data['messages'] = 'Deleted successfully';
            $data['type'] = 'success';
        } catch (\Exception$e) {
            $data['messages'] = $e->getMessage();
            $data['type'] = 'warning';
        }

        return response()->json($data, 200);
    }
}
