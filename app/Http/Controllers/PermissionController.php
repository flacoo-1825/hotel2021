<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    
	public function index(Request $request)
    {   
         
        if (!$request->ajax()) return redirect('/');
           
        $perimissions = Permission::select('id','description','name')
                                ->orderBy('id', 'asc')->get();
        return $perimissions;
    }
    
}