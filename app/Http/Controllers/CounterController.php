<?php

namespace App\Http\Controllers;
use App\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
        
        $counter = Counter::all();
       
        return $counter;
    }


    public function update(Request $request)
    {		
       		
       	if (!$request->ajax()) return redirect('/');

        //$option = 0;
        $option = $request->option;
        $id = 1;
        $counter =  Counter::findOrFail($id);
        
        switch($option){
            case 1 : {

                $counter->number_check = $request->number_check+1;
                $counter->save();

            break;
            };

            case 2 : {

                $counter->number_ticket = $request->number_ticket+1;
                $counter->save();

            break;
            };

            case 3 : {

                $counter->number_certificate = $request->number_certificate+1;
                $counter->save();

            break;
            };

            case 4 : {

                $counter->number_reception = $request->number_reception+1;
                $counter->save();

            break;
            };

            case 5 : {

                $counter->number_ext = $request->number_ext;
                $counter->save();

            break;
            };

            case 6 : {

                $counter->number_buy = $request->number_buy+1;
                $counter->save();

            break;
            };

            case 7 : {

                $counter->number_ticket = $request->number_ticket;
                $counter->end_ticket = $request->end_ticket;
                $counter->number_certificate = $request->number_certificate;
                $counter->end_certificate = $request->end_certificate;
                $counter->number_reception = $request->number_reception;
                $counter->end_reception = $request->end_reception;
                $counter->number_ext = $request->number_ext;
                $counter->end_ext = $request->end_ext;
                $counter->save();

            break;
            };
          
        }
       
            
    }


      public function searchCheck(Request $request)
    {   
        if (!$request->ajax()) return redirect('/');
        $check = counter::select('number_check','end_check')->get();
        return  $check;
    }

    public function searchTicket(Request $request)
    {   
        if (!$request->ajax()) return redirect('/');
        $ticket = counter::select('number_ticket','end_ticket')->get();
        return  $ticket;
    }

    public function searchCertificate(Request $request)
    {   
        if (!$request->ajax()) return redirect('/');
        $certificate = counter::select('number_certificate','end_certificate')->get();
        return  $certificate;
    }

    public function searchReception(Request $request)
    {   
        if (!$request->ajax()) return redirect('/');
        $reception = counter::select('number_reception','end_reception')->get();
        return  $reception;
    }

    public function searchExt(Request $request)
    {   
        if (!$request->ajax()) return redirect('/');
        $ext = counter::select('number_ext','end_ext')->get();
        return  $ext;
    }

    public function searchBuy(Request $request)
    {   
        if (!$request->ajax()) return redirect('/');
        $buy = counter::select('number_buy','end_buy')->get();
        return  $buy;
    }
}
