<?php

namespace App\Http\Controllers\Symbol;

use App\Http\Controllers\Controller;
use App\Models\Symbol;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeleteAction extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        Symbol::find($request->id)->delete();

        return redirect()->route('symbol.list');
    }
}
