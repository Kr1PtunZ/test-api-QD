<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = ['title', 'description', 'status', 'deadline'];
    use HasFactory;
    public static function getByDeadline($deadline)
    {
        return Tasks::where('deadline', $deadline)->get();
    }

    public function getByStatus($status)
    {
        return Tasks::where('status', $status)->get();
    }
}
