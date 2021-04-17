<?php

namespace App\Http\Controllers;
use App\Day;
use Illuminate\Http\Request;

class DayController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $days = Day::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $days = Day::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $days->total(),
                'current_page' => $days->currentPage(),
                'per_page'       => $days->perPage(),
                'last_page'      => $days->lastPage(),
                'from'              => $days->firstItem(),
                'to'                  => $days->lastItem(),
            ],
            'days' => $days
        ];
        // $days = Day::get();
        // return $days;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            $day=Day::create($request->all());

    }

    

    public function update(Request $request)
    {		
       		
       		if (!$request->ajax()) return redirect('/');

            $day =  Day::findOrFail($request->id);

            $day->name_day = $request->name_day;
            $day->description_day = $request->description_day;
            $day->condition_day = '1';
            $day->save();
            
    }

    public function listDays(Request $request)
    {
         if (!$request->ajax()) return redirect('/');

         $number_bill_day = $request->number_facture;
        // $number_bill_day = '4904-Fact';

            $days = Day::select('id','type_frozen_day','quantity_day','many_hours_day','description_day',
                            'price_hour','price_day','date_day','number_bill_day','total_day')
                            ->where('number_bill_day','=',$number_bill_day)
                            ->orderBy('id', 'desc')->get();

            return $days;
    }
      public function listdayActive(Request $request)
    {
       if (!$request->ajax()) return redirect('/');

        $day = Day::where('condition_day','=','1')
                        ->select('id','name_day')
                        ->orderBy('id', 'desc')->get();
        return [
            'day' => $day
        ];
    }
}

