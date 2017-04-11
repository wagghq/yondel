<?php

namespace Wagg\Yondel\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvitationCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $invitation;

    /**
     * Create a new message instance.
     *
     * @param $invitation
     */
    public function __construct($invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->invitation->inviter->email)
            ->markdown('email.invitation.created', [
                'invitation' => $this->invitation,
            ]);
    }
}
