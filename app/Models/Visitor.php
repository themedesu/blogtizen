<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $table = 'visitors';
    protected $fillable = ['method', 'request', 'url', 'referer', 'languages', 'useragent', 'headers', 'device', 'platform', 'browser', 'ip', 'visitable_type', 'visitable_id', 'visitor_type', 'visitor_id'];

    public function scopeToday($query)
    {
        return $query->whereDay('created_at', date('d'))->count();
    }

    public function scopeYesterday($query)
    {
        $yesterday = date("Y-m-d", strtotime('-1 days'));
        return $query->whereDate('created_at', $yesterday)->count();
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', date('m'))->count();
    }

    public function scopeThisYear($query)
    {
        return $query->whereYear('created_at', date('Y'))->count();
    }

    public function scopeTotal($query)
    {
        return $query->count();
    }
}
