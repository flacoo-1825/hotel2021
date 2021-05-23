<?php

namespace App\Http\Controllers;
use App\bill;
use App\Sale;
use App\Buy;
use App\Counter;
use App\Day;
use App\Additional;
use Illuminate\Http\Request;

class BillController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	// if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $bills = Bill::select('id','number_bill','total_bill')
                            ->orderBy('id', 'desc')->paginate(10);
        }
        else{
            $bills = Bill::select('id','number_bill','total_bill')
                            ->where($valor, 'like', '%'. $search . '%')
                            ->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $bills->total(),
                'current_page' => $bills->currentPage(),
                'per_page'       => $bills->perPage(),
                'last_page'      => $bills->lastPage(),
                'from'              => $bills->firstItem(),
                'to'                  => $bills->lastItem(),
            ],
            'bills' => $bills
        ];
    }

    public function indexBuy(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $bills = Bill::where('class_bill','=','Compra')
                        ->orderBy('id', 'desc')->paginate(10);
        }
        else{
            $bills = Bill::where('class_bill','=','Compra')
                        ->where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $bills->total(),
                'current_page' => $bills->currentPage(),
                'per_page'       => $bills->perPage(),
                'last_page'      => $bills->lastPage(),
                'from'              => $bills->firstItem(),
                'to'                  => $bills->lastItem(),
            ],
            'bills' => $bills
        ];
    }

    public function billDetail(Request $request)
    {
       	// if (!$request->ajax()) return redirect('/');
         $id = $request->id_bill;
         $bill = Bill::findOrFail($id);
         $room = $bill['room_id'];
         $number_facture = $bill['number_bill'];
         $customer = $bill['customer_id'];
         $worker = $bill['worker_id'];
         $faker_number_bill = $bill['faker_number_bill'];
        //  return $number_facture;
         $billDetail = Bill::join('rooms', 'bills.room_id', '=' ,'rooms.id')
                        ->join('customers', 'bills.customer_id', '=' ,'customers.id')
                        ->join('certificates', 'bills.certificate_id', '=' ,'certificates.id')
                        // ->join('workers', 'bills.worker_id', '=' ,'workers.id')
                        ->select('bills.id','bills.number_bill','bills.number_certificate','bills.date_entry_bill',
                        'bills.date_exit_bill','bills.total_bill','bills.name_type_room','bills.total_products',
                        'bills.total_additionals','bills.total_days','bills.description_bill',
                        'customers.name_client','customers.firstSurname_client','customers.cedula_client',
                        'customers.name_client','customers.nationality_client','customers.phone_client', 
                        'customers.secondSurname_client','rooms.number','rooms.price','rooms.client_id',
                        'rooms.condition','rooms.price_air','rooms.frozen')
                        ->where('bills.number_bill','=',$number_facture)
                        ->get();
        
         $days = Day::where('number_bill_day','=', $faker_number_bill)
                    ->orderBy('id', 'desc')
                    ->get();
        
         $sales = Sale::join('products', 'sales.product_id', '=' ,'products.id')
                        ->select('sales.id','sales.number_bill_sales','sales.quantity_sales',
                        'sales.price_unit_sales','sales.total_sales','products.name_product')
                        ->where('number_bill_sales','=',$faker_number_bill)
                        ->orderBy('id', 'desc')->get();

         $additionals =  Additional::where('number_facture_additional','=', $number_facture)
                        ->orderBy('id', 'desc')
                        ->get();
        return [
            'billDetail' => $billDetail,
            'days' => $days,
            'sales' => $sales,
            'sales' => $sales,
            'additionals' => $additionals
        ];
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            $bill=bill::create($request->all());
            
    }

    

    public function update(Request $request)
    {		
               
        $listbill = $request->bill;
        $number_reception = $request->number_reception;

        for ($i=0; $i < count($listbill) ; $i++) { 

            $bill =  Bill::findOrFail($listbill[$i]['id']);
           
            $bill->number_bill_bills = $number_reception;
            $bill->state_bill = 0 ;
            $bill->save();
        }
  
    }


    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $bill =  Bill::findOrFail($request->id);
        $bill->state_bill = '1';
        $bill->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $bill =  Bill::findOrFail($request->id);
        $bill->condition_bill = '0';
        $bill->save();
    }


      public function listBills(Request $request)
    {   
         
       if (!$request->ajax()) return redirect('/');

        // $number_facture = '4604Fact';
        $number_facture = $request->number_bill;
        
        $bills = Bill::join('rooms', 'bills.room_id', '=' ,'rooms.id')
                        ->join('customers', 'bills.customer_id', '=' ,'customers.id')
                        ->join('certificates', 'bills.certificate_id', '=' ,'certificates.id')
                        ->select('bills.id','bills.number_bill','bills.date_entry_bill',
                        'bills.date_exit_bill','bills.total_bill',
                        'customers.name_client','customers.firstSurname_client','customers.cedula_client',
                        'customers.name_client','customers.nationality_client','customers.phone_client', 
                        'customers.secondSurname_client','rooms.number','rooms.price','rooms.client_id',
                        'rooms.condition','rooms.price_air','rooms.frozen')
                        ->where('bills.number_bill','=',$number_facture)
                        ->orderBy('id', 'desc')->get();
      
        $sales = Sale::join('products', 'sales.product_id', '=' ,'products.id')
        ->select('sales.id','sales.number_bill_sales','sales.quantity_sales',
        'sales.price_unit_sales','sales.total_sales','products.name_product')
        ->where('number_bill_sales','=',$number_facture)
        ->orderBy('id', 'desc')->get();
       
        return [
                
            'bills' => $bills,
            'sales' => $sales
        ];

        // return $bills;
    }

    public function detailsBillsBuy(Request $request)
    {   
         
       if (!$request->ajax()) return redirect('/');

        // $number_facture = '4604Fact';
        $number_facture = $request->number_bill_buy;
        
        $bills = Bill::join('providers', 'bills.provider_id', '=' ,'providers.id')
                    ->select('bills.id','bills.number_bill','bills.date_entry_bill',
                    'bills.date_exit_bill','bills.total_bill', 'bills.state_bill',
                    'providers.nit_provider','bills.description_bill',
                    'providers.company_provider','providers.name_provider',
                    'providers.phone_provider','providers.email_provider')
                    ->where('bills.number_bill','=',$number_facture)
                    ->orderBy('id', 'desc')->get(); 

        $buys = Buy::join('products', 'buys.product_id', '=' ,'products.id')
                    ->select('buys.id','buys.number_bill_buy','buys.quantity_buy',
                    'buys.price_unit_buy','buys.class_pay','buys.date_pay',
                    'buys.total_buy','products.name_product','products.img_product')
                    ->where('number_bill','=',$number_facture)
                    ->orderBy('id', 'desc')->get();
       
        return [
                
            'bills' => $bills,
            'buys' => $buys
        ];

        // return $bills;
    }
}

