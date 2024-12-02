<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsList extends Component
{
    public $post;
    public $editingCommentId = null;
    public $body;

    protected $listeners = ['commentAdded' => '$refresh'];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function startEditing($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (Auth::user()->can('update', $comment)) {
            $this->editingCommentId = $commentId;
            $this->body = $comment->body;
        } else {
            session()->flash('error', 'You do not have permission to edit this comment.');
        }
    }

    public function saveEdit()
    {
        if ($this->editingCommentId) {
            $comment = Comment::findOrFail($this->editingCommentId);

            if (Auth::user()->can('update', $comment)) {
                $this->validate(['body' => 'required|string']);
                $comment->update(['body' => $this->body]);

                session()->flash('message', 'Comment updated successfully!');
                $this->resetEditing();
            } else {
                session()->flash('error', 'You do not have permission to edit this comment.');
            }
        }
    }

    public function delete($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (Auth::user()->can('delete', $comment)) {
            $comment->delete();
            session()->flash('message', 'Comment deleted successfully!');
        }
    }

    public function resetEditing()
    {
        $this->editingCommentId = null;
        $this->body = null;
    }

    public function render()
    {
        $comments = $this->post->comments()->with('attachment', 'chatUser')->get();

        return view('livewire.comments-list', compact('comments'));
    }
}
