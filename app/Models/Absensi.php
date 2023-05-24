<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $primaryKey = 'PIN';

    public $incrementing = false;

    protected $fillable = [
        'PIN',
        'tanggal',
        'masuk',
        'pulang',
        'jamefektif',
        'Terlambat',
        'idShift',
        'isLibur',
        'isSabtu',
        'isSabtu',
    ];
}
