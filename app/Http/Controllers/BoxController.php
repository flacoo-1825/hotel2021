<?php

namespace App\Http\Controllers;
use App\Box;
use DB;
use App\Bill;
use App\Buy;
use App\Sale;
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
                    ->select('id','number_box','open_efecty_box','credit_box','download_box','created_at','description_box')
                    ->get();

        $count = count($box);
        $search = 'Recept'; 
        $attribute = 'number_bill_sales';
        // $rooms = Room::where($attrivute, 'like', '%'. $search . '%')->orderBy('id', 'asc')->paginate(10);
        if ($count > 0) {
            $day = Carbon::now()->toDateTimeString();
            $day_created = Carbon::parse($box[0]->created_at)->toDateTimeString();
            $sale_room_turne = Bill::where([
                                        ['worker_id', '=', $id],
                                        ['class_bill', '=', 'Venta'],
                                        ['pay_bill', '=', 'Efecty']
                                    ])
                                    ->whereBetween('created_at', [$day_created, $day])
                                    ->sum('total_bill');

            $credit_room_turne = Bill::where([
                                        ['worker_id', '=', $id],
                                        ['class_bill', '=', 'Venta'],
                                        ['pay_bill', '=', 'Credit']
                                    ])
                                    ->whereBetween('created_at', [$day_created, $day])
                                    ->sum('total_bill');

            $sale_reception_turne = Sale::where([
                                            ['worker_id', $id],
                                            [$attribute, 'like', '%'. $search . '%']
                                        ])
                                        ->whereBetween('created_at', [$day_created, $day])
                                        ->sum('total_sales');
            $buy_turne = Buy::where([
                                        ['worker_id', '=', $id]
                                    ])
                                    ->whereBetween('created_at', [$day_created, $day])
                                    ->sum('total_buy');


            return  [
                        'sale_reception_turne'=>$sale_reception_turne,
                        'credit_room_turne'=>$credit_room_turne,
                        'sale_room_turne'=>$sale_room_turne,
                        'buy_turne' => $buy_turne,
                        'box' => $box
                    ];
            // return  ['from'=>$day_created,
            //         'to'=>$day];
        }else{
            $box[0] = 'closed';
            return [
                'box'=>$box
            ];
        }
    }
}
