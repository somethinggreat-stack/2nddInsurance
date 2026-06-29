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
        // Replies from the lead go straight to Patrick's inbox.
        return $this->subject('Thanks for reaching out — Patrick Yasso Insurance')
            ->replyTo(env('LEAD_NOTIFY_EMAIL', config('site.email')), 'Patrick Yasso')
            ->view('emails.confirmation');
    }
}
