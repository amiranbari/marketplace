<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentCustomerRepository implements CustomerRepositoryInterface
{

    protected Customer $model;

    public function __construct(Customer $user)
    {
        $this->model = $user;
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
            throw new ModelNotFoundException("Customer not found");
        }

        return $user;
    }
}
