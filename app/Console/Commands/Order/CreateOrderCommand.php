<?php

namespace App\Console\Commands\Order;

use Illuminate\Console\Command;
use App\Http\Services\Order\CreateOrderService;

class CreateOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:order:create {symbol} {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create order';

    private $createOrderService;

    public function __construct(
        CreateOrderService $createOrderService
    )
    {
        parent::__construct();
        $this->createOrderService = $createOrderService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $this->line("Creating {$this->argument('symbol')} order with amount of \${$this->argument('amount')}");
        $this->line($this->createOrderService->console($this->argument('symbol'), $this->argument('amount')));
    }
}
