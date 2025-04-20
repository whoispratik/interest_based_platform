<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class UserPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return inertia('User/Index',[
            'posts' => $request->user()->posts()->withCount(['comments','likes'])->mostRecent()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return inertia('User/CreatePost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->user()->posts()->create(
            $request->validate(
                [
                    'title' => 'required|string',
                    'description' => 'required|string',
                    'subreddit' => 'required|string',
                    'category_one' => 'required|string',
                    'category_two' => 'required|string',
                ]
            )
                );
            return redirect()->route('post.index')->with('success','post created successfully');
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
    public function edit(Post $post)
    {
        //
        $response = Gate::inspect('update',$post);
        if($response->allowed()){
            return inertia('User/EditPost',[
                'post' => $post
            ]);
        }
        else{
            return redirect()->route('post.index')->with('error',$response->message());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Post $post)
    {
        //
        $response = Gate::inspect('update',$post);
        if($response->allowed()){
            $post->update($request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'subreddit' => 'required|string',
                'category_one' => 'required|string',
                'category_two' => 'required|string',
            ]));
            return redirect()->route('user.post.index')->with('success','post Edited successfully');
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $response = Gate::inspect('delete',$post);
        if($response->allowed()){
            $post->delete();
            return redirect()->route('user.post.index')->with('success','post deleted successfully');
        }
        else{
            return redirect()->route('post.index')->with('error',$response->message());
        }
    }
}
