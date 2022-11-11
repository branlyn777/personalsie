<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funciones extends Model
{
    use HasFactory;
    protected $fillable = ['nameFuncion','cargo_id'];

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
