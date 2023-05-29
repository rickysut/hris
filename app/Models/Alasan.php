<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alasan extends Model
{
    use HasFactory;

    protected $table = 'leave_code';

    protected $fillable = [
        'code',
        'description',
        'cut_leave',
    ];
}
