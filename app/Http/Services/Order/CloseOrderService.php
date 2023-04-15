<?php

namespace App\Http\Services\Order;

use App\Http\Services\Fetcher\GetLatestPriceService;
use App\Models\Order;
use App\Models\User;
use App\Models\Symbol;
use Illuminate\Support\Facades\Auth;

class CloseOrderService
{
    private $symbol;
    private $getLatestPriceService;

    public function __construct(GetLatestPriceService $getLatestPriceService)
    {
        $this->getLatestPriceService = $getLatestPriceService;
    }

    public function console(string $symbolId)
    {
        Auth::setUser(User::first());
        $this->symbol = Symbol::find($symbolId);

        return "Closing {$this->symbol->name} order with " . $this->closeOrder();
    }

    private function closeOrder(): int
    {
        /** @var $user App\Models\User */
        $user = Auth::user();
        $order = $user->orders()->where([
            'symbol_id' => $this->symbol->id,
            'is_closed' => false
        ])->first();

        $sellPrice = $this->getLatestPriceService->get($this->symbol);

        if ($order) Order::find($order->id)->update(['sell_price' => $sellPrice,'is_closed' => true]);

        $buy = $order->size * $order->buyPrice;
        $sell = $order->size * $sellPrice;

        // dd($buy);

        $this->setProfit($sell);

        return $order->id;
    }

    private function setProfit(float $profit)
    {
        $user = Auth::user();

        $balance = $user->balance;

        User::find($user->id)->update(['balance' => $balance + $profit]);
    }
}