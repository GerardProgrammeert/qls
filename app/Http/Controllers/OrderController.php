<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use BeezMaster\QLSClient\Repositories\ProductsRepository;
use BeezMaster\QLSClient\Responses\ValueObjects\ProductValueObject;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function create(ProductsRepository $productRepo): View
    {
        /** @var ?ProductValueObject $product */
        $product = $productRepo->getByProductId(2)?->first();
        $productCombinations = data_get($product?->toArray(), 'combinations');

        return view('order.create', compact( 'productCombinations'));
    }

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        dd($data);
    }
}
