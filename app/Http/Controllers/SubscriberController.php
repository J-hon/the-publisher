<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriberController extends Controller
{

    public function get(Request $request): void
    {
        Log::info($request);
    }

    public function get2(Request $request): void
    {
        Log::info($request);
    }

}
