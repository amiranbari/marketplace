<?php

namespace App\Repositories\Role;

use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentRoleRepository implements RoleRepositoryInterface
{

    protected Role $model;

    public function __construct(Role $user)
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
            throw new ModelNotFoundException("Role not found");
        }

        return $user;
    }
}
