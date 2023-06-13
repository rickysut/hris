<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monthly extends Model
{
    use HasFactory;

    protected $table = 'absenbulanan';

    protected $fillable = [
            'nik',
            'bulan',
            'harikerja',
            'jamnormal',
            'jamefektif',
            'hadir',
            'hadirkerja',
            'hadirlibur',
            'tidakhadir',
            'haritelat',
            'jamtelat',
            'hariplgcepat',
            'jamplgcepat',
            'lembur',
            'multiplikasi',
            'shift',
            'cuti',
            'mangkir',
            'sakit',
            'tdklengkap',
            'tdklengkapout',
            'dinas',
            'htelat',
            'ismanual',
            'cutihamil',
            'awal',
            'akhir',
            'terlambat60',
            'maskerja',
    ];
}
