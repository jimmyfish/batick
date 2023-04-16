<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Services\Order\CreateOrderService;
use App\Models\Symbol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateOrderAction extends Controller
{
    private $createOrderService;

    public function __construct(CreateOrderService $createOrderService)
    {
        $this->createOrderService = $createOrderService;
    }

    public function __invoke(Request $request)
    {
        $symbol = Symbol::where('name', strtolower($request->symbol))->firstOrFail();
        $this->createOrderService->__invoke($symbol->id, $request->amount);

        return response()->json([
            'message' => 'Order received!',
        ], 200);
    }
}
