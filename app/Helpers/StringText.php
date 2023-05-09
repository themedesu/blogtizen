<?php
namespace App\Helpers;

class StringText
{
    public static function limit(string $text, int $limit)
    {
        $text = strip_tags($text);
        $text = html_entity_decode($text, ENT_QUOTES, "UTF-8");

        if (strlen($text) > $limit) {
            return substr($text, 0, $limit) . '...';
        }
        return $text;
    }

    public static function greeting(string $text)
    {

        $hour = date('G');

        if ($hour >= 5 && $hour <= 11) {
            return "Good Morning" . $text;
        }

        if ($hour >= 12 && $hour <= 18) {
            return "Good Afternoon" . $text;
        }

        if ($hour >= 19 || $hour <= 4) {
            return "Good Evening" . $text;
        }

        return $text;
    }
}
