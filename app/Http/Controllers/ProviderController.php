<?php

namespace App\Http\Controllers;
use App\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $providers = Provider::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $providers = Provider::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $providers->total(),
                'current_page' => $providers->currentPage(),
                'per_page'       => $providers->perPage(),
                'last_page'      => $providers->lastPage(),
                'from'              => $providers->firstItem(),
                'to'                  => $providers->lastItem(),
            ],
            'providers' => $providers
        ];
        // $providers = Provider::get();
        // return $providers;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            $provider=Provider::create($request->all());

    }

    

    public function update(Request $request)
    {		
       		
       		if (!$request->ajax()) return redirect('/');

            $provider =  Provider::findOrFail($request->id);

            $provider->name_provider = $request->name_provider;
            $provider->firstSurname_provider = $request->firstSurname_provider;
            $provider->secondSurname_provider = $request->secondSurname_provider;
            $provider->company_provider = $request->company_provider;
            $provider->address_provider = $request->address_provider;
            $provider->phone_provider = $request->phone_provider;
            $provider->email_provider = $request->email_provider;
            $provider->condition_provider = '1';
            $provider->save();
            
    }


    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $provider =  Provider::findOrFail($request->id);
        $provider->condition_provider = '1';
        $provider->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $provider =  Provider::findOrFail($request->id);
        $provider->condition_provider = '0';
        $provider->save();
    }


      public function listProviderActive(Request $request)
    {   
         
       if (!$request->ajax()) return redirect('/');

            $provider = Provider::where('condition_provider','=','1')
                        ->select('id','name_provider')
                        ->orderBy('id', 'desc')->get();
       
        return [
                
            'provider' => $provider
        ];
    }
}

