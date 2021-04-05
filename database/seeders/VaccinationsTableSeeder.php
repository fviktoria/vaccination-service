<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Vaccination;
use Illuminate\Database\Seeder;

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
		$vaccination->maxPatients = 100;
		$vaccination->date = "2021-05-05";
		$vaccination->from = "12:00:00";
		$vaccination->to = "16:00:00";

		$location = Location::all()->first();
		$vaccination->location()->associate($location);

		$vaccination->save();
    }
}
