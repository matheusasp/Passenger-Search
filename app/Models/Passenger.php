<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return ($data == 1 ? 'ATIVO' : 'CANCELADO');
    }

    public function getPdfAttribute($data) {
        return "<a href='https://lambda-hero.s3.sa-east-1.amazonaws.com/pdf/" . $data . "' target='blank'>link do bilhete</a>";
    }
}
