<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subdept extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'subdepartment';

    protected $fillable = [
        'name',
        'department_id',
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
