<?php

namespace Wagg\Yondel\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvitationCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $team;

    private $inviter;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($team, $inviter)
    {
        $this->team = $team;
        $this->inviter = $inviter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->inviter->email)
            ->markdown('email.invitation.created', [
                'team' => $this->team,
                'inviter' => $this->inviter,
                'url' => 'http://google.com',
            ]);
    }
}
