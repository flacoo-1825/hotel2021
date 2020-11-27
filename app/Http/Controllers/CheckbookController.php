<?php

namespace App\Http\Controllers;
use App\checkbook;
use Illuminate\Http\Request;

class CheckbookController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $checkbooks = checkbook::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $checkbooks = checkbook::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $checkbooks->total(),
                'current_page' => $checkbooks->currentPage(),
                'per_page'       => $checkbooks->perPage(),
                'last_page'      => $checkbooks->lastPage(),
                'from'              => $checkbooks->firstItem(),
                'to'                  => $checkbooks->lastItem(),
            ],
            'checkbooks' => $checkbooks
        ];
        // $checkbooks = Bill::get();
        // return $checkbooks;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            $bill=checkbook::create($request->all());
     
     

        //     'customer_id' , 
        // 'room_id',
        // 'certificate_id',
        // 'taxe_id',
        // 'number_bill',
        // 'faker_number_bill',
        // 'date_entry_bill',
        // 'date_exit_bill',
        // 'dian_bill',
        // 'total_bill',
        // 'state_bill',
    }

    

    public function update(Request $request)
    {		
               
        $listbill = $request->bill;
        $number_reception = $request->number_reception;

        for ($i=0; $i < count($listbill) ; $i++) { 

            $bill =  checkbook::findOrFail($listbill[$i]['id']);
           
            $bill->number_bill_checkbooks = $number_reception;
            $bill->state_bill = 0 ;
            $bill->save();
        }
  
    }


    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $bill =  checkbook::findOrFail($request->id);
        $bill->condition_bill = '1';
        $bill->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $bill =  checkbook::findOrFail($request->id);
        $bill->condition_bill = '0';
        $bill->save();
    }


      public function listCheckbooks(Request $request)
    {   
         
    //    if (!$request->ajax()) return redirect('/');

        $number_checkbooks = $request->number_checkbooks;
    //    $number_facture = '5848-Recept';

        $checkbooks = checkbook::join('sales', 'checkbooks.number_checkbooks', '=' ,'sales.number_bill_sales')
                        ->leftjoin('products', 'sales.product_id', '=' ,'products.id')
                        ->select('checkbooks.id','checkbooks.number_checkbooks','checkbooks.total_checkbooks',
                        'sales.number_bill_sales','sales.quantity_sales',
                        'sales.price_unit_sales','sales.total_sales','products.name_product')
                        ->where('checkbooks.number_checkbooks','=',$number_checkbooks)
                        ->orderBy('id', 'desc')->get();
       
        // return [
                
        //     'checkbooks' => $checkbooks
        // ];

        return $checkbooks;
    }
}


