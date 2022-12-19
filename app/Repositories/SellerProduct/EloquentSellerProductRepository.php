<?php

namespace App\Repositories\SellerProduct;

use App\Models\SellerProduct;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentSellerProductRepository implements SellerProductRepositoryInterface
{

    protected SellerProduct $model;

    public function __construct(SellerProduct $sellerProduct)
    {
        $this->model = $sellerProduct;
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
            throw new ModelNotFoundException("Seller Product not found");
        }

        return $user;
    }
}
