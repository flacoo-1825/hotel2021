<?php

use Illuminate\Database\Seeder;

class CountersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Counter::class, 1)->create();
    }
}
