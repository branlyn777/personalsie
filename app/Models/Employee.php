<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'ci',
        'name',
        'lastname',
        'genero',
        'dateNac',
        'address',
        'phone',
        'estadoCivil',
        'area_trabajo_id',
        'cargo_id',
        'contrato_id',
        'fechaInicio',
        'image'
    ];
    
    public function getImagenAttribute(){
        if($this-> image != null)
            return(file_exists('storage/products/' . $this->image) ? $this->image : 'noimg.jpg');
        else
            return 'noimg.jpg';
    }

    public function area(){
        return $this->belongsTo(AreaTrabajo::class);
    }

    public function puesto(){
        return $this->belongsTo(PuestoTrabajo::class);
    }

    
}
