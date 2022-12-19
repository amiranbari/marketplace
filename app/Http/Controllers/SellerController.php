<?php

namespace App\Http\Controllers;

use App\Http\Resources\SellerResource;
use App\Repositories\Seller\SellerRepositoryInterface;
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
}
