<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    use HasFactory;
    protected $fillable = ['empleado_id', 'fecha', 'motivo', 'comprobante'];

    public function getImagenAttribute(){
        if($this-> comprobante != null)
            return(file_exists('storage/assistances/' . $this->comprobante) ? $this->comprobante : 'noimg.jpg');
        else
            return 'noimg.jpg';
    }

    // public function getImagenAttribute()
    // {
    //     if ($this->comprobante == null) {
    //         return 'noimage.jpg';
    //     }
    //     if (file_exists('storage/assistances/' . $this->comprobante))
    //         return $this->comprobante;
    //     else {
    //         return 'noimage.jpg';
    //     }
    // }
}
