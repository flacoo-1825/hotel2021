<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $roles = Role::orderBy('id', 'asc')->paginate(10);
        }
        else{
            $roles = Role::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'asc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $roles->total(),
                'current_page' => $roles->currentPage(),
                'per_page'       => $roles->perPage(),
                'last_page'      => $roles->lastPage(),
                'from'              => $roles->firstItem(),
                'to'                  => $roles->lastItem(),
            ],
            'roles' => $roles
        ];
        // $roles = role::get();
        // return $roles;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            $role = new Role;
            $role->name = $request->name;
            $role->save();
            // $role=Role::create($request->all());
            $permissions = $request->arrayPermissions;
            $role = Role::all()->last();
            for ($i=0; $i < count($permissions) ; $i++) { 
                $role->givePermissionTo($permissions[$i]['name']);
            }
            // $role->givePermissionTo('edit articles');

    }

    

    public function update(Request $request)
    {		
       		
       		if (!$request->ajax()) return redirect('/');

            $role =  Role::findOrFail($request->id);

            $role->type_role_id = $request->type_id;
            $role->number = $request->number;
            $role->price = $request->price;
            $role->price_air = $request->price_air;
            $role->frozen = $request->frozen;
            $role->state = $request->state;
            $role->reservation_date = $request->reservation_date;
            $role->save();
           
    }

    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $role =  Role::findOrFail($request->id);
        $role->condition = '1';
        $role->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $role =  Role::findOrFail($request->id);
        $role->condition = '0';
        $role->save();
    }

      public function listroleActive(Request $request)
    {   
         
       if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $role = Role::leftJoin('customers','roles.client_id' ,'=', 'customers.id')
                        ->join('type_roles','roles.type_role_id', '=', 'type_roles.id')
                        ->select('roles.id', 'roles.state','type_roles.name_type_role',
                        'roles.number','roles.price','roles.client_id','roles.condition',
                        'roles.price_air','roles.frozen','roles.number_facture',
                        'roles.state','customers.firstSurname_client','customers.cedula_client',
                        'customers.name_client','customers.nationality_client','customers.phone_client', 
                        'customers.secondSurname_client')
                        ->where('condition','=','1')
                        ->orderBy('id', 'asc')->paginate(9);
        }
        else{
            $role = Role::leftJoin('customers','roles.client_id' ,'=', 'customers.id')
                        ->join('type_roles','roles.type_role_id', '=', 'type_roles.id')
                        ->select('roles.id', 'roles.state','type_roles.name_type_role',
                        'roles.number','roles.price','roles.client_id','roles.condition',
                        'roles.price_air','roles.frozen','roles.number_facture',
                        'roles.state','customers.firstSurname_client','customers.cedula_client',
                        'customers.name_client','customers.nationality_client','customers.phone_client', 
                        'customers.secondSurname_client')
                        ->where('condition','=','1')
                        ->where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(18);
        }
 
        return [
                'pagination'      => [
                'total'              => $role->total(),
                'current_page' => $role->currentPage(),
                'per_page'       => $role->perPage(),
                'last_page'      => $role->lastPage(),
                'from'              => $role->firstItem(),
                'to'                  => $role->lastItem(),
            ],
            'role' => $role
        ];
    }
}
