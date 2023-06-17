<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SetupPayroll extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'setup_payroll';


    protected $fillable = [
        'name',
        't_masakerja',
        't_uangmakan',
        'tjtt',
        't_bensin',
        't_team',
        'bpjs_kes',
        'bpjs_naker',
        'pot_lain',
    ];
}
