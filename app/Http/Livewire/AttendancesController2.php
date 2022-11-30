<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AttendancesController2 extends Component
{
    public function render()
    {
        $mmm = "";
        return view('livewire.attendances.attendances2',[
            'mmm' => $mmm,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
        
    }
}
