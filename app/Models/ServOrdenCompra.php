<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServOrdenCompra extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','movimiento_id','idcomprador','estado','status'];
}
