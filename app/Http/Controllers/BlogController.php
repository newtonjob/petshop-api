<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        return Response::api('Blog posts retrieved',
            Post::paginate($request->limit)
        );
    }

    public function show(Post $blog)
    {
        return Response::api('Blog post retrieved', $blog);
    }
}
