<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 2)->create();

        Role::create([

        	'name'     => 'SuperAdmin',
        	'guard_name'     => 'SuperAdmin',

        ]);
    }
}
