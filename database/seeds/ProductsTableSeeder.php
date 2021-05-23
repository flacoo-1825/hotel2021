<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  factory(App\Product::class, 10)->create();

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'GASEOSA',
            'img_product' => 'gaseosas.jpg',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 2500,
            'sale_product' => 2500,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'MR TEA',
            'img_product' => 'mrTea.jpg',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 2500,
            'sale_product' => 2500,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'MALTA',
            'img_product' => 'malta.png',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 2500,
            'sale_product' => 2500,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'AGUA BOTELLA',
            'img_product' => 'brisa.png',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 2500,
            'sale_product' => 2500,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'GETORADE',
            'img_product' => 'gatorade.jpg',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 3500,
            'sale_product' => 3500,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'H2O',
            'img_product' => 'h2o.jpg',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 3500,
            'sale_product' => 3500,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'CERVEZAS',
            'img_product' => 'cervezas.jpg',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 3500,
            'sale_product' => 3500,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'GASEOSA 2LTS POSTOBON',
            'img_product' => 'postobon.jpg',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 4000,
            'sale_product' => 4000,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'GASEOSA COCACOLA 1.5LTS',
            'img_product' => 'cocacola.jpg',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 4500,
            'sale_product' => 4500,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'CHAMPAÑA',
            'img_product' => 'champana.jpg',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 15000,
            'sale_product' => 15000,
            'condition_product' => 1 
            ]);
            
        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'VINO',
            'img_product' => 'vino.jpg',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 25000,
            'sale_product' => 25000,
            'condition_product' => 1,
            ]);
            
        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'HIT',
            'img_product' => 'hit.png',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 2500,
            'sale_product' => 2500,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'PASABOCAS',
            'img_product' => 'logo.png',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 1800,
            'sale_product' => 1800,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'SALCHICHAS',
            'img_product' => 'logo.png',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 4500,
            'sale_product' => 4500,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'CHOCOLATINA',
            'img_product' => 'logo.png',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 1700,
            'sale_product' => 1700,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'MANIMOTO',
            'img_product' => 'logo.png',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 1700,
            'sale_product' => 1700,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'MINICHIPS',
            'img_product' => 'logo.png',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 1700,
            'sale_product' => 1700,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'CREMA DENTAL',
            'img_product' =>'logo.png',
            'stock_product' => 10,
            'start_product' => 10,
            'buy_product' => 2500,
            'sale_product' => 2500,
            'condition_product' => 1
            ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'CEPILLO DE DIENTES',
             'img_product' => 'logo.png',
             'stock_product' => 10,
             'start_product' => 10,
             'buy_product' => 3500,
             'sale_product' => 3500,
             'condition_product' => 1
             ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'SHAMPOO',
             'img_product' => 'logo.png',
             'stock_product' => 10,
             'start_product' => 10,
             'buy_product' => 2000,
             'sale_product' => 2000,
             'condition_product' => 1
             ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'CREMA PARA PEINAR',
             'img_product' => 'logo.png',
             'stock_product' => 10,
             'start_product' => 10,
             'buy_product' => 2000,
             'sale_product' => 2000,
             'condition_product' => 1
             ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'GEL',
             'img_product' => 'logo.png',
             'stock_product' => 10,
             'start_product' => 10,
             'buy_product' => 2500,
             'sale_product' => 2500,
             'condition_product' => 1
             ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'PRESERVATIVOS X 3 UND',
             'img_product' => 'logo.png',
             'stock_product' => 10,
             'start_product' => 10,
             'buy_product' => 6000,
             'sale_product' => 6000,
             'condition_product' => 1
             ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'PRESTOBARBA',
             'img_product' => 'logo.png',
             'stock_product' => 10,
             'start_product' => 10,
             'buy_product' => 4000,
             'sale_product' => 4000,
             'condition_product' => 1
             ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'DESODORANTE',
             'img_product' => 'logo.png',
             'stock_product' => 10,
             'start_product' => 10,
             'buy_product' => 2000,
             'sale_product' => 2000,
             'condition_product' => 1
             ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'BONFIEST',
             'img_product' => 'logo.png',
             'stock_product' => 10,
             'start_product' => 10,
             'buy_product' => 3000,
             'sale_product' => 3000,
             'condition_product' => 1
             ]);

        Product::create([
            'category_id' => 1,
            'provider_id' =>1,
            'name_product' => 'DETODITO',
             'img_product' => 'logo.png',
             'stock_product' => 10,
             'start_product' => 10,
             'buy_product' => 2200,
             'sale_product' => 2200,
             'condition_product' => 1
             ]);

    }
}
