<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Passenger extends Model
{
    use HasFactory;

    protected $connection = 'hero';

    protected $fillable = 
    [
        'partner_id',
        'destiny_group_id',
        'departure',
        'arrival',
        'ticket',
        'cpf',
        'pdf',
        'status'
    ];
    

    public function partner() 
    {
        return $this->hasOne('App\Models\Partner', 'id', 'partner_id');
    }

    public function destinyGroup() 
    {
        return $this->hasOne('App\Models\DestinyGroup', 'id', 'destiny_group_id');
    }

    public function getStatusAttribute($data) {

        if(Carbon::now()->toDateString() > $this->arrival) {
            return ($data == 1 ? '<span class="badge bg-warning">ATIVO - VIGÊNCIA VENCIDA</span>' : '<span class="badge bg-danger">CANCELADO</span>');
        }

        return ($data == 1 ? '<span class="badge bg-success">ATIVO - EM VIGÊNCIA</span>' : '<span class="badge bg-danger">CANCELADO</span>');

    }
    
    public function getPdfAttribute($data) {
        if($this->pdf_unique==1){
            return "<a href='https://bilhete.heroseguros.com.br/pt/ticket/" . $data . "' target='blank' class='btn btn-secondary'>Link do Bilhete</a>";
        }else{
            return "<a href='https://heroseguros.s3.sa-east-1.amazonaws.com/pdf/" . $data . "' target='blank' class='btn btn-secondary'>Link do Bilhete</a>";
        }
    }
}
