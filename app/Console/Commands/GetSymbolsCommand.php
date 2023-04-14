<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetSymbolsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:symbols';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->getSymbols();
    }

    private function getSymbols()
    {
        try {
            $base_url = config('requester.binance.base_url');
            $response = Http::get("{$base_url}/api/v3/ticker/price");

            $body = collect(json_decode($response->getBody()->getContents()));

            $symbols = collect([]);
            $body->each(function ($symbol) use ($symbols) {
                $symbols->push($symbol->symbol);
            });

            dd($symbols);
        } catch (\Exception $e) {
            $this->line("Failing, retry...");
            $this->getSymbols();
        }
    }
}
