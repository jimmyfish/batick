<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Services\Order\CloseOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CloseOrderAction extends Controller
{
    private $closeOrderService;

    public function __construct(CloseOrderService $closeOrderService)
    {
        $this->closeOrderService = $closeOrderService;
    }

    public function __invoke(Request $request)
    {
        /** @var $user App\Models\User */
        $user = Auth::user();

        $order = $user->orders()->find($request->order_id);
        if ($this->closeOrderService->closeOrder($order->id)) {
            return redirect()->back();
        }
    }
}
