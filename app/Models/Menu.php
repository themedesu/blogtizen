<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'menus';
    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'depth', 'icon', 'target'];

    public static function getNextSortRoot()
    {
        return self::max('sort') + 1;
    }

    public static function getMenu()
    {

        $menus = self::orderBy('sort', 'asc')->get();
        $roots = $menus->where('parent', 0);
        $items = self::tree($roots, $menus);
        return $items;
    }

    private static function tree($items, $menus)
    {
        $data_arr = array();
        $i = 0;
        foreach ($items as $item) {
            $data_arr[$i] = $item->toArray();
            $find = $menus->where('parent', $item->id);

            $data_arr[$i]['child'] = array();

            if ($find->count()) {
                $data_arr[$i]['child'] = self::tree($find, $menus);
            }

            $i++;
        }

        return $data_arr;
    }
}
