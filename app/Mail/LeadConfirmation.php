<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Lead $lead)
    {
    }

    public function build()
    {
        // Replies from the lead go straight to the team's inbox.
        return $this->subject('Thanks for reaching out — ' . config('site.brand'))
            ->replyTo(config('site.notify_email', config('site.email')), config('site.brand'))
            ->view('emails.confirmation');
    }
}
