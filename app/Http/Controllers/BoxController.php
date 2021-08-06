<?php

namespace App\Http\Controllers;
use App\Box;
use DB;
use App\Bill;
use App\Buy;
use App\Sale;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $search = $request->search;
        $valor = $request->valor;
        if ($search==''){
            $boxes = Box::orderBy('id', 'desc')->paginate(10);
        }
        else{
            $boxes = Box::where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }

        return [
                'pagination'      => [
                'total'              => $boxes->total(),
                'current_page' => $boxes->currentPage(),
                'per_page'       => $boxes->perPage(),
                'last_page'      => $boxes->lastPage(),
                'from'              => $boxes->firstItem(),
                'to'                  => $boxes->lastItem(),
            ],
            'boxes' => $boxes
        ];
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

    public function ToChecked(Request $request)
    {
        $box = Box::findOrFail($request->id);
        $box->condition_box = $request->condition_box;
        $box->save();

    }
    public function searchBox(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
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

    public function selectDay($dato)
    {
        switch ($dato) {
            case 1:
                $monthNow = 'enero';
                $daysMonth = 31;
                break;
            case 2:
                $monthNow = 'febrero';
                $daysMonth = 28;
                break;
            case 3:
                $monthNow = 'marzo';
                $daysMonth = 31;
                break;
            case 4:
                $monthNow = 'abril';
                $daysMonth = 30;
                break;
            case 5:
                $monthNow = 'mayo';
                $daysMonth = 31;
                break;
            case 6:
                $monthNow = 'junio';
                $daysMonth = 30;
                break;
            case 7:
                $monthNow = 'julio';
                $daysMonth = 31;
                break;
            case 8:
                $monthNow = 'agosto';
                $daysMonth = 31;
                break;
            case 9:
                $monthNow = 'septiembre';
                $daysMonth = 30;
                break;
            case 10:
                $monthNow = 'octubre';
                $daysMonth = 31;
                break;
            case 11:
                $monthNow = 'noviembre';
                $daysMonth = 30;
                break;
            case 12:
                $monthNow = 'diciembre';
                $daysMonth = 31;
                break;
        }

        return $daysMonth;
    }

    public function numberDay($dato)
    {
        switch ($dato) {
            case 'lunes':
                $days = 0;
                break;
            case 'martes':
                $days = 1;
                break;
            case 'miércoles':
                $days = 2;
                break;
            case 'jueves':
                $days = 3;
                break;
            case 'viernes':
                $days = 4;
                break;
            case 'sábado':
                $days = 5;
                break;
            case 'domingo':
                $days = 6;
                break;
        }

        return $days;
    }

    public function arrayMonths(){
        $numberMonth = Carbon::now()->month;
        $ventasmes=DB::select('SELECT  DATE_FORMAT(created_at,"%c") as mes, sum(total_bill) as totalmes from bills where class_bill="Venta" group by mes order by month(created_at) asc limit 12');
        $months = [];
        $j=0;
        for ($i=0; $i <count($ventasmes) ; $i++) {
            while($j+1<$ventasmes[$i]->mes && $ventasmes[$i]->mes <= $numberMonth){
                $months[$j]= 0;
                $j+=1;
            }
            if($ventasmes[$i]->mes <= $numberMonth){
                $months[$j]= $ventasmes[$i]->totalmes;
                $j+=1;
            }
        }
        return $months;
    }

    public function firstPanel(Request $request)
    {
        $hour = '00';
        $minute = '10';
        $second = '30';
        $dayString = Carbon::now()->toDateString();
        $dayCreate = Carbon::createFromDate($dayString,$hour, $minute, $second)->toDateTimeString();
        $dayNow = Carbon::now()->toDateTimeString();
        $dayNow = Carbon::now()->locale('es')->dayName;
        $numberDay = Carbon::now()->day;
        $numberMonth = Carbon::now()->locale('es')->month;

        $dataMonth = $this->selectDay($numberMonth);
        $days = $this->numberDay($dayNow);
        // $comprasmes=DB::select('SELECT monthname(created_at) as mes, sum(total_bill) as totalmes from bills where class_bill="Venta" group by monthname(created_at) order by month(created_at) desc limit 12');

        
        // $ventasdia=DB::select('SELECT DATE_FORMAT(created_at,"%d/%m/%Y") as dia, sum(total_bill) as totaldia from bills where class_bill="Venta" group by dia order by day(created_at) desc limit 15');
        // $ventasdia=DB::select('SELECT DATE_FORMAT(created_at,"%d") as dia, sum(total_bill) as totaldia from bills where class_bill="Venta" group by dia order by day(created_at) desc limit 14');
        $ventasdia=DB::select('SELECT DATE_FORMAT(created_at,"%e") as dia, sum(total_bill) as totaldia from bills where class_bill="Venta" group by dia order by id desc limit 14');
        $manyDays = count($ventasdia);
        $arrayBuyDays = [];
        $j = 0;
        for ($i=0; $i < count($ventasdia) ; $i++) {
            while($numberDay > $ventasdia[$i]->dia){
                $arrayBuyDays[$j] = 0;
                $numberDay-=1;
                $j += 1;
            }
            if($numberDay == 0){
                $numberMonth -=1;
                $numberDay = $this->selectDay($numberMonth);
                $arrayBuyDays[$j] = $ventasdia[$i]->totaldia;
                $numberDay-=1;
                $j += 1;
            }else{
                $arrayBuyDays[$j] = $ventasdia[$i]->totaldia;
                $numberDay-=1;
                $j += 1;
            }
        }

        // $productosvendidos=DB::select('SELECT p.nombre as producto, sum(dv.cantidad) as cantidad from productos p inner join detalle_ventas dv on p.id=dv.idproducto inner join bills on dv.idventa=v.id where class_bill="Venta" and year(created_at)=year(curdate()) group by p.nombre order by sum(dv.cantidad) desc limit 10');

        // $totales=DB::select('SELECT (select ifnull(sum(total_bill),0) from bills where DATE(created_at)=curdate() and class_bill="Venta") as totalcompra, (select ifnull(sum(total_bill),0) from bills where DATE(created_at)=curdate() and v.estado="Registrado") as totalventa');

        // $ventasmes=DB::select('SELECT monthname(created_at) as mes, sum(total_bill) as totalmes from bills  where class_bill="Venta" group by monthname(created_at) order by month(created_at) desc limit 12');

        $saleDay = Bill::where([
                            ['class_bill','=','Venta']
                        ])
                        ->whereBetween('created_at', [$dayString, $dayNow])
                        ->sum('total_bill');
        
        $manyRoom = DB::select('SELECT (state) as stateRoom, count(state) as manyRoom from rooms group by stateRoom asc limit 14');
        // $monthly = DB::table('bills')->select(DB::raw("DATE_FORMAT(created_at,'%M %Y') AS months"))
        // ->select('created_at', DB::raw('SUM(total_bill) as total'))
        // ->where('class_bill', '=', 'Venta')
        // ->select(DB::raw("DATE_FORMAT(created_at,'%M %Y') AS months"))
        // ->groupBy('created_at')
        // ->get();
        // ->sum('total_bill , created_at')
        // return $ventasdia;

        // $teams = DB::table('bills')
        // ->select(DB::raw('id,(SELECT DATE_FORMAT(created_at,"%W")) AS day'))
        // ->orderBy('id', 'desc')->take(14)->get();
        return [
            $manyRoom,
            $arrayBuyDays,
            $ventasdia,
            $arrayBuyDays,
            $days,
        ];
    }
}
