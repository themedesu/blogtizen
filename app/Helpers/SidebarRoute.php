<?php
namespace App\Helpers;

use Request;

class SidebarRoute
{
    public static function isActive($location)
    {
        if (!$location) {
            return false;
        }

        if (is_array($location)) {
            for ($loop = 0; $loop < count($location); $loop++) {
                if (request()->is($location[$loop]) || request()->is($location[$loop] . '/*')) {
                    return 'active';
                }
            }
        } else {
            return request()->is($location) || request()->is($location . '/*') ? 'active' : '';
        }
    }

    public static function isOpen($location)
    {
        if (!$location) {
            return false;
        }

        if (is_array($location)) {
            for ($loop = 0; $loop < count($location); $loop++) {
                if (request()->is($location[$loop]) || Request::segment(1) == $location[$loop]) {
                    return 'show';
                }
            }
        }

        return request()->is($location) || Request::segment(1) == $location ? 'show' : '';
    }

    public static function isStabActive(string $location)
    {
        if (!$location) {
            return false;
        }

        return Request::segment(3) == $location ? 'active' : '';
    }
}
