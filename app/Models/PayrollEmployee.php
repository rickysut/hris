<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayrollEmployee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'payroll_employees';

    protected $fillable = [
        'employee_id',
        'setup_payroll_id',
        'gaji_pokok',
        'bank',
        'rekening',
        'account_name',
        'cara_bayar',
        'duration',

    ];

    public function employee(){
        return $this->belongsTo(Karyawan::class, 'employee_id', 'id');
    }

    public function setup(){
        return $this->belongsTo(SetupPayroll::class, 'setup_payroll_id', 'id');
    }
}
