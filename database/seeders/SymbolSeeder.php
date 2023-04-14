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
        $symbols = $this->getSymbols();
        DB::table('symbols')->insert($symbols);
    }

    private function getSymbols(): array
    {
        $symbols = [];
        try {
            $base_url = config('requester.binance.base_url');
            $response = Http::get("{$base_url}/api/v3/ticker/price");

            $body = collect(json_decode($response->getBody()->getContents()));
            $body->each(function ($symbol) use (&$symbols) {
                array_push($symbols, [
                    'name' => strtolower($symbol->symbol),
                    'symbol' => $symbol->symbol,
                    'created_at' => Carbon::now(),
                ]);
            });
        } catch (\Exception $e) {
            echo("Failing, retry...");
            $this->getSymbols();
        }

        return $symbols;
    }
}
