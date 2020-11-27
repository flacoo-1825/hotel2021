<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(TypeRoomsTableSeeder::class);
         $this->call(CustomersTableSeeder::class);
         // $this->call(RoomsTableSeeder::class);
         $this->call(LinksTableSeeder::class);
         $this->call(WorkersTableSeeder::class);
         // $this->call(ProvidersTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         // $this->call(ProductsTableSeeder::class);
         $this->call(CertificatesTableSeeder::class);
         $this->call(CompanionsTableSeeder::class);
         $this->call(CountersTableSeeder::class);
         $this->call(PermissionsTableSeeder::class);
    }
}
