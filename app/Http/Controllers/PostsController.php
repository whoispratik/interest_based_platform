<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 10;
        $searchTerm = $request->query('q', '');      // get raw string, default to empty
        $searchTerm = trim($searchTerm);
        if(strlen($searchTerm)){
            $posts = Post::search($searchTerm)
                    ->query(function ( Builder $query) {
                    $query->withCount(['comments', 'likes']);
                    $query->mostRecent();
                    })
                    ->paginate($perPage)
                    ->withQueryString();
        }
        else{
            $posts = Post::withCount(['comments','likes'])->mostRecent()->paginate($perPage)->withQueryString();
        }
        return inertia('Post/Index',[
            'posts' => $posts,
            'filters' => [
                'q' => $searchTerm,
            ]
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //  //
               return inertia('Post/Show',[
                'post' => $post
            ]);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
