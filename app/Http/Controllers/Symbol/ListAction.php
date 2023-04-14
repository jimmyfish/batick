<?php

namespace App\Http\Controllers\Symbol;

use App\Http\Controllers\Controller;
use App\Models\Symbol;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ListAction extends Controller
{
    public function index(): View
    {
        $symbols = Symbol::withTrashed()->orderBy('deleted_at')->orderBy('symbol')->paginate(15);

        return view('symbol.list', [
            'symbols' => $symbols,
        ]);
    }
}
