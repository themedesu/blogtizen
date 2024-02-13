<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use View;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $metaTitle = 'Menu';
        $menus = Menu::getMenu();
        return View::make("pages.admin.menu.index", compact('metaTitle', 'menus'));
    }

    public function create(Request $request)
    {
        if ($request->has('data')) {
            foreach ($request->post('data') as $key => $value) {
                $menu = new Menu();
                $menu->label = $value['label'];
                $menu->link = $value['url'];
                $menu->icon = $value['icon'];
                $menu->sort = Menu::getNextSortRoot();
                $menu->save();
            }
        }
        return response()->json(['text' => 'Menu added successfully. Wait a few moments for it to reload', 'type' => 'success'], 200);
    }

    public function update(Request $request)
    {
        $dataItem = $request->input('dataItem');
        if (is_array($dataItem)) {
            foreach ($dataItem as $value) {
                $menu = Menu::findOrFail($value['id']);
                $menu->label = $value['label'];
                $menu->link = $value['link'];
                $menu->class = $value['class'];
                $menu->icon = $value['icon'];
                $menu->target = $value['target'];
                $menu->save();
            }
        } else {
            $menu = Menu::findOrFail($request->input('id'));
            $menu->label = $request->input('label');
            $menu->link = $request->input('url');
            $menu->class = $request->input('clases');
            $menu->icon = $request->input('icon');
            $menu->target = $request->input('target');
            $menu->save();
        }
        return response()->json(['text' => 'Menu updated successfully', 'type' => 'success'], 200);
    }

    public function actualizar(Request $request)
    {
        if (is_array($request->input('data'))) {
            foreach ($request->input('data') as $key => $value) {
                $menu = Menu::findOrFail($value['id']);
                $menu->parent = $value['parent_id'] ?? 0;
                $menu->sort = $key;
                $menu->depth = $value['depth'] ?? 1;
                $menu->save();
            }
        }

        return response()->json(['text' => 'Menu order updated successfully', 'type' => 'success'], 200);
    }

    public function destroy(Request $request)
    {
        $menu = Menu::findOrFail($request->input('id'));
        $menu->delete();
        return response()->json(['text' => 'Menu deleted successfully. Wait a few moments for it to reload', 'type' => 'success'], 200);
    }
}
