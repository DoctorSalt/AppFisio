<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cita extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idCita';

    use HasFactory;
}