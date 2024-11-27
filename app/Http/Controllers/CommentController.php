<?php

namespace App\Http\Controllers;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Post;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string',
            'attachment' => 'nullable|file|max:10240', // Max 10 MB
        ]);
    
        // Create the Comment
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->chat_user_id = auth()->id(); // Ensure the user is authenticated
        $comment->post_id = $post->id;
        $comment->save();
    
        // Handle the attachment if present     
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
    
            // Store the file in the 'public' disk under 'attachments' directory
            $filePath = $file->store('attachments', 'public');
    
            // Create the attachment record
            $attachment = new Attachment([
                'name' => $file->getClientOriginalName(),
                'file_path' => $filePath,
            ]);
    
            // Associate the attachment with the comment
            $comment->attachment()->save($attachment);
        }
    
        return redirect()->route('posts.show', $post->id)
                         ->with('success', 'Comment added successfully.');
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
