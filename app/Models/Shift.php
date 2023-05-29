<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shift';

    protected $fillable = [
        'IDShift',
        'NamaShift',
        'Awal',
        'Akhir',
        'Awal2',
        'Akhir2',
        'isTshift',
        'Istirahat',
        'BreakLembur',
        'BatasBreak',
        'BreakOut',
        'BreakIn',
    ];
}
