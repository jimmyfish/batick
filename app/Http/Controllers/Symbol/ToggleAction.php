<?php

namespace App\Http\Controllers\Symbol;

use App\Models\Symbol;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ToggleAction extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $item = Symbol::withTrashed()->find($request->id);
        if ($item->trashed()) {
            $item->update(['deleted_at' => null]);
        }else {
            $item->delete();
        }

        return redirect()->back();
    }
}
