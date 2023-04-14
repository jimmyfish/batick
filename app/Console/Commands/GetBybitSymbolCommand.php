<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetBybitSymbolCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:bybit:get-symbol';

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
        $base_url = config('requester.bybit.base_url');
        $response = Http::get("{$base_url}/v5/market/tickers", ['category' => 'spot']);

        $body = json_decode($response->getBody()->getContents());

        // $symbols = collect([]);
        // $body->result->list->each(function ($symbol) use ($symbols) {
        //     $symbols->push($symbol->symbol);
        // });

        dd($body->result->list);
    }
}
