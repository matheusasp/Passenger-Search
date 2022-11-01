<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetPassengerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Passenger;
use App\Repository\PassengerRepository;
use App\Repository\PartnerRepository;
use App\Repository\DestinyGroupRepository;

class PassengerController extends Controller
{

    public function __construct(PassengerRepository $passengerRepository, PartnerRepository $partnerRepository, DestinyGroupRepository $destinyGroupRepository  ) {
        $this->passengerRepository = $passengerRepository;
        $this->partnerRepository = $partnerRepository;
        $this->destinyGroupRepository = $destinyGroupRepository;
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
    

   

}
