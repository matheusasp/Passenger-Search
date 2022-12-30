<?php

namespace App\Repository;

use App\Models\Passenger;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\UserPartners;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Partner;

class PassengerRepository 
{
    protected $model;

    public function __construct(Passenger $passenger)
    {
        $this->model = $passenger;
        $this->model->setConnection('hero');
    }


    public function all()
    {
        return $this->model->orderBy('name')->get();
    }

    public function find($id): Passenger
    {

    return $this->model->whereId($id)->firstOrFail();

    }

    public function findByDoc($doc)
    {
        return $this->model->select(
            'partner_id',
            'destiny_group_id',
            'departure',
            'arrival',
            'cpf',
            'ticket',
            'status',
            'pdf',
            'pdf_unique'
        )
        ->with('destinyGroup:id,name','partner:id,name')->orderBy('departure', 'desc')
        ->whereCpf($doc)->get();
    }

    public function findByTicket($ticket)
    {
        return $this->model->select(
            'partner_id',
            'destiny_group_id',
            'departure',
            'arrival',
            'cpf',
            'ticket',
            'status',
            'pdf',
            'pdf_unique'
        )
        ->with('destinyGroup:id,name','partner:id,name')->orderBy('departure', 'desc')
        ->whereTicket($ticket)->get();

    }


    public function dashboardInfo($partnerId) {

        $currentMonth = Carbon::now()->month;
        $nextMonth = Carbon::now()->addMonth()->month;

       return $this->model->select(
                    'partner_id',
                    'destiny_group_id',
                    'departure',
                    'arrival',
                    'cpf',
                    'ticket',
                    'status',
                    'pdf',
                    'pdf_unique'
                )->where('partner_id', $partnerId)
                ->where(function($query) use ($currentMonth, $nextMonth) {
                    $query->whereMonth('departure', $currentMonth)
                          ->orWhereMonth('departure', $nextMonth);
                })
                ->with('destinyGroup:id,name','partner:id,name')->orderBy('departure', 'asc')->paginate(50);      
    }

}