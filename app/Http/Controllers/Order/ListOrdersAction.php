<?php

namespace App\Http\Controllers\Order;

use App\Models\Order;
use App\Models\Symbol;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ListOrdersAction extends Controller
{
    public function __invoke()
    {
        /** @var App\Models\User */
        $user = Auth::user();
        $symbols = Symbol::orderBy('name')->whereNotIn('id', $user->orders()->select('symbol_id')->where('is_closed', false))->get();

        return view('order.list', [
            'orders' => Order::withTrashed()->paginate(15),
            'symbols' => $symbols,
        ]);
    }
}
