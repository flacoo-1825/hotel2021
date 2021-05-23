<?php
use App\Provider;
use Illuminate\Database\Seeder;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Provider::class, 20)->create();
        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'DISTRIBUCIONES MVM S.A.S',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '900662046-3',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'SURTIELECTRICOS',
            'address_provider' =>'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '901093999-9',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'COMERCIALIZADORA PROQUIMEL LTDA',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '900147334-1',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'OLIMPICA S.A',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '890.107.487-3',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'RH SAS',
            'address_provider' =>'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '805007083-3',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'MADECENTRO COLOMBIA SAS',
            'address_provider' =>'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '811028650',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'NELSON DARIO LONDOÑO',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '16.216.872-2',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'GRUPO CLEAN  SAS',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '901.145.668-0',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'INVERSIONES RENDON VALENCIA GONZALEZ',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '900.190.237-7',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'DISTRIPLAST CARTAGO S.A.S',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '901200787-4',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'ALMACENES ÉXITO S.A',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '890.900.608-9',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'SODIMAC COLOMBIA S.A',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '800.242.106-2',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'JAIRO BERNAL HERNANDEZ(EXTINTORES)',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '10.118.349-1',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'JUAN DAVID CASTAÑEDA',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '1,112771646-2',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'MARIA SOFIA VILLEGAS',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '29.377.118-4',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'OLGA LUCIA ISAZA',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '31.418.362-1',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'DAVID BEDOYA',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '1112758255-2',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'MORALES FALLA Y CIA',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '900.211.248-1',
            'condition_provider' => 1
            ]);

        Provider::create([
            'name_provider' => 'Nombre',
            'firstSurname_provider' => 'primer apellido',
            'secondSurname_provider' => 'segundo apellido',
            'company_provider'=> 'SANDRA INES DUQUE GOMEZ',
            'address_provider' => 'dirección',
            'phone_provider' => 'celular',
            'email_provider' => 'E-mail',
            'nit_provider' => '31.427.910-4',
            'condition_provider' => 1
            ]); 
    }
}
