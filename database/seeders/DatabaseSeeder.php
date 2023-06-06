<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Role::factory()->create([
            'role' => 'Admin',
        ]);
        \App\Models\Role::factory()->create([
            'role' => 'Doctor',
        ]);
        \App\Models\Role::factory()->create([
            'role' => 'Patient',
        ]);


        \App\Models\User::factory()->create([
            'name' => 'Mero Hospital',
            'email' => 'hospital@gmail.com',
            'role_id' => 1,
        ]);

        for ($i=0; $i < 5 ; $i++) { 

            $user = \App\Models\User::factory(1)->create([
                'role_id' => 2
            ]);

            \App\Models\Doctor::factory(1)->create([
                'doctor_id' => $user[0]->id,
            ]);
            
        }
        for ($i=0; $i < 5 ; $i++) { 

            $user = \App\Models\User::factory(1)->create([
                'role_id' => 3
            ]);

            \App\Models\Patient::factory(1)->create([
                'patient_id' => $user[0]->id,
            ]);
            
        }
        
    }
}
