<?php

namespace App\Repository;

use App\Models\DestinyGroup;
use Illuminate\Database\Eloquent\Model;


class DestinyGroupRepository 
{
    protected $model;

    public function __construct(DestinyGroup $DestinyGroup)
    {
        $this->model = $DestinyGroup;
        $this->model->setConnection('hero');
    }


    public function all()
    {
        return $this->model->orderBy('name')->get();
    }

    public function find($id): DestinyGroup
    {

    return $this->model->whereId($id)->firstOrFail();

    }

}