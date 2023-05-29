<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'shift';

    protected $fillable = [
        'code',
        'name',
        'start',
        'stop',
        'use_break',
        'breakstart',
        'breakstop',
    ];
}
