<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InterestController extends Controller
{
    //
    /*
    comments: [
    {
      post: {
        title: "AI in Everyday Life",
        description: "Discussing the integration of AI technology into daily routines."
      },
      comment: "Fascinating read! I'm excited to see how AI will change our lives."
    },
    {
      post: {
        title: "Quantum Computing Breakthrough",
        description: "Latest updates on quantum computing and its future applications."
      },
      comment: "This breakthrough could revolutionize computing as we know it."
    },
    {
      post: {
        title: "The Evolution of Mobile Tech",
        description: "A retrospective look at how mobile technology has evolved over the decades."
      },
      comment: "Great perspective on the rapid pace of innovation in mobile tech!"
    }
  ]
    */
    public function index(Request $request)
    {
        $user = $request->user();

        // 1) eager‑load only the title & description of each post
        $comments = $user
            ->comments()
            ->with('post:id,title,description')  // only pull those two columns + id
            ->get();
    
        // 2) transform into the exact structure you want
        $userComments = $comments->map(function ($comment) {
            return [
                'post' => [
                    'title'       => $comment->post->title,
                    'description' => $comment->post->description,
                ],
                'comment' => $comment->description,
            ];
        });
        // transform user posts to include only title and description
        $userPosts = $user->posts()
            ->get(['title', 'description'])
            ->map(function ($post) {
                return [
                    'title'       => $post->title,
                    'description' => $post->description,
                ];
            });
        // transform user liked posts to include only title and description
        $userLikes = Post::whereIn('id', $user->likes()->pluck('post_id'))
            ->get(['title', 'description'])
            ->map(function ($post) {
                return [
                    'title'       => $post->title,
                    'description' => $post->description,
                ];
            });
        return inertia('Interest/YourInterest',[
            'userPosts' => $userPosts,
            'userLikes' => $userLikes,
            'userComments' => $userComments,
            'interests' => $user->interests, // because of the casting in the model, it will deserialize from JSON into a PHP array
        ]);
    }
    // for interest recalibration/prediction
    public function update(Request $request){
        $user = $request->user();
        if(empty($request->all()))
          {
            $user->interests = null;
          }
        else{
        $user->interests = $request->all(); // because of the casting in the model , the given array will automatically be serialized back into JSON for storage:
        }
        $user->save();
        return redirect()->back()->with('success', 'Interests updated successfully.');
    }
}
