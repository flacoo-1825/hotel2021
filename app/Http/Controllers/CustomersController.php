<?php

namespace App\Http\Controllers;
use App\Customers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class CustomersController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $customers = Customers::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $customers = Customers::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $customers->total(),
                'current_page' => $customers->currentPage(),
                'per_page'       => $customers->perPage(),
                'last_page'      => $customers->lastPage(),
                'from'              => $customers->firstItem(),
                'to'                  => $customers->lastItem(),
            ],
            'customers' => $customers
        ];
        // $rooms = Customers::get();
        // return $rooms;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            $customers=Customers::create($request->all());

    }

    

    public function update(Request $request)
    {		
       		
            if (!$request->ajax()) return redirect('/');

            $customers =  Customers::findOrFail($request->id) ;

            $customers->cedula_client = $request->cedula_client;
            $customers->name_client = $request->name_client;
            $customers->firstSurname_client = $request->firstSurname_client;
            $customers->secondSurname_client = $request->secondSurname_client;
            $customers->birth_date_client = $request->birth_date_client;
            $customers->gender_client = $request->gender_client;
            $customers->age_client = $request->age_client;
            $customers->address_client = $request->address_client;
            $customers->city_client = $request->city_client;
            $customers->nationality_client = $request->nationality_client;
            $customers->state_client = $request->state_client;
            $customers->phone_client = $request->phone_client;
            $customers->email_client = $request->email_client;
            $customers->save();
            
    }


    public function searchClient(Request $request){

        // $cc_customers = '2425';

        if (!$request->ajax()) return redirect('/');
        $cc_customers = $request->cc_client;
        $customers = Customers::where('cedula_client',$cc_customers)->first();
        if (!$customers) {
            return ['client'=>['name_client'=>'Usuario no registrado']];
        }else{
            $customers = Customers::where('cedula_client' ,$cc_customers)
                        // ->select('id','cedula_client','name_client','firstSurname_client','secondSurname_client',
                        // 'narionality_client')
                        ->get();

            return ['client'=>$customers[0]];
        }

     }

     public function searchCustomer(Request $request){

        // $customer_id = 1;

        if (!$request->ajax()) return redirect('/');
        $customer_id = $request->customer_id;
        $customer = Customers::where('id','=',$customer_id)
                                ->select('id','cedula_client','name_client','firstSurname_client',
                                'secondSurname_client','nationality_client','phone_client','email_client')
                                ->get();
         return $customer;

     }

     public function pdfCustomers(Request $request){

        // $customer_id = 1;

        // if (!$request->ajax()) return redirect('/');
        // $customer_id = $request->customer_id;
        // $customer = Customers::select('id','cedula_client','name_client','firstSurname_client',
        //                         'secondSurname_client','nationality_client','phone_client','email_client')
        //                         ->get();

        $customers = Customers::select('id','name_client')
                                ->get();
        $pdf = PDF::loadView('pdf.clients',compact('customers'));

         return $pdf->download('clients-list.pdf');

     }



}
