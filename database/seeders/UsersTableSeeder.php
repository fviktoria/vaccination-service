<?php

namespace Database\Seeders;

use App\Models\User;
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
		$user->save();
    }
}
