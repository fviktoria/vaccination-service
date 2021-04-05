<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Vaccination;
use Illuminate\Database\Seeder;
use DateTime;

class VaccinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$vaccination = new Vaccination();
		$vaccination->maxPatients = 10;
		$vaccination->date = new DateTime("2021-05-05");
		$vaccination->from = new DateTime("12:00:00");
		$vaccination->to = new DateTime("13:00:00");

		$location = Location::all()->first();
		$vaccination->location()->associate($location);

		$vaccination->save();
    }
}
