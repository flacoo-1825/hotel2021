<?php

namespace App\Http\Controllers;
use App\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        
        
    // if(request()->ajax())
    // {
    // $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
    // $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
    // $data = Reservation::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
    // return Response::json($data);
    // }
        // $data['eventos']=Reservation::all();
        // return Response()->json($data['eventos']);
        $data = reservation::all();
        return $data;
    }


    public function store(Request $request)
    {     
        if (!$request->ajax()) return redirect('/');
        $reservation=Reservation::create($request->all());

    }

    

    public function update(Request $request)
    {		
       		
        if (!$request->ajax()) return redirect('/');

        $reservation =  Reservation::findOrFail($request->id);

        $reservation->room_id = $request->room_id;
        $reservation->customer_id = $request->customer_id;
        $reservation->title = $request->title;
        $reservation->start = $request->start;
        $reservation->end = $request->end;
        $reservation->color = $request->color;
        $reservation->textColor = $request->textColor;
        $reservation->save(); 
            
    }

    public function destroy(Request $request)
    {		
       		
       		if (!$request->ajax()) return redirect('/');
            $id = $request->reservation_id;
            $reservation =  Reservation::findOrFail($id);
            $reservation->delete();
            
            
    }
}
