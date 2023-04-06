<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        return Response::api('Promotions retrieved',
            Promotion::filter()->paginate($request->limit)
        );
    }
}
