<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;

class ClearCacheController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        Artisan::call('optimize:clear');

        return back()->with('cache_cleared', true);
    }
}
