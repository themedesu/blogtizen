<?php
namespace App\Helpers;

use DateTime;

class Converter
{
    public static function dateFormat(string $format, $date)
    {
        if (!$format || !$date) {
            return false;
        }

        $dateChanged = new DateTime($date);
        return $dateChanged->format($format);
    }

    public static function dateRange(string $format, $dateFrom, $dateTo)
    {
        if (!$format || !$dateFrom || !$dateTo) {
            return false;
        }

        $dateTimeFrom = new DateTime($dateFrom);
        $dateTimeTo = new DateTime($dateTo);
        $interval = $dateTimeFrom->diff($dateTimeTo);
        return $interval->format($format);
    }

    public static function ageCalculation($birthOfDate)
    {
        if (!$birthOfDate) {
            return false;
        }

        $birthDate = explode("-", $birthOfDate);

        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));

        return $age;
    }

    public static function timeFormat($format, $time)
    {
        if (!$format || !$time) {
            return false;
        }

        return gmdate($format, $time);
    }
}
