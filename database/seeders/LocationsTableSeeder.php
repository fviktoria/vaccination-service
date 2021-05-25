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

		$location2 = new Location();
		$location2->name = "Apotheke Zum heiligen Ägidus";
		$location2->street = "Gumpendorfer Straße";
		$location2->houseNo = "105";
		$location2->zipCode = "1060";
		$location2->city = "Wien";

		$location2->save();

        $location3 = new Location();
        $location3->name = "Austria Center Vienna";
        $location3->street = "Bruno-Kreisky-Platz";
        $location3->houseNo = "1";
        $location3->zipCode = "1220";
        $location3->city = "Wien";

        $location3->save();

        $location4 = new Location();
        $location4->name = "Stadthalle";
        $location4->street = "Roland-Rainer-Platz";
        $location4->houseNo = "1";
        $location4->zipCode = "1150";
        $location4->city = "Wien";

        $location4->save();
    }
}
