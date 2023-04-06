<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserOrderController extends Controller
{
    public function index(Request $request)
    {
        return Response::api('Orders retrieved',
            $request->user()->orders()->filter()->paginate($request->limit)
        );
    }
}
