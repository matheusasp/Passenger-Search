<?php

namespace App\Repository;

use App\Models\Logs;
use Illuminate\Database\Eloquent\Model;


class LogsRepository 
{
    protected $model;

    public function __construct(Logs $Log)
    {
        $this->model = $Log;
        $this->model->setConnection('hero');
    }


    public function all()
    {
        return $this->model->orderBy('name')->get();
    }

    public function find($id): Logs
    {

    return $this->model->whereId($id)->firstOrFail();

    }

    public function findByUser($id)
    {
        return $this->model->select(
            'created_at',
            'user',
            'operation'
        )
        ->with('user:id,name, email')
        ->whereUser($id)->get();
    }

    public function create(array $data) {
        return Logs::create($data);
      }
  

}