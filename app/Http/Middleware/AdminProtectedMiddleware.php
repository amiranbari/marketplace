<?php

namespace App\Http\Middleware;

use App\Jwt\Token;
use App\Repositories\Admin\AdminRepositoryInterface;
use App\Services\Token\Admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProtectedMiddleware
{
    private AdminRepositoryInterface $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id = (new Admin())->validate($request->header('authorization'));
        $request->admin = $this->adminRepository->find($id);
        return $next($request);
    }
}
