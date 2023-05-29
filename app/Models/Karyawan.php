<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'employee';

    // protected $primaryKey = 'PIN';

    // public $incrementing = false;

    protected $fillable = [
        'pin',
        'nik',
        'name',
        'start_date',
        'end_date',
        'active',
        'company_id',
        'branch_id',
        'dept_id',
        'position_id',
        'subdept_id',
        'shift_id',

    ];
}
