<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $post = Post::findOrFail($id);
    
        $this->authorize('update', $post);
    
        // Return the edit view with the post data
        return view('posts.edit', compact('post'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { 
        // Retrieve the Post instance
        $post = Post::findOrFail($id);
    
        // Authorize the user using the 'update' policy
        $this->authorize('update', $post);
    
        // Validate the incoming request data
        $validatedData = $request->validate([
            'topic' => 'required|string|max:255',
            'body' => 'required|string',
            'attachment' => 'nullable|file|max:10240', // Max 10 MB
        ]);
    
        // Update the Post attributes
        $post->update([
            'topic' => $validatedData['topic'],
            'body' => $validatedData['body'],
        ]);
    
        // Handle the attachment if present
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
    
            // Store the file in 'attachments/public'
            $filePath = $file->store('attachments', 'public');
    
            // Update or create the attachment
            if ($post->attachment) {
                $post->attachment->update([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $filePath,
                ]);
            } else {
                $attachment = new Attachment([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $filePath,
                ]);     
                $post->attachment()->create($attachment);
                $post->attachment()->save($attachment);
            }
        }
    
        // Redirect to the post's show page with a success message
        return redirect()->route('posts.show', $post->id)
                         ->with('success', 'Post updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
    
        // Authorize
        $this->authorize('delete', $post);
    
        // Delete existing attachment...
        if ($post->attachment) {
            Storage::disk('public')->delete($post->attachment->file_path);
            $post->attachment->delete();
        }
    
        // Delete the post
        $post->delete();
    
        return redirect()->route('posts.index')
                         ->with('success', 'Post deleted successfully.');
    }
}
