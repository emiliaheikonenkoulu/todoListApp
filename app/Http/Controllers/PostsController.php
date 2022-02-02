<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPost = new Post;
        $newPost->name = $request->post["name"];
        $newPost->save();

        return $newPost;
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingPost = Post::find( $id );

        if( $existingPost ) {
            $existingPost->completed = $request->post['completed'] ? true : false;
            $existingPost->completed_at = $request->post['completed'] ? Carbon::now() : null;
            $existingPost->save();
            return $existingPost;
        }

        return "Post not found.";
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingPost = Post::find( $id );

        if ( $existingPost ) {
            $existingPost->delete();
            return "Post successfully deleted.";
        }

        return "Post not found.";
    }

}
