<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailInvite extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $vote = Vote::where('status_vote', Vote::REGISTING)->first();
        return $this->view('emails.mail_invite')->with(['user' => $this->user, 'vote' => $vote]);
    }
}
