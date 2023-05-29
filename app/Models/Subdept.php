<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subdept extends Model
{
    use HasFactory;

    protected $table = 'subdepartment';

    protected $fillable = [
        'name',
        'dep_id',
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'dep_id', 'id');
    }
}
