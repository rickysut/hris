<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alasan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'leave_code';

    protected $fillable = [
        'code',
        'description',
        'cut_leave',
    ];
}
