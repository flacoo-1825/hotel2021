<?php

namespace App\Http\Controllers;
use App\TypeRoom;

use Illuminate\Http\Request;

class TypeRoomController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $typeRoom = TypeRoom::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $typeRoom = TypeRoom::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $typeRoom->total(),
                'current_page' => $typeRoom->currentPage(),
                'per_page'       => $typeRoom->perPage(),
                'last_page'      => $typeRoom->lastPage(),
                'from'              => $typeRoom->firstItem(),
                'to'                  => $typeRoom->lastItem(),
            ],
            'typeRoom' => $typeRoom
        ];
        // $rooms = TypeRoom::get();
        // return $rooms;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            $typeRoom=typeRoom::create($request->all());

    		 // //crea un nueva nueva clase habitación.
       //      $typeRoom = new TypeRoom();

       //      $typeRoom->name_type_room = $request->name_type_room;
       //      $typeRoom->description_type_room = $request->description_type_room;
       //      $typeRoom->state_type_room = '1';
       //      $typeRoom->save();
    }

    

    public function update(Request $request)
    {		
       		
       		if (!$request->ajax()) return redirect('/');

            $typeRoom =  TypeRoom::findOrFail($request->id);

            $typeRoom->name_type_room = $request->name_type_room;
            $typeRoom->description_type_room = $request->description_type_room;
            $typeRoom->state_type_room = '1';
            $typeRoom->save();
            
    }


    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $typeRoom =  TypeRoom::findOrFail($request->id);
        $typeRoom->state_type_room = '1';
        $typeRoom->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $typeRoom =  TypeRoom::findOrFail($request->id);
        $typeRoom->state_type_room = '0';
        $typeRoom->save();
    }

    public function reservar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $typeRoom =  TypeRoom::findOrFail($request->id);
        $typeRoom->state_type_room = 'R';
        $typeRoom->save();
    }

    public function freeReserva(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $typeRoom =  TypeRoom::findOrFail($request->id);
        $typeRoom->state_type_rooms = '';
        $typeRoom->save();
    }


      public function listRoomActive(Request $request)
    {   
         
        if (!$request->ajax()) return redirect('/');
        $typeRoom = TypeRoom::where('state_type_room','=','1')
                        ->select('id','name_type_room')
                        ->orderBy('id', 'desc')->get();
        return [
            'typeRoom' => $typeRoom
        ];
    }
}
