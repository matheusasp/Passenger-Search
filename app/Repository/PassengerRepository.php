<?php

namespace App\Repository;

use App\Models\Passenger;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\UserPartners;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Partner;
use App\Models\Dashboards;
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
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

        $currentMonth = Carbon::now()->month;
        $nextMonth = Carbon::now()->addMonth()->month;

        $data = new Dashboards();

      //  dd($data->first()->created_at);
        //dd();
        if(Carbon::now()->toDateString() > $data->first()->created_at) {
            $currentMonth = $this->model->select(
                'partner_id',
                'destiny_group_id',
                'departure',
                'arrival',
                'status',
              )->where('status', 1)->distinct()->where('departure', '<', Carbon::now())
                ->whereMonth('arrival', Carbon::now()->month)
                ->get()->groupBy('destiny_group_id');

            $nextMonth = $this->model->select(
                'partner_id',
                'destiny_group_id',
                'departure',
                'arrival',
                'status',
                )->where('status', 1)->distinct()->where('departure', '<', Carbon::now())
                 ->whereMonth('arrival', Carbon::now()->addMonth()->month)
                 ->get()->groupBy('destiny_group_id');
                
            $currentMonthCache = json_encode($currentMonth->toArray());
            $nextMonthCache = json_encode($nextMonth->toArray());
                  
        
        
            $data->current_month = $currentMonthCache;
            $data->next_month =  $nextMonthCache;
            $data->save();
                
            $data = [
                 'current_month' => $currentMonth->toArray(),
                 'next_month' => $nextMonth->toArray(),
             ];
        
            return $data;
        }

        $data = $data->first();

        $data = [
            'current_month' => json_decode($data->current_month),
            'next_month' => json_decode($data->next_month),
        ]; 

        return $data;



       /* $currentMonth = $this->model->select(
            'partner_id',
            'destiny_group_id',
            'departure',
            'arrival',
            'cpf',
            'ticket',
            'status',
            'pdf',
            'pdf_unique'
        )->where('status', 1)->distinct()->where(function($query) use ($currentMonth) {
            $query->whereMonth('departure', $currentMonth);
        })->get()->groupBy('destiny_group_id'); */
        



       /* $nextMonth = $this->model->select(
            'partner_id',
            'destiny_group_id',
            'departure',
            'arrival',
            'cpf',
            'ticket',
            'status',
            'pdf',
            'pdf_unique'
        )->where('status', 1)->distinct()->where(function($query) use ($nextMonth) {
            $query->whereMonth('departure', $nextMonth);
        })->get()->groupBy('destiny_group_id'); */


    }

}