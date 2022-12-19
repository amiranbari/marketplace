<?php

namespace App\Repositories\Seller;

use App\Models\Address;
use App\Models\Seller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class EloquentSellerRepository implements SellerRepositoryInterface
{

    const KILOMETER = 5;

    protected Seller $model;

    public function __construct(Seller $seller)
    {
        $this->model = $seller;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (empty($user = $this->model->find($id))) {
            throw new ModelNotFoundException("Seller not found");
        }

        return $user;
    }

    public function getNearby($latitude, $longitude)
    {
        return $this->model->select(DB::raw("*, ( 3959 * acos( cos( radians('$latitude') ) * cos( radians( lat ) ) * cos( radians( longitude ) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians( lat ) ) ) ) AS distance"))->havingRaw('distance < ' . self::KILOMETER)
            ->get();
    }
}
