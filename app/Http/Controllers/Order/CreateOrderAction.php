<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Services\Order\CreateOrderService;
use Illuminate\Http\Request;

class CreateOrderAction extends Controller
{
    private $createOrderService;

    public function __construct(CreateOrderService $createOrderService)
    {
        $this->createOrderService = $createOrderService;
    }

    public function __invoke(Request $request)
    {
        $this->createOrderService->__invoke($request->symbol, $request->amount);

        return redirect()->route('order.list');
    }
}
