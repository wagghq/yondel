<?php

namespace Wagg\Yondel\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookCommentCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $book;
    private $comment;

    /**
     * Create a new message instance.
     *
     * @param $book
     */
    public function __construct($book, $comment)
    {
        $this->book = $book;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.book.commentCreated', [
            'book' => $this->book,
            'comment' => $this->comment,
        ]);
    }
}
