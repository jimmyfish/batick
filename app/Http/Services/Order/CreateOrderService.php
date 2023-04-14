<?php

namespace App\Http\Services\Order;

use App\Http\Services\Fetcher\GetLatestPriceService;
use App\Models\Order;
use App\Models\Symbol;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class CreateOrderService
{
    private $symbol;
    private $amount;
    private $getLatestPriceService;

    public function __construct(GetLatestPriceService $getLatestPriceService)
    {
        $this->getLatestPriceService = $getLatestPriceService;
    }

    public function __invoke(Request $request, string $symbol, float $amount)
    {

    }

    public function console(string $symbol, float $amount)
    {
        Auth::setUser(User::first());
        $this->symbol = $symbol;
        $this->amount = $amount;
        $this->create();

        return "Creating {$symbol} order with amount of \${$amount}";
    }

    private function create()
    {
        $symbol = Symbol::where(['name' => strtolower($this->symbol)])->firstOrFail();

        $data = [
            'symbol_id' => $symbol->id,
            'buy_price' => $this->getLatestPriceService->get($this->symbol),
            'user_id' => Auth::user()->id
        ];

        Order::create($data);

        // dd($data);
    }
}