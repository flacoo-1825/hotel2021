<?php

namespace App\Http\Controllers;
use App\Servicie;
use Illuminate\Http\Request;

class ServicieController extends Controller
{
	public function index(Request $request)
    {
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;

        if ($search==''){
            $servicies = Servicie::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $servicies = Servicie::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }

        return [
                'pagination'      => [
                'total'              => $servicies->total(),
                'current_page' => $servicies->currentPage(),
                'per_page'       => $servicies->perPage(),
                'last_page'      => $servicies->lastPage(),
                'from'              => $servicies->firstItem(),
                'to'                  => $servicies->lastItem(),
            ],
            'servicies' => $servicies
        ];
        // $servicies = servicie::get();
        // return $servicies;
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $servicie=Servicie::create($request->all());

    }
    public function update(Request $request)
    {
       		if (!$request->ajax()) return redirect('/');

            $servicie =  Servicie::findOrFail($request->id);

            $servicie->name_servicie = $request->name_servicie;
            $servicie->description_servicie = $request->description_servicie;
            $servicie->price_servicie = $request->price_servicie;
            $servicie->condition_servicie = '1';
            $servicie->save();

    }


    public function activo(Request $request)
    {

      	if (!$request->ajax()) return redirect('/');

        $servicie =  Servicie::findOrFail($request->id);
        $servicie->condition_servicie = '1';
        $servicie->save();
    }



    public function inactivo(Request $request)
    {
     	if (!$request->ajax()) return redirect('/');

        $servicie =  Servicie::findOrFail($request->id);
        $servicie->condition_servicie = '0';
        $servicie->save();
    }



      public function listServicieActive(Request $request)
    {

       if (!$request->ajax()) return redirect('/');
        $name_servicie = $request->search;

        if ($name_servicie=='') {
            $servicie = '';
            return  $servicie;
        }else{
            $servicie = Servicie::where('name_servicie', 'like', '%'. $name_servicie . '%')
            ->where('condition_servicie','=','1')
            ->orderBy('id', 'desc')->get();
            return  $servicie;
        }

    }

}
