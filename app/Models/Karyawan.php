<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Subdept;
use App\Models\Jabatan;
use App\Models\Shift;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'employee';


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

    public function company(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'dept_id', 'id');
    }

    public function subdept(){
        return $this->belongsTo(Subdept::class, 'subdept_id', 'id');
    }

    public function position(){
        return $this->belongsTo(Jabatan::class, 'position_id', 'id');
    }

    public function shift(){
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }
}
