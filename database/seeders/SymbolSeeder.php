<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SymbolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {       
        // DB::table('symbols')->truncate();
        $symbols = $this->getBybitSymbols();
        DB::table('symbols')->insert($symbols);
    }

    private function getBybitSymbols(): array
    {
        $symbols = [];

        $base_url = config('requester.bybit.base_url');
        $response = Http::get("{$base_url}/v5/market/tickers", ['category' => 'spot']);

        $body = json_decode($response->getBody()->getContents());

        foreach ($body->result->list as $symbol) {
            if (
                (substr($symbol->symbol, -4) === "USDT") &&
                !str_contains($symbol->symbol, 'BULL') &&
                !str_contains($symbol->symbol, 'BEAR') &&
                !str_contains($symbol->symbol, 'DOWN') &&
                !str_contains($symbol->symbol, 'UP') &&
                !str_contains($symbol->symbol, '2L') &&
                !str_contains($symbol->symbol, '2S') &&
                !str_contains($symbol->symbol, '3L') &&
                !str_contains($symbol->symbol, '3S')
            ) {
                array_push($symbols, [
                    'name' => strtolower($symbol->symbol),
                    'symbol' => $symbol->symbol,
                    'source' => 'bybit',
                    'deleted_at' => Carbon::now(),
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        return $symbols;
    }

    private function getSymbols(): array
    {
        $symbols = [];
        try {
            $base_url = config('requester.binance.base_url');
            $response = Http::get("{$base_url}/api/v3/ticker/price");

            $body = collect(json_decode($response->getBody()->getContents()));
            $body->each(function ($symbol) use (&$symbols) {
                if (
                    (substr($symbol->symbol, -4) === "USDT") &&
                    !str_contains($symbol->symbol, 'BULL') &&
                    !str_contains($symbol->symbol, 'BEAR') &&
                    !str_contains($symbol->symbol, 'DOWN') &&
                    !str_contains($symbol->symbol, 'UP')
                ) {
                    array_push($symbols, [
                        'name' => strtolower($symbol->symbol),
                        'symbol' => $symbol->symbol,
                        'source' => 'binance',
                        'created_at' => Carbon::now(),
                    ]);
                }
            });
        } catch (\Exception $e) {
            echo ("Failing, retry...");
            $this->getSymbols();
        }

        return $symbols;
    }
}
