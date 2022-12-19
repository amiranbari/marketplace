<?php

namespace App\Http\Middleware;

use App\Repositories\Admin\AdminRepositoryInterface;
use App\Services\Token\Admin;
use Closure;
use Illuminate\Http\Request;

class AdminProtectedMiddleware
{
    private AdminRepositoryInterface $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function handle(Request $request, Closure $next)
    {
        $id = (new Admin())->validate($request->header('authorization'));
        $request->admin = $this->adminRepository->find($id);
        return $next($request);
    }
}
