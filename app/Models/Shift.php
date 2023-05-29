<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shift';

    protected $fillable = [
        'code',
        'name',
        'start',
        'stop',
        'use_break',
        'breakstart',
        'breakstop',
        'shift_id',
    ];
}
