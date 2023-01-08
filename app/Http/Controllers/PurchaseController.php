<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseCreateRequest;
use App\Services\PurchaseService;

class PurchaseController extends Controller
{
    private PurchaseService $purchaseService;

    public function __construct()
    {
        $this->purchaseService = new PurchaseService();
    }

    public function store(PurchaseCreateRequest $request)
    {

        $body = $request->all();
        return $this->purchaseService->createPurchase($body);
    }
}
