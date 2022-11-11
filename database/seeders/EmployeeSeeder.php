<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;
use App\Models\UserEmployee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clever = Employee::create([
            'ci' => 9406795,
            'name' => 'Clever',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);

        UserEmployee::create([
            'user_id' => 25,
            'employee_id' => $clever->id
        ]);



        $luis = Employee::create([
            'ci' => 5173226,
            'name' => 'Luis',
            'lastname' => 'Sandoval',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);

        UserEmployee::create([
            'user_id' => 5,
            'employee_id' => $luis->id
        ]);



        $edwin = Employee::create([
            'ci' => 8037861,
            'name' => 'Edwin',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 1,
            'cargo_id' => 2,
            // //'contrato_id' => 2,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);

        UserEmployee::create([
            'user_id' => 24,
            'employee_id' => $edwin->id
        ]);


        $rosa = Employee::create([
            'ci' => 3,
            'name' => 'Rosa',
            'lastname' => 'Ortiz',
            'genero' => 'Femenino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 1,
            'cargo_id' => 5,
            // //'contrato_id' => 6,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 26,
            'employee_id' => $rosa->id
        ]);




        $mau = Employee::create([
            'ci' => 9326584,
            'name' => 'Mauricio',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 2,
            'cargo_id' => 8,
            // //'contrato_id' => 14,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 21,
            'employee_id' => $mau->id
        ]);


        $Andrews = Employee::create([
            'ci' => 4,
            'name' => 'Jhonn',
            'lastname' => 'Andrews',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 1,
            'cargo_id' => 6,
            // //'contrato_id' => 7,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 30,
            'employee_id' => $Andrews->id
        ]);




        $gery = Employee::create([
            'ci' => 7993972,
            'name' => 'Gery',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 2,
            'cargo_id' => 10,
            // //'contrato_id' => 11,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 15,
            'employee_id' => $gery->id
        ]);






        $gustavo = Employee::create([
            'ci' => 12552162,
            'name' => 'Gustavo',
            'lastname' => 'Quisbert Ventura',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 2,
            'cargo_id' => 11,
            // //'contrato_id' => 12,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 18,
            'employee_id' => $gustavo->id
        ]);



        $enzo = Employee::create([
            'ci' => 14263548,
            'name' => 'Enzo',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 2,
            'cargo_id' => 8,
            ////'contrato_id' => 18,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 16,
            'employee_id' => $enzo->id
        ]);




        $angel = Employee::create([
            'ci' => 8697768,
            'name' => 'Angel',
            'lastname' => 'Becerra',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 1,
            'cargo_id' => 4,
            ////'contrato_id' => 5,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 36,
            'employee_id' => $angel->id
        ]);



        $roger = Employee::create([
            'ci' => 8770492,
            'name' => 'Roger',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 2,
            'cargo_id' => 9,
            ////'contrato_id' => 10,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 17,
            'employee_id' => $roger->id
        ]);





        $ernesto = Employee::create([
            'ci' => 11267379,
            'name' => 'Ernesto',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 2,
            'cargo_id' => 7,
            ////'contrato_id' => 8,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 17,
            'employee_id' => $ernesto->id
        ]);






        $armando = Employee::create([
            'ci' => 7046351,
            'name' => 'Armando',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 1,
            'cargo_id' => 3,
            ////'contrato_id' => 4,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 31,
            'employee_id' => $armando->id
        ]);







        $garey = Employee::create([
            'ci' => 7952877,
            'name' => 'Luis',
            'lastname' => 'Garey',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        // UserEmployee::create([
        //     'user_id' => 31,
        //     'employee_id' => $garey->id
        // ]);






        $yasmin = Employee::create([
            'ci' => 5913978,
            'name' => 'Yazmin',
            'lastname' => 'null',
            'genero' => 'Femenino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 1,
            'cargo_id' => 2,
            ////'contrato_id' => 3,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 27,
            'employee_id' => $yasmin->id
        ]);





        $jose = Employee::create([
            'ci' => 7928401,
            'name' => 'Jose',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        // UserEmployee::create([
        //     'user_id' => 27,
        //     'employee_id' => $jose->id
        // ]);




        $pablo = Employee::create([
            'id' => 5733161,
            'ci' => 5733161,
            'name' => 'Pablo',
            'lastname' => 'Sandoval',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        // UserEmployee::create([
        //     'user_id' => 27,
        //     'employee_id' => $pablo->id
        // ]);



        $roscio = Employee::create([
            'ci' => 9399947,
            'name' => 'Roscio',
            'lastname' => 'null',
            'genero' => 'Femenino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 2,
            'cargo_id' => 13,
            //'contrato_id' => 17,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);

        $roscio = User::create([
            'name' => "Roscio",
            'phone' => 9399947,
            'email' => 'roscio@gmail.com',
            'profile' => 'null',
            'password' => bcrypt("123")
        ]);
        UserEmployee::create([
            'user_id' => $roscio->id,
            'employee_id' => $pablo->id
        ]);




        $Branlyn = Employee::create([
            'ci' => 8693177,
            'name' => 'Branlyn',
            'lastname' => 'Mamani',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 2,
            'cargo_id' => 13,
            //'contrato_id' => 16,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        $roscio = User::create([
            'name' => "Branlyn",
            'phone' => 9399947,
            'email' => 'branlyn@gmail.com',
            'profile' => 'null',
            'password' => bcrypt("123")
        ]);
        UserEmployee::create([
            'user_id' => $roscio->id,
            'employee_id' => $Branlyn->id
        ]);





        $fabio = Employee::create([
            'ci' => 7861796,
            'name' => 'Fabio',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 2,
            'cargo_id' => 8,
            //'contrato_id' => 9,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 10,
            'employee_id' => $fabio->id
        ]);




        $samuel = Employee::create([
            'ci' => 8710140,
            'name' => 'Samuel',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 23,
            'employee_id' => $samuel->id
        ]);




        $isaias = Employee::create([
            'ci' => 1,
            'name' => 'Isaias',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 22,
            'employee_id' => $isaias->id
        ]);




        $ruben = Employee::create([
            'ci' => 7861830,
            'name' => 'Ruben',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 28,
            'employee_id' => $ruben->id
        ]);




        Employee::create([
            'id' => 11066520,
            'ci' => 11066520,
            'name' => 'Victor',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);






        Employee::create([
            'ci' => 7979938,
            'name' => 'Alex',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        




        Employee::create([
            'id' => 13750109,
            'ci' => 13750109,
            'name' => 'Abigail',
            'lastname' => 'null',
            'genero' => 'Femenino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);




        Employee::create([
            'ci' => 7964268,
            'name' => 'Sahian',
            'lastname' => 'null',
            'genero' => 'Femenino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        Employee::create([
            'ci' => 7238748,
            'name' => 'Brian',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        $vania = Employee::create([
            'ci' => 12681711,
            'name' => 'Vania',
            'lastname' => 'null',
            'genero' => 'Femenino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        
        UserEmployee::create([
            'user_id' => 19,
            'employee_id' => $vania->id
        ]);




        Employee::create([
            'ci' => 13749839,
            'name' => 'Joshua',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 2,
            'cargo_id' => 12,
            //'contrato_id' => 15,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        



        Employee::create([
            'ci' => 8848153,
            'name' => 'Osman',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);

        Employee::create([
            'ci' => 7603856,
            'name' => 'Ricardo',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        Employee::create([
            'ci' => 9395042,
            'name' => 'Liz',
            'lastname' => 'null',
            'genero' => 'Femenino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        $luis = Employee::create([
            'ci' => 14419459,
            'name' => 'Luis F',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 14,
            'employee_id' => $luis->id
        ]);




        Employee::create([
            'ci' => 7962772,
            'name' => 'Crismar',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        Employee::create([
            'ci' => 5224381,
            'name' => 'Ever',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        Employee::create([
            'ci' => 8709868,
            'name' => 'Deymar',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        Employee::create([
            'ci' => 13895986,
            'name' => 'Estibem',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        $andres = Employee::create([
            'ci' => 7936142,
            'name' => 'Andres',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        UserEmployee::create([
            'user_id' => 7,
            'employee_id' => $andres->id
        ]);

        Employee::create([
            'ci' => 7330292,
            'name' => 'Diana',
            'lastname' => 'null',
            'genero' => 'Femenino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
       
        Employee::create([
            'ci' => 4386719,
            'name' => 'Veronica',
            'lastname' => 'null',
            'genero' => 'Femenino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        Employee::create([
            'ci' => 8694359,
            'name' => 'Felix',
            'lastname' => 'Mamani',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        Employee::create([
            'ci' => 4527202,
            'name' => 'Paolo',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 3,
            'cargo_id' => 14,
            // //'contrato_id' => 1,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        $nadir = Employee::create([
            'ci' => 2,
            'name' => 'Nadir',
            'lastname' => 'null',
            'genero' => 'Masculino',
            'dateNac' => '0000-00-00 00:00:00',
            'address' => 'Cochabamaba',
            'phone' => '77777778',
            'estadoCivil' => 'Soltero',
            'area_trabajo_id' => 2,
            'cargo_id' => 8,
            ////'contrato_id' => 13,
            //'fechaInicio' => '2022-01-01 01:01:01',
            'image' => '6328d2231e599_.webp',
        ]);
        
        UserEmployee::create([
            'user_id' => 11,
            'employee_id' => $nadir->id
        ]);

        
    }
}
