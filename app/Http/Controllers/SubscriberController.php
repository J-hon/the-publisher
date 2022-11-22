<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{

    public function get1(Request $request)
    {
        return response()->json($request);
    }

    public function get2(Request $request)
    {
        return response()->json($request);
    }

}
