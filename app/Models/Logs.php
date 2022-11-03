<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'created_at',
        'updated_at',
        'user',
        'operation',
        'searched'
    ];

    public function user() 
    {
        return $this->hasOne('App\Models\User', 'id', 'user');
    }
}
