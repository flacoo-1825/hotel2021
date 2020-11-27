<?php

use Illuminate\Database\Seeder;

class TypeRoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TypeRoom::class, 3)->create();
    }
}
