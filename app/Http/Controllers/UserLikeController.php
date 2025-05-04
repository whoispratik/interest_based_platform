<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Notifications\LikeMade;
use Gate;
use Illuminate\Http\Request;

class UserLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return inertia('User/IndexLike',[
            'likes' => $request->user()->likes()->with(['post'])->mostRecent()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        //
        $postInstance = $post->likes()->create([
            'user_id' => $request->user()->id
        ]); 
        if($request->user()->id !== $post->user_id)
        $post->user->notify(new LikeMade($postInstance));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post,Like $like)
    {
        //
        $response = Gate::inspect('delete',$like);
        if($response->allowed()){
            $like->delete();
        }
        else{
            return redirect()->route('post.index')->with('error',$response->message());
        }
    }
}
