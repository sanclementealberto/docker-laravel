<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cita;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'taller',
            'email' => 'taller@example.com',
            'password' => bcrypt('password'),
            'role' => 'taller',
        ]);
    
        $cliente =   User::factory()->create([
            'name' => 'alberto maneiro',
            'email' => 'alberto@example.com',
            'password' => bcrypt('password'),
            'role' => 'cliente',
        ]);
       

        $cliente2=  User::factory()->create([
            'name' => 'batman ',
            'email' => 'batman@example.com',
            'password' => bcrypt('password'),
            'role' => 'cliente',
        ]);



        //ES SOLO Un jemplo para ver como queda con fecha,hora y duracion    
        Cita::factory()->create([
            'user_id' => $cliente->id,
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'matricula' => '1234ABC',
            'fecha' => now()->addDays(3)->format('Y:m:d'), 
            'hora' => now()->addDays(3)->format('H:i:s'),
            'duracion' => '01:00:00',
        ]);

        Cita::factory()->create([
            'user_id' => $cliente->id,
            'marca' => 'citroen',
            'modelo' => 'xsara',
            'matricula' => '1214ABC',
            'fecha' => '',
            'hora' => '',
            'duracion' => '',
        ]);

        Cita::factory()->create([
            'user_id' => $cliente2->id,
            'marca' => 'citroen',
            'modelo' => 'pcasi',
            'matricula' => '1514ABC',
            'fecha' => '',
            'hora' => '',
            'duracion' => '',
        ]);

    }
}
