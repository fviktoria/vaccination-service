<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$location = new Location();
		$location->name = "Marien Apotheke";
		$location->street = "Schmalzhofgasse";
		$location->houseNo = "1";
		$location->zipCode = "1060";
		$location->city = "Wien";

		$location->save();
    }
}
