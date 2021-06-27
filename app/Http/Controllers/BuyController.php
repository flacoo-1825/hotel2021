<?php

namespace App\Http\Controllers;
use App\Buy;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $buys = Buy::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $buys = Buy::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $buys->total(),
                'current_page' => $buys->currentPage(),
                'per_page'       => $buys->perPage(),
                'last_page'      => $buys->lastPage(),
                'from'              => $buys->firstItem(),
                'to'                  => $buys->lastItem(),
            ],
            'buys' => $buys
        ];
        // $buys = buy::get();
        // return $buys;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            // $buy=buy::create($request->all()); 
            $listBuy = $request->listBuy;
            $number_bill_buy = $request->number_bill_buy;
            $class_pay = $request->class_buy;
            $provider_id = $request->provider_id;
            $date_pay = $request->date_pay;
            $number_bill = $request->number_bill;
            $worker_id = 1;

            for ($i=0; $i < count($listBuy) ; $i++) { 
                $buy = new Buy();
                $buy->number_bill = $number_bill;
                $buy->product_id = $listBuy[$i]['product_id'] ;
                $buy->provider_id = $provider_id;
                $buy->worker_id = $worker_id;
                $buy->taxe_id = NULL ;
                $buy->number_bill_buy = $number_bill_buy;
                $buy->class_pay = $class_pay;
                $buy->date_pay = $date_pay;
                $buy->quantity_buy = $listBuy[$i]['cantidad_product'] ;
                $buy->price_unit_buy = $listBuy[$i]['sale_product'] ;
                $buy->description_buy = 'here';
                $buy->dian_bill = 'No' ;
                $buy->total_buy = $listBuy[$i]['total'] ;
                $buy->state_buy = 0 ;
                $buy->save();
            }
          
    }

    

    public function update(Request $request)
    {		
        if (!$request->ajax()) return redirect('/');
             
        $listbuy = $request->buy;
        $number_reception = $request->number_reception;

        for ($i=0; $i < count($listbuy) ; $i++) { 

            $buy =  Buy::findOrFail($listbuy[$i]['id']);
           
            $buy->number_bill_buys = $number_reception;
            $buy->state_bill = 0 ;
            $buy->save();
        }
  
    }


    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $buy =  Buy::findOrFail($request->id);
        $buy->condition_buy = '1';
        $buy->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $buy =  Buy::findOrFail($request->id);
        $buy->condition_buy = '0';
        $buy->save();
    }


      public function listbuys(Request $request)
    {   
         
       if (!$request->ajax()) return redirect('/');

        $number_facture = $request->number_facture;

        $buys = Buy::join('products', 'buys.product_id', '=' ,'products.id')
                        ->select('buys.id','buys.number_bill_buys','buys.quantity_buys',
                        'buys.price_unit_buys','buys.total_buys','products.name_product')
                        ->where('number_bill_buys','=',$number_facture)
                        ->orderBy('id', 'desc')->get();
       
        // return [
                
        //     'buys' => $buys
        // ];

        return $buys;
    }
}

