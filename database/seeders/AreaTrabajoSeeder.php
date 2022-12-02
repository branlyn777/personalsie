<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AreaTrabajo;

class AreaTrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AreaTrabajo::create([
            //1
            'nameArea' => 'Administrativa',
            'descriptionArea' => 'Admin',
        ]);
        AreaTrabajo::create([
            //2
            'nameArea' => 'Servicios',
            'descriptionArea' => 'Serv',
        ]);
        AreaTrabajo::create([
            //3
            'nameArea' => 'Sistemas',
            'descriptionArea' => 'Sist',
        ]);
        AreaTrabajo::create([
            //3
            'nameArea' => 'Ventas',
            'descriptionArea' => 'Vent',
        ]);
    }
}
