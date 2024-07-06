<?php

namespace Database\Seeders;

use App\Models\Users\User;
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
        $firstUser = User::where('email', 'jcalderon@stratecsa.com')->first();

        if (!$firstUser){
            User::create([
                'name'       => 'Julian',
                'last_name'   => 'Calderon',
                'full_name'  => 'Julian Calderon',
                'email'      => 'jcalderon@stratecsa.com',
                'password'    => bcrypt('123456'),
                'status'      => 'Activo',
            ]);
        }

    }
}
