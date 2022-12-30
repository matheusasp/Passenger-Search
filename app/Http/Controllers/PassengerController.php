<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetPassengerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Passenger;
use App\Repository\PassengerRepository;
use App\Repository\PartnerRepository;
use App\Repository\DestinyGroupRepository;
use App\Repository\LogsRepository;
use App\Models\Partner;

class PassengerController extends Controller
{

    public function __construct(PassengerRepository $passengerRepository, PartnerRepository $partnerRepository, DestinyGroupRepository $destinyGroupRepository, LogsRepository $logsRepository  ) {
        $this->passengerRepository = $passengerRepository;
        $this->partnerRepository = $partnerRepository;
        $this->destinyGroupRepository = $destinyGroupRepository;
        $this->logsRepository = $logsRepository;
    }
    
    public function getPassanger(GetPassengerRequest $request) {



        if($request->exists('cpf')){
            $dataSearch = $request->validate($request->cpf);
            $data = $this->passengerRepository->findByDoc( $dataSearch );
            $title = "CPF";
        }else if($request->exists('ticket')){
            $dataSearch = $request->ticket;
            $data = $this->passengerRepository->findByTicket( $dataSearch );
            $title = "Ticket";
        }
        $logData = ['user' => auth()->user()->id,
                    'operation' => $title,
                    'searched' => $dataSearch
        ];
        $this->logsRepository->create($logData);

        if(count($data)==0) {
            return view('show-info', [
                "search" => "Não foi localizado bilhete com $title: $dataSearch" 
            ]);
        } else {
            return view('show-info', [
                "data" => $data->toArray(),
                "search" => "Resultado de busca com o $title: $dataSearch"
            ]);
        }

    }
    

    public function getDashboard($partner_id) {

        $data = $this->passengerRepository->dashboardInfo($partner_id);
        $partner = Partner::all();

        return view('show-info-dashboard', [
            "dashboardData" => $data->toArray(),
            'partners' => $partner,
        ]);
    }

    public function listStore(Request $request)
    {
    
        return $this->getDashboard($request->partner);
    }
   

    public function listPartner() {

        $partner = Partner::all();
        return view('show-info-dashboard', [
            "partners" => $partner,
        ]);
    }


}
