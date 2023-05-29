<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $table = 'holiday';

    // protected $primaryKey = 'TGLLIBUR';

    // public $incrementing = false;

    protected $fillable = [
        'event_date',
        'description',
        'multi_code',
    ];

    public function multiplication(){
        return $this->belongsTo(Multiplication::class, 'code', 'multi_code');
    }
}
