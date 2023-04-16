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
    private $size;
    private $getLatestPriceService;

    public function __construct(GetLatestPriceService $getLatestPriceService)
    {
        $this->getLatestPriceService = $getLatestPriceService;
    }

    public function __invoke(string $symbol, float $amount)
    {
        $this->symbol = Symbol::where(['id' => strtolower($symbol), 'source' => 'bybit'])->firstOrFail();
        $this->amount = $amount;
        $this->create();
    }

    public function api($user, string $symbol, float $amount)
    {
        $this->symbol = Symbol::where(['name' => strtolower($symbol), 'source' => 'bybit'])->firstOrFail();
        $this->amount = $amount;
        $this->create();
    }

    public function console(string $symbol, float $amount)
    {
        Auth::setUser(User::first());
        $this->symbol = Symbol::where(['name' => strtolower($symbol), 'source' => 'bybit'])->firstOrFail();
        $this->amount = $amount;
        $this->create();

        return "Creating {$symbol} order with amount of \${$amount}";
    }

    private function create()
    {
        $buyPrice = $this->getLatestPriceService->get($this->symbol);
        $this->size = $this->amount / $buyPrice;

        if (!$this->checkDuplicateOrder()) {
            $data = [
                'symbol_id' => $this->symbol->id,
                'buy_price' => round($buyPrice, 10),
                'user_id' => Auth::user()->id,
                'size' => round($this->size, 10),
            ];
            
            Order::create($data);

            $this->chargeBalance();
        }
    }

    private function apiCreate($user)
    {
        $buyPrice = $this->getLatestPriceService->get($this->symbol);
        $this->size = $this->amount / $buyPrice;

        if (!$this->checkDuplicateOrder($user)) {
            $data = [
                'symbol_id' => $this->symbol->id,
                'buy_price' => round($buyPrice, 10),
                'user_id' => Auth::user()->id,
                'size' => round($this->size, 10),
            ];
            
            Order::create($data);

            $this->chargeBalance($user);
        }
    }

    private function chargeBalance($user = null): void
    {
        $user = $user ?? Auth::user();
        $balance = $user->balance;
        User::find($user->id)->update(['balance' => $balance - $this->amount]);
    }

    private function checkDuplicateOrder($user = null)
    {
        /** @var $user App\Models\User */
        $user = $user ?? Auth::user();
        $duplicate = $user->orders()->where([
            'symbol_id' => $this->symbol->id,
            'is_closed' => false
        ])->count();

        return $duplicate > 0;
    }
}
