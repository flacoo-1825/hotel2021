<?php

namespace App\Http\Controllers;
use App\Link;

use Illuminate\Http\Request;

class LinkController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	// if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $links = Link::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $links = Link::where($valor, 'like', '%'. $search . '%')
            ->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $links->total(),
                'current_page' => $links->currentPage(),
                'per_page'       => $links->perPage(),
                'last_page'      => $links->lastPage(),
                'from'              => $links->firstItem(),
                'to'                  => $links->lastItem(),
            ],
            'links' => $links
        ];
        // $links = Link::get();
        // return $links;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            $link=Link::create($request->all());

    }

    

    public function update(Request $request)
    {		
       		
       		if (!$request->ajax()) return redirect('/');

            $link =  Link::findOrFail($request->id);

            $link->name_link = $request->name_link;
            $link->description_link = $request->description_link;
            $link->state_link = '1';
            $link->save();
            
    }


    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $link =  Link::findOrFail($request->id);
        $link->state_link = '1';
        $link->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $link =  Link::findOrFail($request->id);
        $link->state_link = '0';
        $link->save();
    }

      public function listLinksActive(Request $request)
    {   
         
        if (!$request->ajax()) return redirect('/');
         
        $links = Link::where('state_link','=','1')
                    ->select('id','name_link')
                    ->orderBy('id', 'desc')->get();
        return [
            'links' => $links
        ];
    }
}
