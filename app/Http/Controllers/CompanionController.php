<?php

namespace App\Http\Controllers;
use App\Companion;
use Illuminate\Http\Request;

class CompanionController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $companions = Companion::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $companions = Companion::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $companions->total(),
                'current_page' => $companions->currentPage(),
                'per_page'       => $companions->perPage(),
                'last_page'      => $companions->lastPage(),
                'from'              => $companions->firstItem(),
                'to'                  => $companions->lastItem(),
            ],
            'companions' => $companions
        ];
        // $rooms = Companions::get();
        // return $rooms;
      
    }


    public function store(Request $request)
    {    
            if (!$request->ajax()) return redirect('/');
            $companions=Companions::create($request->all());

    }

    

    public function update(Request $request)
    {		
       		
            if (!$request->ajax()) return redirect('/');

            $arrayCompanions = $request->companions;

            for ($i=0; $i > count(array($arrayCompanions)) ; $i++) {

                $companions =  Companion::findOrFail($arrayCompanions[$i]['id']);
                $companions->temperature_exit_acomp = $arrayCompanions[$i]['temperature_exit_acomp'];
                $companions->save();
            }
            
    }


     public function searchCompanions(Request $request)
     {   
          
            // /if (!$request->ajax()) return redirect('/');
            $search = $request->search;
            // $search =24;
            $valor  = 'certificate_id';
    
            $companions = Companion::where($valor,'=',$search )->orderBy('id', 'desc')->get();
  
  
         return [
             'companions' => $companions
         ];
         // $rooms = Companions::get();
         // return $rooms;
       
     }
 



}
