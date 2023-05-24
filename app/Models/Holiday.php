<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $table = 'harilibur';

    protected $primaryKey = 'TGLLIBUR';

    public $incrementing = false;

    protected $fillable = [
        'TGLLIBUR',
        'KETERANGAN',
        'KDLEMBUR',
    ];

    public function kode(){
        return $this->belongsTo(Multiplication::class, 'KDLEMBUR', 'KDLEMBUR');
    }
}
