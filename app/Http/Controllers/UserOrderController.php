<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->orders()->paginate($request->limit);
    }
}
