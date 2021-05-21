<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vaccination;
use DateTime;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->isAdmin = true;
        $user->isVaccinated = false;
        $user->firstName = 'Viktoria';
        $user->lastName = 'Ferstl';
        $user->email = 's1810456009@students.fh-hagenberg.at';
		$user->password = bcrypt('admin123');
		$user->gender = 'w';
		$user->street = 'Musterstraße';
		$user->houseNo = '1';
		$user->zipCode = '1000';
		$user->city = 'Musterstadt';
		$user->ssno = '1234291295';
		$user->dateOfBirth = new DateTime('1996-12-29');

		$vaccination = Vaccination::all()->first();
		$user->vaccination()->associate($vaccination);

		$user->save();

        $user2 = new User();
        $user2->isAdmin = false;
        $user2->isVaccinated = false;
        $user2->firstName = 'Viktoria';
        $user2->lastName = 'Ferstl';
        $user2->email = 'hello@viktoriamf.com';
        $user2->password = bcrypt('user123');
        $user2->gender = 'w';
        $user2->street = 'Musterstraße';
        $user2->houseNo = '1';
        $user2->zipCode = '1000';
        $user2->city = 'Musterstadt';
        $user2->ssno = '1234291296';
        $user2->dateOfBirth = new DateTime('1996-12-29');

        $user2->save();
    }
}
