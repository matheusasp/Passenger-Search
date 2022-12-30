<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPartners extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'partner_id'
    ];


    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function partner() 
    {
        return $this->hasOne('App\Models\Partner', 'partner_id', 'partner_id');
    }

    public function user() 
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
