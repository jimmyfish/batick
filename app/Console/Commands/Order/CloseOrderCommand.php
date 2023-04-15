<?php

namespace App\Console\Commands\Order;

use App\Http\Services\Order\CloseOrderService;
use Illuminate\Console\Command;

class CloseOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:order:close {symbol_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close Order';

    private $closeOrderService;

    public function __construct(
        CloseOrderService $closeOrderService
    )
    {
        parent::__construct();
        $this->closeOrderService = $closeOrderService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $this->line("Creating {$this->argument('symbol')} order with amount of \${$this->argument('amount')}");
        $this->line($this->closeOrderService->console($this->argument('symbol_id')));
    }
}
