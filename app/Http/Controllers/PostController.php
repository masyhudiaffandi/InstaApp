<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('dashboard', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-post');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'user_id' =>'required',
            'photo' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' =>'required',
            'description' =>'required'
        ]);

        //store
        Post::create([
            'user_id' => $request->user_id,
            'photo' => $request->file('photo')->store('photos/posts', 'public'),
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $post = Post::findorFail($post->id);

        return view('edit-post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // update book
        $post->description = $request->description;
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post = Post::findorFail($post->id);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
