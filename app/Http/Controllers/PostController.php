<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create'); // We will create this view
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'post_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload Image
        $imagePath = $request->file('post_image')->store('posts', 'public');

        // Create Post
        Post::create([
            'user_id' => Auth::id(),
            'post_image' => $imagePath,
            'title' => $request->title,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Show Edit Form
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Handle Update
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'post_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update image if new one is uploaded
        if ($request->hasFile('post_image')) {
            $imagePath = $request->file('post_image')->store('posts', 'public');
            $post->post_image = $imagePath;
        }

        // Update title
        $post->title = $request->title;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // Delete Post
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

}
