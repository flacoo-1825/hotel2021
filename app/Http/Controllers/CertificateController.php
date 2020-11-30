<?php

namespace App\Http\Controllers;
use App\Certificate;
use App\Companion;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    
	public function index(Request $request)
    {   
         
       	if (!$request->ajax()) return redirect('/');
         $search = $request->search;
         $valor = $request->valor;
       
        if ($search==''){
            $certificates = Certificate::join('customers','certificates.client_id','=','customers.id')
                                ->select('certificates.id', 'certificates.cityOrigin_certificate',
                                'certificates.number_certificate','certificates.cityDestination_certificate',
                                    'certificates.placabike_certificate','certificates.placaCar_certificate',
                                    'certificates.adults_certificate','certificates.children_certificate', 
                                    'certificates.entry_certificate','certificates.exit_certificate',
                                    'certificates.observation_certificate', 'certificates.temperature_entry_client',
                                    'certificates.temperature_exit_client','customers.firstSurname_client',
                                    'customers.cedula_client','customers.email_client','customers.name_client',
                                    'customers.nationality_client','customers.phone_client', 'customers.secondSurname_client')
                                ->where($valor, 'like', '%'. $search . '%')
                                ->orderBy('certificates.id', 'desc')->paginate(9);
        }
        else{
            $certificates = Certificate::join('customers','certificates.client_id','=','customers.id')
                                        ->select('certificates.id', 'certificates.cityOrigin_certificate',
                                        'certificates.number_certificate','certificates.cityDestination_certificate',
                                        'certificates.placabike_certificate','certificates.placaCar_certificate',
                                        'certificates.adults_certificate','certificates.children_certificate', 
                                        'certificates.entry_certificate','certificates.exit_certificate',
                                        'certificates.observation_certificate', 'certificates.temperature_entry_client',
                                        'certificates.temperature_exit_client','customers.firstSurname_client',
                                        'customers.cedula_client','customers.email_client','customers.name_client',
                                        'customers.nationality_client','customers.phone_client','customers.secondSurname_client')
                                        ->where($valor, 'like', '%'. $search . '%')->orderBy('id', 'desc')->paginate(10);
        }
 
        return [
                'pagination'      => [
                'total'              => $certificates->total(),
                'current_page' => $certificates->currentPage(),
                'per_page'       => $certificates->perPage(),
                'last_page'      => $certificates->lastPage(),
                'from'              => $certificates->firstItem(),
                'to'                  => $certificates->lastItem(),
            ],
            'certificates' => $certificates
        ];
    }


    public function store(Request $request)
    {
            if (!$request->ajax()) return redirect('/');
            $certificates=Certificate::create($request->all());
            $ojo  = $request->listAcomp;

            // $certificate = Certificate::find(1);
            // $certificate = Certificate::last(1);
            $certificate=Certificate::all()->last();
            // $certificate = Certificate::find(1)->companions($ojo);
            $certificate->companions()->createMany($ojo);
            // $companions  = $request->listAcomp;
            // $ojo = Certificate::find(1);
            // $certificates = $ojo->companions()->save($companions);
            // $comment = $post->comments()->save($comment);
                // return $companions;
            // $ojo->companions()->save($companions);

            // return $ojo;

    }



    public function update(Request $request)
    {		
       		
            if (!$request->ajax()) return redirect('/');

            $certificates =  Certificate::findOrFail($request->id) ;

            $certificates->client_id = $request->client_id;
            $certificates->cityOrigin_certificate = $request->cityOrigin_certificate;
            $certificates->number_certificate = $request->number_certificate;
            $certificates->temperature_entry_client = $request->temperature_entry_client;
            $certificates->temperature_exit_client = $request->temperature_exit_client;
            $certificates->cityDestination_certificate = $request->cityDestination_certificate;
            $certificates->placabike_certificate = $request->placabike_certificate;
            $certificates->placaCar_certificate = $request->placaCar_certificate;
            $certificates->adults_certificate = $request->adults_certificate;
            $certificates->children_certificate = $request->children_certificate;
            $certificates->entry_certificate = $request->entry_certificate;
            $certificates->exit_certificate = $request->exit_certificate;
            $certificates->observation_certificate = $request->observation_certificate;
            $certificates->save();
            
    }


    public function searchCertificate(Request $request){

        // $cc_certificates = '2425';

        if (!$request->ajax()) return redirect('/');
        $cc_certificates = $request->cc_client;
        $certificates = Certificate::where('cedula_client',$cc_certificates)->first();
        if (!$certificates) {
            return ['client'=>['name_client'=>'Usuario no registrado']];
        }else{
            $certificates = Certificate::where('cedula_client' ,$cc_certificates)
                        // ->select('id','cedula_client','name_client','firstSurname_client','secondSurname_client',
                        // 'narionality_client')
                        ->get();

            return ['client'=>$certificates[0]];
        }

     }



}
