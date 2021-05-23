<?php

namespace App\Http\Controllers;
use App\Box;
use DB;
use App\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $box = Box::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request)
    {
        $box = Box::findOrFail($request->id);
       
        $box->efecty_box = $request->efecty_box;
        $box->credit_box = $request->credit_box;
        $box->buy_box = $request->buy_box;
        $box->difference_box = $request->difference_box;
        $box->state_box = $request->state_box;
        $box->description_box = $request->description_box;
        $box->efecty_soft_box = $request->efecty_soft_box;
        $box->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function searchBox(Request $request)
    {
    //    if (!$request->ajax()) return redirect('/');
        $id = 1;

        $box = Box::where([
                        ['worker_id','=',$id],
                        [ 'state_box', '=', 'open']
                    ])
                    ->select('id','number_box','open_efecty_box','download_box','created_at','description_box')
                    ->get();

        // $ventasdia=DB::select('SELECT DATE_FORMAT(b.created_at,"%d/%m/%Y") as dia, sum(b.total_bill) as totaldia from bills b where b.class_bill="Venta" group by b.created_at order by day(b.created_at) desc limit 15');
        // $ventasdia =  Bill::where([
        //     ['created_at','=', $box[0]->created_at],
        //     ['class_bill','=', 'Venta']
        // ])
        // ->sum('total_bill')
        // ->get();
        // $ventasdia =  DB::table('bills')->where([
        //         ['created_at','=', $box[0]->created_at],
        //         ['class_bill','=', 'Venta']
        //     ])->sum('total_bill');
        //      dd($ventasdia);
        // return $box[0]->created_at;
        // 
        // $ventasdia =  DB::table('bills')->where('class_bill','=', 'Venta')->sum('total_bill');
            // $dia =new Carbon();
        // $ventasdia =  Bill::where([['created_at','=', $box[0]->created_at],
        //         ['class_bill','=', 'Venta']])->sum('total_bill');
        // $dato = $box[0]->created_at;
        
        // $ventasdia =  Bill::whereBetween('created_at',[$dato, $dia])->sum('total_bill');

                
        
        // return $ventasdia;
    }
}
