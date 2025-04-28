<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Arr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class UserPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function interestFeed(Request $request)
    {
        $user = $request->user();
        $interests = $user->interests;

        // 1. Build the “universe” of filters from the user’s interests:
        $allCategories  = array_keys($interests ?? []);
        $allSubreddits  = Arr::collapse($interests ?? []);

        // 2. Pull the incoming inputs—falling back to “all” if nothing is passed:
        $searchTerm         = trim($request->query('q', ''));
        $selectedCategories = $request->query('categories', $allCategories);
        $selectedSubreddits = $request->query('subreddits', $allSubreddits);
        if(strlen(($searchTerm))){
            $posts = Post::search($searchTerm)
            ->query(function (Builder $query) use ($selectedCategories, $selectedSubreddits) {
                $query->withCount(['comments', 'likes']);
                $query->WhereIn('subreddit', $selectedSubreddits);
                $query->mostRecent();
            })
            ->paginate(10)
            ->withQueryString();
        }
        else{
            $posts = Post::withCount(['comments', 'likes'])
            ->WhereIn('subreddit', $selectedSubreddits)
            ->mostRecent()
            ->paginate(10)
            ->withQueryString();         
        }
    // 5. Return everything the front-end needs:
    return inertia('User/InterestFeed', [
        'interests' => $interests,
        'posts'=> $posts,
        'filters' => [
            'selectedCategories'   => $selectedCategories,
            'selectedSubreddits'   => $selectedSubreddits,
            'q'=> $searchTerm,
        ],
    ]);
        }

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
                    'title' => 'required|string|min:10',
                    'description' => 'required|string|min:10',
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
                'title' => 'required|string|min:10',
                'description' => 'required|string|min:10',
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
