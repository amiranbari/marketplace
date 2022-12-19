<?php

namespace App\Http\Middleware;

use App\Jwt\Token;
use App\Repositories\Customer\CustomerRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $token = Str::remove('Bearer ', $request->header('authorization'));
        $id = optional(Token::getPayload($token))['customer_id'];
        if (!Token::validate($token, config('jwt.secret')) or !isset($id)) abort(403);
        $request->customer = $this->customerRepository->find($id);
        return $next($request);
    }
}
