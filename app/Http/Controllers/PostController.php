<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
            'body' => 'required|string',
            'attachment' => 'nullable|file|max:10240', // Max 10 MB
        ]);
    
        // Create the Post
        $post = new Post();     
        $post->topic = $request->input('topic');
        $post->body = $request->input('body');
        $post->chat_user_id = auth()->id(); 
        $post->save();
    
        //Handle the attachment if present
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            //Store the file in 'attachments/public'
            $filePath = $file->store('attachments', 'public');
            
            $attachment = new Attachment([
                'name' => $file->getClientOriginalName(),
                'file_path' => $filePath,
            ]);
            $post->attachment()->save($attachment);
        }
        return redirect()->route('posts.show', $post->id)
                         ->with('success', 'Post created successfully.');               
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)    
    {
         $post = Post::with(['attachment', 'comments.attachment', 'comments.chatUser'])->findOrFail($id);

    return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        if ($request->user()->cannot('edit', $id)) {
            abort(403);
        }
        return redirect('/posts');
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { 
        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }
        return redirect('/posts/{$id}');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
