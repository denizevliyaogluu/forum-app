<?php

namespace App\Http\Controllers\Feed;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Feed;
use App\Models\Like;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index(){
        $feeds = Feed::with('user')->latest()->get();
        return response([
            'feeds' => $feeds
        ],200);
    }
    public function store(PostRequest $request){
        $request->validated();
        auth()->user()->feeds()->create([
            'content' => $request->content
        ]);
        return response([
            'message' => 'success',
        ],201);
    }

    public function likePost($feed_id){
        //select feed with feed_id
        $feed = Feed::whereId($feed_id)->first();
        if(!$feed){
            return response([
                'message' => '404 Not Found'
            ],500);
        }
        

        //unlike post
        $unlike_post = Like::where('user_id', auth()->id())->where('feed_id', $feed_id)->delete();
        if($unlike_post){
            return response([
                'message' => 'Unliked'
            ],200);
        }

        //like post
        $like_post = Like::create([
            'user_id' => auth()->id(),
            'feed_id' => $feed_id
        ]);
        if($like_post){
            return response([
                'message' => 'Liked'
            ],200);
        }
        
    }
}
