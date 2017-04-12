<?php

namespace Wagg\Yondel\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $book;

    /**
     * Create a new message instance.
     *
     * @param $book
     */
    public function __construct($book)
    {
        $this->book = $book;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->book->recommender->email)
            ->markdown('email.book.created', [
                'book' => $this->book,
            ]);
    }
}
