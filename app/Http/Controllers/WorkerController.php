<?php

namespace App\Http\Controllers;
use App\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
         
        if ($search==''){
            $workers = Worker::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $workers = Worker::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $workers->total(),
                'current_page' => $workers->currentPage(),
                'per_page'       => $workers->perPage(),
                'last_page'      => $workers->lastPage(),
                'from'              => $workers->firstItem(),
                'to'                  => $workers->lastItem(),
            ],
            'workers' => $workers
        ];
        // $rooms = TypeRoom::get();
        // return $rooms;
      
    }


    public function store(Request $request)
    {     
            if (!$request->ajax()) return redirect('/');
            $workers=Worker::create($request->all());

    }

    

    public function update(Request $request)
    {		
       		
       		if (!$request->ajax()) return redirect('/');

            $workers =  Worker::findOrFail($request->id);

            $workers->cedula_worker = $request->cedula_worker;
            $workers->link_id = $request->link_id;
            $workers->name_worker = $request->name_worker;
            $workers->firstSurname_worker = $request->firstSurname_worker;
            $workers->secondSurname_worker = $request->secondSurname_worker;
            $workers->birth_date_worker = $request->birth_date_worker;
            $workers->gender_worker = $request->gender_worker;
            $workers->age_worker = $request->age_worker;
            $workers->scholarship_worker = $request->scholarship_worker;
            $workers->number_children_worker = $request->number_children_worker;
            $workers->state_worker = $request->state_worker;
            $workers->phone_worker = $request->phone_worker;
            $workers->address_worker = $request->address_worker;
            $workers->email_worker = $request->email_worker;
            $workers->password_worker = bcrypt($request->password_worker);
            $workers->condition_worker = '1';
            $workers->save();
            
    }


    public function activo(Request $request)
    {	
      	
      	if (!$request->ajax()) return redirect('/');

        $workers =  Worker::findOrFail($request->id);
        $workers->condition_worker = '1';
        $workers->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $workers =  Worker::findOrFail($request->id);
        $workers->condition_worker = '0';
        $workers->save();
    }




}
