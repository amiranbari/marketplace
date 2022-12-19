<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRequest;
use App\Repositories\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function store(StoreRequest $request)
    {
        $this->roleRepository->create([
            'title' => $request->get('title')
        ]);

        return response()->json([
            'message'   =>  'role created successfully.'
        ]);
    }

    public function destroy(Request $request)
    {
        $this->roleRepository->delete($request->get('role_id'));

        return response()->json([
            'message'   =>  'role deleted successfully.'
        ]);
    }

    public function update(Request $request)
    {
        $this->roleRepository->update([
            'title' => $request->get('title')
        ], $request->get('role_id'));

        return response()->json([
            'message'   =>  'role updated successfully.'
        ]);
    }
}
