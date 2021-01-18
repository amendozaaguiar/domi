<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    //Seeder de la tabla de agendas
    public function run()
    {
        $this->call([
            ScheduleSeeder::class
        ]);
    }
}
