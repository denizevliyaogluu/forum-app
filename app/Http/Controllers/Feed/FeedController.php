<?php

namespace App\Http\Controllers\Feed;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function store(PostRequest $request){
        $request->validated();
        auth()->user()->feeds()->create([
            'content' => $request->content
        ]);
        return response([
            'message' => 'success',
        ],201);
    }
}
