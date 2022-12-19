<?php

namespace App\Http\Controllers;

use App\Http\Resources\SellerResource;
use App\Repositories\Seller\SellerRepositoryInterface;
use App\Repositories\SellerProduct\SellerProductRepositoryInterface;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function nearby(Request $request, SellerRepositoryInterface $sellerRepository)
    {
        $enableAddress = $request->customer->addresses()->enable()->first();
        if (!$enableAddress) abort(403, 'Please add or enable an address');

        $latitude = $enableAddress->lat;
        $longitude = $enableAddress->long;
        $sellers = $sellerRepository->getNearby($latitude, $longitude);

        return SellerResource::collection($sellers);
    }

    public function addProduct(Request $request, SellerProductRepositoryInterface $sellerProductRepository)
    {

        $sellerProductRepository->create([
            'seller_id' => $request->seller->id,
            'title'     => $request->get('title'),
            'count'     => $request->get('count'),
            'price'     => $request->get('price')
        ]);

        return response()->json([
            'message'   =>  'product created successfully.'
        ]);

    }
}
