<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holiday extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'holiday';

    protected $fillable = [
        'event_date',
        'description',
        'multi_code',
    ];

    public function multiplication(){
        return $this->belongsTo(Multiplication::class, 'multi_code', 'id');
    }
}
