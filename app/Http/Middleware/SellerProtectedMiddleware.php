<?php

namespace App\Http\Middleware;

use App\Repositories\SellerProduct\SellerProductRepositoryInterface;
use App\Services\Token\Seller;
use Closure;
use Illuminate\Http\Request;

class SellerProtectedMiddleware
{
    private SellerProductRepositoryInterface $sellerProductRepository;

    public function __construct(SellerProductRepositoryInterface $sellerProductRepository)
    {
        $this->sellerProductRepository = $sellerProductRepository;
    }

    public function handle(Request $request, Closure $next)
    {
        $id = (new Seller())->validate($request->header('authorization'));
        $request->seller = $this->sellerProductRepository->find($id);
        return $next($request);
    }
}
