<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absensi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'attendance';

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'in',
        'out',
        'breakin',
        'breakout',
    ];

    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }
}
