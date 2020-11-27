<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//------------------ Open  permisos sobre Empleados - Users  --------------------------------

         Permission::create([
            'name'              =>  'lista los Empleados',
            'guard_name'                =>  'web',
            'description'     =>  'Genera la lista de los empleados del hotel.',
        ]);

        Permission::create([
            'name'                 =>  'registrar empleado.',
            'guard_name'                   =>  'web',
            'description'        =>  'Permite ingresar un nuevo empleado al sistema.',
        ]);


         Permission::create([
            'name'              =>  'Actualizar Empleados',
            'guard_name'                =>  'web',
            'description'     =>  'Permite editar y actualizar los datos de los empleados.',
        ]);

         Permission::create([
            'name'                =>  'activar Empleado',
            'guard_name'                  =>  'web',
            'description'       =>  'Permite activar un empleado',
        ]); 
        
        Permission::create([
            'name'                 =>  'desactivar Empleado',
            'guard_name'                   =>  'web',
            'description'        =>  'Permite desactivar un empleado',
        ]);

        Permission::create([
            'name'                  =>  'Consultar Rol Empleado',
            'guard_name'                    =>  'web',
            'description'         =>  'Permite consultar el Rol o los Roles de un Empleado',
        ]);
        //------------------ close  permisos sobre Empleados - Users --------------------------------


        //------------------ Open  permisos sobre Role ------------------------------------------------

         Permission::create([
            'name'                =>  'listar Roles',
            'guard_name'                  =>  'web',
            'description'       =>  'Genera la lista de los Roles creados.',
        ]);

        Permission::create([
            'name'                  =>  'registrar Rol.',
            'guard_name'                    =>  'web',
            'description'         =>  'Permite ingresar un nuevo Rol al sistema.',
        ]);


         Permission::create([
            'name'              =>  'Actualizar Rol',
            'guard_name'                =>  'web',
            'description'     =>  'Permite editar y actualizar los datos de los Roles.',
        ]);

         Permission::create([
            'name'                  =>  'Consultar Permisos del Rol',
            'guard_name'                    =>  'web',
            'description'         =>  'Permite consultar el Permiso o los Permisos de un Rol',
        ]);
        //  Permission::create([
        //     'name'              =>  'activa un Rol',
        //     'guard_name'              =>  'web',
        //     'description'       =>  'Permite activar un Rol en el sistema',
        // ]); 
        
        // Permission::create([
        //     'name'              =>  'desactiva un Rol',
        //     'guard_name'              =>  'web',
        //     'description'       =>  'Permite desactivar un Rol en el sistema',
        // ]);

        //------------------ close  permisos sobre Role ----------------------------------------------


        //------------------ Open  permisos sobre Customers --------------------------------

         Permission::create([
            'name'              =>  'listar clientes',
            'guard_name'              =>  'web',
            'description'       =>  'Genera la lista de los clientes del hotel.',
        ]);

        Permission::create([
            'name'                  =>  'registrar cliente.',
            'guard_name'                   =>  'web',
            'description'       =>  'Permite ingresar un nuevo cliente al sistema.',
        ]);


         Permission::create([
            'name'              =>  'Actualizar cliente.',
            'guard_name'              =>  'web',
            'description'       =>  'Permite editar y actualizar los datos de los clientes.',
        ]);

        Permission::create([
            'name'              =>  'buscar cliente.',
            'guard_name'              =>  'web',
            'description'       =>  'Permite buscar un cliente y sus datos.',
        ]);


        //------------------ close  permisos sobre Customers --------------------------------


         //------------------ Open  permisos sobre Habitaciones - Rooms  --------------------------------

         Permission::create([
            'name'              =>  'listar habitaciones.',
            'guard_name'                =>  'web',
            'description'     =>  'Genera la lista de las habitaciones del hotel.',
        ]);

        Permission::create([
            'name'                 =>  'registrar habitaciones.',
            'guard_name'                   =>  'web',
            'description'        =>  'Permite ingresar un nuevo habitacione al sistema.',
        ]);


         Permission::create([
            'name'              =>  'Actualizar habitaciones',
            'guard_name'                =>  'web',
            'description'     =>  'Permite editar y actualizar los datos de los habitaciones.',
        ]);

         Permission::create([
            'name'                =>  'activar habitacion',
            'guard_name'                  =>  'web',
            'description'       =>  'Permite activar una habitacion',
        ]); 
        
        Permission::create([
            'name'                 =>  'desactivar habitacion',
            'guard_name'                   =>  'web',
            'description'        =>  'Permite desactivar una habitacion',
        ]);

        Permission::create([
            'name'                 =>  'Reservar habitacion',
            'guard_name'                   =>  'web',
            'description'        =>  'Permite Reservar una habitacion',
        ]);

        Permission::create([
            'name'                 =>  'liberar habitacion',
            'guard_name'                   =>  'web',
            'description'        =>  'Permite liberar la reserva de una habitacion',
        ]);

        Permission::create([
            'name'                 =>  'listar Activas',
            'guard_name'                   =>  'web',
            'description'        =>  'Permite listar habitaciones activas',
        ]);

       
        //------------------ close  permisos sobre  Habitaciones - Rooms --------------------------------


                //------------------ Open  permisos sobre Category ------------------------------------------------

         Permission::create([
            'name'                =>  'listar Categorías',
            'guard_name'                  =>  'web',
            'description'       =>  'Genera la lista de los categorias creadas.',
        ]);

        Permission::create([
            'name'                  =>  'registrar Categoría.',
            'guard_name'                    =>  'web',
            'description'         =>  'Permite ingresar un nueva Categoría al sistema.',
        ]);


         Permission::create([
            'name'              =>  'Actualizar Categoría',
            'guard_name'                =>  'web',
            'description'     =>  'Permite editar y actualizar los datos de las Categoría.',
        ]);

         Permission::create([
            'name'              =>  'activar Categoría',
            'guard_name'              =>  'web',
            'description'       =>  'Permite activar una Categoría en el sistema',
        ]); 
        
        Permission::create([
            'name'              =>  'desactivar Categoría',
            'guard_name'              =>  'web',
            'description'       =>  'Permite desactivar una Categoría en el sistema',
        ]);


        Permission::create([
            'name'              =>  'Listar categorias activas',
            'guard_name'              =>  'web',
            'description'       =>  'Permite listar las Categorías activas',
        ]);

        //------------------ close  permisos sobre Category ----------------------------------------------


                //------------------ Open  permisos sobre Products ------------------------------------------------

         Permission::create([
            'name'                =>  'listar Productos',
            'guard_name'                  =>  'web',
            'description'       =>  'Genera la lista de los productos creados.',
        ]);

        Permission::create([
            'name'                  =>  'registrar Producto.',
            'guard_name'                    =>  'web',
            'description'         =>  'Permite ingresar un nuevo Producto al sistema.',
        ]);


         Permission::create([
            'name'              =>  'Actualizar Productos',
            'guard_name'                =>  'web',
            'description'     =>  'Permite editar y actualizar los datos de los Productos.',
        ]);

         Permission::create([
            'name'              =>  'activar Producto',
            'guard_name'              =>  'web',
            'description'       =>  'Permite activar un Producto en el sistema',
        ]); 
        
        Permission::create([
            'name'              =>  'desactivar Producto',
            'guard_name'              =>  'web',
            'description'       =>  'Permite desactivar un Producto en el sistema',
        ]);

        //------------------ close  permisos sobre Products ----------------------------------------------


         //------------------ Open  permisos sobre Providers ------------------------------------------------

         Permission::create([
            'name'                =>  'listar Proveedores',
            'guard_name'                  =>  'web',
            'description'       =>  'Genera la lista de los Proveedores creados.',
        ]);

        Permission::create([
            'name'                  =>  'registrar Provedor.',
            'guard_name'                    =>  'web',
            'description'         =>  'Permite ingresar un nuevo Provedor al sistema.',
        ]);


         Permission::create([
            'name'              =>  'Actualizar Proveedores',
            'guard_name'                =>  'web',
            'description'     =>  'Permite editar y actualizar los datos de los Proveedores.',
        ]);

         Permission::create([
            'name'              =>  'activar Provedor',
            'guard_name'              =>  'web',
            'description'       =>  'Permite activar un Provedor en el sistema',
        ]); 
        
        Permission::create([
            'name'              =>  'desactivar Provedor',
            'guard_name'              =>  'web',
            'description'       =>  'Permite desactivar un Provedor en el sistema',
        ]);

        Permission::create([
            'name'              =>  'Listar Proveedores activos',
            'guard_name'              =>  'web',
            'description'       =>  'Permite listar los Proveedores activos',
        ]);

        Permission::create([
            'name'              =>  'Listar productos-proveedores',
            'guard_name'              =>  'web',
            'description'       =>  'Permite asociar los productos que suministra cada proveedor.',
        ]);
        //------------------ close  permisos sobre Providers ----------------------------------------------
        
           //------------------ Open  permisos sobre links --------------------------------

         Permission::create([
            'name'              =>  'listar vinculaciones',
            'guard_name'              =>  'web',
            'description'       =>  'Genera la lista de tipo de vinculaciones.',
        ]);

        Permission::create([
            'name'                  =>  'registrar vinculación.',
            'guard_name'                   =>  'web',
            'description'       =>  'Permite ingresar un nuevo tipo vinculación al sistema.',
        ]);


         Permission::create([
            'name'              =>  'Actualizar vinculación.',
            'guard_name'              =>  'web',
            'description'       =>  'Permite editar y actualizar los datos de una vinculaciones.',
        ]);

        Permission::create([
            'name'              =>  'buscar vinculación.',
            'guard_name'              =>  'web',
            'description'       =>  'Permite buscar un vinculación y sus datos.',
        ]);

        Permission::create([
            'name'              =>  'activar vinculación',
            'guard_name'              =>  'web',
            'description'       =>  'Permite activar una vinculación',
        ]); 
        
        Permission::create([
            'name'              =>  'desactivar vinculación',
            'guard_name'              =>  'web',
            'description'       =>  'Permite desactivar una vinculación',
        ]);


        //------------------ close  permisos sobre links --------------------------------
        

         //------------------ Open  permisos sobre web --------------------------------

         Permission::create([
            'name'              =>  'listar habitaciones',
            'guard_name'              =>  'web',
            'description'       =>  'Genera la lista de tipo de habitaciones.',
        ]);

        Permission::create([
            'name'                  =>  'registrar habitación.',
            'guard_name'                   =>  'web',
            'description'       =>  'Permite ingresar un nuevo tipo habitación al sistema.',
        ]);


         Permission::create([
            'name'              =>  'Actualizar habitación.',
            'guard_name'              =>  'web',
            'description'       =>  'Permite editar y actualizar los datos de una habitaciones.',
        ]);

    
        Permission::create([
            'name'              =>  'activar habitación',
            'guard_name'              =>  'web',
            'description'       =>  'Permite activar una habitación',
        ]); 
        
        Permission::create([
            'name'              =>  'desactivar habitación',
            'guard_name'              =>  'web',
            'description'       =>  'Permite desactivar una habitación',
        ]);


        //------------------ close  permisos sobre web --------------------------------

                 //------------------ Open  permisos sobre Class_residues --------------------------------

         Permission::create([
            'name'              =>  'listar Clase de residuos',
            'guard_name'              =>  'web',
            'description'       =>  'Genera la lista de las clases de residuos.',
        ]);

        Permission::create([
            'name'                  =>  'registrar Clase de residuo.',
            'guard_name'                   =>  'web',
            'description'       =>  'Permite ingresar una nueva clase de residuo.',
        ]);


         Permission::create([
            'name'              =>  'Actualizar Clase de residuo.',
            'guard_name'              =>  'web',
            'description'       =>  'Permite editar y actualizar Datos.',
        ]);

        

        Permission::create([
            'name'              =>  'activar Clase de residuo',
            'guard_name'              =>  'web',
            'description'       =>  'Permite activar Clase',
        ]); 
        
        Permission::create([
            'name'              =>  'desactivar Clase de residuo',
            'guard_name'              =>  'web',
            'description'       =>  'Permite desactivar una Clase',
        ]);


        //------------------ close  permisos sobre Class_residues --------------------------------
        

                     //------------------ Open  permisos sobre residues --------------------------------

         Permission::create([
            'name'              =>  'listar recolección Residuos',
            'guard_name'              =>  'web',
            'description'       =>  'Genera la lista de las clases de residuos.',
        ]);

        Permission::create([
            'name'                  =>  'registrar recolección Residuos.',
            'guard_name'                   =>  'web',
            'description'       =>  'Permite ingresar una nueva clase de residuo.',
        ]);


         Permission::create([
            'name'              =>  'Actualizar recolección Residuos.',
            'guard_name'              =>  'web',
            'description'       =>  'Permite editar y actualizar Datos.',
        ]);

        //------------------ close  permisos sobre residues --------------------------------






    }
}
