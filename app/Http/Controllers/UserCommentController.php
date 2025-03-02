<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return inertia('User/IndexComment',
        [
            'comments' => $request->user()->comments()->mostRecent()->paginate(10)->withQueryString(),
        ]
    );
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
    public function store(Post $post,Request $request)
    {
        $data = $request->validate([
            'description' => 'required|string|min:1',
        ]);
        $data['user_id']=$request->user()->id;
        $post->comments()->create($data);
        return redirect()->back()->with('success','comment successfully made');
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
    public function edit(Comment $comment)
    {
        //
        return inertia('User/EditComment',[
            'comment' => $comment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Comment $comment,Request $request)
    {
        //
        $comment->update($request->validate([
            'description' => 'required|string|min:1',
        ]));
        return redirect()->back()->with('success','Çomment Successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
        $comment->delete();
        return redirect()->back()->with('success','Comment Successfully deleted');
    }
}
