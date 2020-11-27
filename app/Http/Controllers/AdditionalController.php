<?php

namespace App\Http\Controllers;
use App\Additional;
use Illuminate\Http\Request;

class AdditionalController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $additionals = Additional::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $additionals = Additional::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $additionals->total(),
                'current_page' => $additionals->currentPage(),
                'per_page'       => $additionals->perPage(),
                'last_page'      => $additionals->lastPage(),
                'from'              => $additionals->firstItem(),
                'to'                  => $additionals->lastItem(),
            ],
            'additionals' => $additionals
        ];
        // $additionals = additional::get();
        // return $additionals;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            $additional=Additional::create($request->all());

    }

    

    public function update(Request $request)
    {		
       		
       		if (!$request->ajax()) return redirect('/');

            $additional =  Additional::findOrFail($request->id);

            $additional->name_additional = $request->name_additional;
            $additional->description_additional = $request->description_additional;
            $additional->price_additional = $request->price_additional;
            $additional->condition_additional = '1';
            $additional->save();
            
    }


    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $additional =  Additional::findOrFail($request->id);
        $additional->condition_additional = '1';
        $additional->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $additional =  Additional::findOrFail($request->id);
        $additional->condition_additional = '0';
        $additional->save();
    }



      public function listAdditionalActive(Request $request)
    {   
         
       if (!$request->ajax()) return redirect('/');
        $name_additional = $request->search;

        if ($name_additional=='') {
            $additional = '';
            return  $additional;
        }else{
            $additional = Additional::where('name_additional', 'like', '%'. $name_additional . '%')
            ->where('condition_additional','=','1')
            ->orderBy('id', 'desc')->get();
            return  $additional;
        }
       
    }
}

