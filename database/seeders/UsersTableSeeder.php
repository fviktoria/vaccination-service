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
        $user->email = 'viktoria@admin.com';
		$user->password = bcrypt('admin123');
		$user->gender = 'w';
		$user->street = 'Musterstraße';
		$user->houseNo = '1';
		$user->zipCode = '1000';
		$user->city = 'Musterstadt';
		$user->ssno = '1234291295';
		$user->dateOfBirth = new DateTime('1996-12-29');
		$user->save();

        $user2 = new User();
        $user2->isAdmin = false;
        $user2->isVaccinated = false;
        $user2->firstName = 'Viktoria';
        $user2->lastName = 'Ferstl';
        $user2->email = 'viktoria@ferstl.com';
        $user2->password = bcrypt('user123');
        $user2->gender = 'w';
        $user2->street = 'Musterstraße';
        $user2->houseNo = '1';
        $user2->zipCode = '1000';
        $user2->city = 'Musterstadt';
        $user2->ssno = '1234291296';
        $user2->dateOfBirth = new DateTime('1996-12-29');
        $vaccination = Vaccination::all()->first();
        $user2->vaccination()->associate($vaccination);
        $user2->save();

        $user3 = new User();
        $user3->isAdmin = false;
        $user3->isVaccinated = false;
        $user3->firstName = 'John';
        $user3->lastName = 'Doe';
        $user3->email = 'john@doe.com';
        $user3->password = bcrypt('user123');
        $user3->gender = 'm';
        $user3->street = 'Musterstraße';
        $user3->houseNo = '1';
        $user3->zipCode = '1000';
        $user3->city = 'Musterstadt';
        $user3->ssno = '1234080356';
        $user3->dateOfBirth = new DateTime('1956-03-08');
        $user3->save();

        $user4 = new User();
        $user4->isAdmin = false;
        $user4->isVaccinated = false;
        $user4->firstName = 'Jane';
        $user4->lastName = 'Doe';
        $user4->email = 'jane@doe.com';
        $user4->password = bcrypt('user123');
        $user4->gender = 'w';
        $user4->street = 'Musterstraße';
        $user4->houseNo = '1';
        $user4->zipCode = '1000';
        $user4->city = 'Musterstadt';
        $user4->ssno = '1234131289';
        $user4->dateOfBirth = new DateTime('1989-12-13');
        $user4->save();

        $user5 = new User();
        $user5->isAdmin = false;
        $user5->isVaccinated = false;
        $user5->firstName = 'Max';
        $user5->lastName = 'Mustermann';
        $user5->email = 'max@muster.com';
        $user5->password = bcrypt('user123');
        $user5->gender = 'w';
        $user5->street = 'Musterstraße';
        $user5->houseNo = '1';
        $user5->zipCode = '1000';
        $user5->city = 'Musterstadt';
        $user5->ssno = '1234120289';
        $user5->dateOfBirth = new DateTime('1989-02-12');
        $user5->save();

        $user6 = new User();
        $user6->isAdmin = false;
        $user6->isVaccinated = false;
        $user6->firstName = 'Maria';
        $user6->lastName = 'Musterfrau';
        $user6->email = 'maria@muster.com';
        $user6->password = bcrypt('user123');
        $user6->gender = 'w';
        $user6->street = 'Musterstraße';
        $user6->houseNo = '1';
        $user6->zipCode = '1000';
        $user6->city = 'Musterstadt';
        $user6->ssno = '1234230194';
        $user6->dateOfBirth = new DateTime('1994-01-23');
        $user6->save();
    }
}
