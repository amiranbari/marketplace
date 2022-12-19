<?php

namespace App\Http\Middleware;

use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Services\Token\Customer;
use Closure;
use Illuminate\Http\Request;

class CustomerProtectedMiddleware
{
    private CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
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
        $id = (new Customer())->validate($request->header('authorization'));
        $request->customer = $this->customerRepository->find($id);
        return $next($request);
    }
}
