<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateComment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The message instance.
     *
     * @var Comment
     */
    public $comment;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Comment $comment
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.create-comment');
    }
}
