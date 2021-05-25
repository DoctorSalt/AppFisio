<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fisioterapeuta extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idFisioterapeuta';
    
    use HasFactory;
    protected $casts = [
        'tiempoFisioterapeuta' => 'integer',
    ];
}
