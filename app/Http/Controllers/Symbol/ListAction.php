<?php

namespace App\Http\Controllers\Symbol;

use App\Http\Controllers\Controller;
use App\Models\Symbol;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListAction extends Controller
{
    public function index(Request $request): View
    {
        $source = $request->source;
        $search = $request->search;

        $symbols = Symbol::withTrashed();

        if ($source) $symbols = $symbols->where(['source' => $source]);
        if ($search) $symbols = $symbols->where('name', 'like', "%" . strtolower($search) . "%");

        $symbols = $symbols->orderBy('deleted_at')->orderBy('symbol')->paginate(15);

        return view('symbol.list', [
            'symbols' => $symbols,
        ]);
    }
}
