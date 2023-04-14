<?php

namespace App\Http\Services\Fetcher;

use Illuminate\Support\Facades\Http;

class GetLatestPriceService
{
    public function get(string $symbol): float
    {
        $response = Http::get(config('requester.bybit.base_url').'/v5/market/tickers', [
            'category' => 'spot',
            'symbol' => strtoupper($symbol),
        ]);

        $responseBody = json_decode($response->getBody()->getContents());

        if ($responseBody->retCode !== 0) {
            return false;
        }

        return (float) $responseBody->result->list[0]->lastPrice;
    }
}