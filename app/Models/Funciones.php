<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funciones extends Model
{
    use HasFactory;
    protected $fillable = ['nameFuncion','descripcion','cargo_id'];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
