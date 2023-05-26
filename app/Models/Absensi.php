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
        'jadwalmasuk',
        'jadwalpulang',
        'masuk',
        'IstirahatIn',
        'IstirahatOut',
        'pulang',
        'lembur',
        'TotalLembur',
        'jamefektif',
        'Terlambat',
        'PulangAwal',
        'durasiBreak',
        'Masuk3',
        'Pulang3',
        'Masuk2',
        'Pulang2',
        'isManual',
        'idShift',
        'keterangan',
        'isLibur',
        'isSabtu',
        'isMulai',
        'isLembur',
        'isHadir',
        'isTelat',
        'isKalkulasi',
        'noSPL',
        'Alasan',
        'kodearea',
        'LemburMasuk',
        'LemburPulang',
        'isedit',
        'lastedit',
        'tunjangan',
        'LemburMasuk2',
        'LemburPulang2',
        'KODE',
        'isPulangAwal',
        'Shift',
        'TShift',
        'Makan',
        'Transport',
        'Holiday',
        'Lembur1',
        'Lembur2',
        'isEditLembur',
        'KetLembur',
        'isImport',
        'BreakLembur',
        'PotongCuti',
        'JamNormal',
        'cuti'
    ];

    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'PIN', 'PIN');
    }
}
