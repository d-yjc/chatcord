<?php

namespace App\Mail;


use App\Models\Comment;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope; 
use Illuminate\Queue\SerializesModels;

class CommentNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    public $comment;

    /**
     * Create a new message instance.
     */
    public function __construct(Comment $comment)
    {   
        $this->comment = $comment->load('post.chatUser', 'chatUser');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $post = $this->comment->post;
        $postTopic = $this->comment->post->topic ?? 'No topic';
        return new Envelope(
            subject: "New comment on: {$postTopic}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.comment-notification',
            with: [
                'title' => $this->comment->post->topic ?? 'Title N/A',
                'body' => $this->comment->body,
                'sender' => $this->comment->chatUser->username ?? 'Unknown',
                'postUrl' => url("posts/{$this->comment->post->id}"),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
