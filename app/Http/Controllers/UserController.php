<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
	public function index(Request $request)
    {   

        if (!$request->ajax()) return redirect('/');
        $search = $request->search;
        $valor = $request->valor;
        
        if ($search==''){
            $users = User::leftjoin('workers', 'users.cedula_worker', '=' ,'workers.cedula_worker')
                            ->select('users.email','users.id','workers.name_worker',
                            'workers.firstSurname_worker','workers.phone_worker',
                            'workers.cedula_worker','users.condition_user')
                            ->orderBy('users.id', 'desc')->paginate(10);
        }
        else{
            $users = User::leftjoin('workers', 'users.cedula_worker', '=' ,'workers.cedula_worker')
                            ->select('users.email','users.id','workers.name_worker',
                            'workers.firstSurname_worker','workers.phone_worker',
                            'workers.cedula_worker','users.condition_user')
                            ->where($valor, 'like', '%'. $search . '%')->orderBy('users.id', 'desc')->paginate(10);
        }

        return [
                'pagination'      => [
                'total'              => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page'       => $users->perPage(),
                'last_page'      => $users->lastPage(),
                'from'              => $users->firstItem(),
                'to'                  => $users->lastItem(),
            ],
            'users' => $users
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = new User();
        $user->email = $request->email;
        $user->cedula_worker = $request->cedula_worker;
        $user->password = bcrypt($request->password);
        $user->save();
    }

    public function update(Request $request)
    {		
       		
       	if (!$request->ajax()) return redirect('/');

        $user =  User::findOrFail($id);
        
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->cedula_worker = $request->cedula_worker;
        $user->save();
            
    }
    
    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $user =  User::findOrFail($request->id);
        $user->condition_user = 1;
        $user->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $user =  User::findOrFail($request->id);
        $user->condition_user = 0;
        $user->save();
    }

    public function destroy(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->delete();
    }
}

