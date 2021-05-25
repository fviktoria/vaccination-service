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
		$vaccination->from = "12:00:00";
		$vaccination->to = "13:00:00";

		$location = Location::all()->first();
		$vaccination->location()->associate($location);

		$vaccination->save();

		$vaccination2 = new Vaccination();
		$vaccination2->maxPatients = 10;
		$vaccination2->date = new DateTime("2021-05-05");
		$vaccination2->from = "10:00:00";
		$vaccination2->to = "11:00:00";

		$location2 = Location::where('id', 2)->get()->first();
		$vaccination2->location()->associate($location2);

		$vaccination2->save();

		$vaccination3 = new Vaccination();
		$vaccination3->maxPatients = 10;
		$vaccination3->date = new DateTime("2021-05-05");
		$vaccination3->from = "14:00:00";
		$vaccination3->to = "15:00:00";

		$location3 = Location::where('id', 3)->get()->first();
		$vaccination3->location()->associate($location3);

		$vaccination3->save();

        $vaccination4 = new Vaccination();
        $vaccination4->maxPatients = 3;
        $vaccination4->date = new DateTime("2021-05-05");
        $vaccination4->from = "14:00:00";
        $vaccination4->to = "15:00:00";

        $location4 = Location::where('id', 4)->get()->first();
        $vaccination4->location()->associate($location4);

        $vaccination4->save();
    }
}
