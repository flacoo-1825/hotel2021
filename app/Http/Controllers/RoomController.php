<?php

namespace App\Http\Controllers;
use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $rooms = Room::orderBy('id', 'asc')->paginate(10);
        }
        else{
            $rooms = Room::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'asc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $rooms->total(),
                'current_page' => $rooms->currentPage(),
                'per_page'       => $rooms->perPage(),
                'last_page'      => $rooms->lastPage(),
                'from'              => $rooms->firstItem(),
                'to'                  => $rooms->lastItem(),
            ],
            'rooms' => $rooms
        ];
        // $rooms = Room::get();
        // return $rooms;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            $room=Room::create($request->all());

    }

    

    public function update(Request $request)
    {		
       		
       		if (!$request->ajax()) return redirect('/');

            $room =  Room::findOrFail($request->id);

            $room->type_room_id = $request->type_id;
            $room->number = $request->number;
            $room->price = $request->price;
            $room->price_air = $request->price_air;
            $room->frozen = $request->frozen;
            $room->state = $request->state;
            // $room->reservation_date = $request->reservation_date;
            $room->save();
           
    }

    public function reservation(Request $request)
    {		
       		
       		if (!$request->ajax()) return redirect('/');

            $room =  Room::findOrFail($request->id);

            $room->reservation_client_id = $request->reservation_client_id;
            $room->reservation_date = $request->reservation_date;
            $room->save();
           
    }

    public function updateFacture(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $room =  Room::findOrFail($request->id);
        $room->number_facture = $request->number_facture;
        $room->state = 'Ocupada';
        $room->save();

        $room =  Room::findOrFail($request->room_id);
        $room->number_facture = '';
        $room->state = 'Disponible';
        $room->save();
    }


    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $room =  Room::findOrFail($request->id);
        $room->condition = '1';
        $room->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $room =  Room::findOrFail($request->id);
        $room->condition = '0';
        $room->save();
    }

    public function statebusy(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $room =  Room::findOrFail($request->id);
        $room->state = 'Ocupada';
        $room->client_id = $request->client_id;
        $room->number_facture = $request->number_check;
        $room->number_certificate = $request->number_certificate;
        $room->save();
    }

    public function statefree(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $room =  Room::findOrFail($request->id);
        $room->state = 'Disponible';
        $room->client_id = NULL;
        $room->save();
    }


      public function listRoomActive(Request $request)
    {

       if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;

        if ($search==''){
            $room = Room::leftJoin('customers','rooms.client_id' ,'=', 'customers.id')
                        ->join('type_rooms','rooms.type_room_id', '=', 'type_rooms.id')
                        ->select('rooms.id', 'rooms.state','type_rooms.name_type_room',
                        'rooms.number','rooms.price','rooms.client_id','rooms.condition',
                        'rooms.price_air','rooms.frozen','rooms.number_facture',
                        'rooms.state','customers.firstSurname_client','customers.cedula_client',
                        'customers.name_client','customers.nationality_client','customers.phone_client',
                        'customers.secondSurname_client')
                        ->where('condition','=','1')
                        ->orderBy('id', 'asc')->paginate(9);
        }
        else{
            $room = Room::leftJoin('customers','rooms.client_id' ,'=', 'customers.id')
                        ->join('type_rooms','rooms.type_room_id', '=', 'type_rooms.id')
                        ->select('rooms.id', 'rooms.state','type_rooms.name_type_room',
                        'rooms.number','rooms.price','rooms.client_id','rooms.condition',
                        'rooms.price_air','rooms.frozen','rooms.number_facture',
                        'rooms.state','customers.firstSurname_client','customers.cedula_client',
                        'customers.name_client','customers.nationality_client','customers.phone_client',
                        'customers.secondSurname_client')
                        ->where('condition','=','1')
                        ->where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(18);
        }

        return [
                'pagination'      => [
                'total'              => $room->total(),
                'current_page' => $room->currentPage(),
                'per_page'       => $room->perPage(),
                'last_page'      => $room->lastPage(),
                'from'              => $room->firstItem(),
                'to'                  => $room->lastItem(),
            ],
            'room' => $room
        ];
    }

    public function moveRoom(Request $request)
    {
        $room = Room::select('id','number')
                        ->where([['condition','=','1'] , ['state','=','Disponible']])
                        ->orderBy('id', 'asc')->get();

        return $room;
    }

    public function listReservation(Request $request)
    {
    //    if (!$request->ajax()) return redirect('/');


        $rooms = Room::select('id','number')
                    ->where('condition','=','1')
                    ->orderBy('id', 'asc')->get();

        return $rooms;
    }
}
