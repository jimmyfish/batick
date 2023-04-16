<?php

namespace App\Http\Controllers\Api\Order;

use App\Models\Symbol;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Order\CloseOrderService;

class CloseOrderAction extends Controller
{
    private $closeOrderService;

    public function __construct(CloseOrderService $closeOrderService)
    {
        $this->closeOrderService = $closeOrderService;
    }

    public function __invoke(Request $request)
    {
        $symbol = Symbol::where([
            'name' => strtolower($request->symbol),
            'source' => 'bybit'
        ])->first();
        
        return response()->json(['message' => $this->closeOrderService->console($symbol->id)], 200);
    }
}
