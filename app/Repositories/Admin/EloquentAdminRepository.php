<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentAdminRepository implements AdminRepositoryInterface
{

    protected Admin $model;

    public function __construct(Admin $admin)
    {
        $this->model = $admin;
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
            throw new ModelNotFoundException("Admin not found");
        }

        return $user;
    }
}
