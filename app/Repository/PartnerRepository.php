<?php

namespace App\Repository;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Model;


class PartnerRepository 
{
    protected $model;

    public function __construct(Partner $Partner)
    {
        $this->model = $Partner;
        $this->model->setConnection('hero');
    }


    public function all()
    {
        return $this->model->orderBy('name')->get();
    }

    public function find($id): Partner
    {

    return $this->model->whereId($id)->firstOrFail();

    }

}