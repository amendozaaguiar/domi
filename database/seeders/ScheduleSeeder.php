<?php

namespace Database\Seeders;

use App\Models\Schedule;
use DateTime;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = new DateTime('08:00:00');

        do
        {
            $schedule = new Schedule;
                $schedule->time = $time->format('H:i:s');
                $schedule->maximum_allocation = 8;
                $schedule->allocations = 0;
            $schedule->save();

            $time->modify('+30 minute');

        }while($time->format('H:i:s') <= '20:00:00');
    }
}
