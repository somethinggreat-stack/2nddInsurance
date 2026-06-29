<?php

namespace App\Mail;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeadReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Lead $lead)
    {
    }

    public function build()
    {
        // Plain-text only: lightweight and deliverable (the host's mail relay
        // rejects heavy HTML emails as spam). Contains everything the lead sent.
        $mail = $this->subject('New lead: ' . $this->lead->name . ' (' . $this->lead->type_label . ')')
            ->text('emails.lead-text');

        // Let Patrick reply straight to the customer.
        if (!empty($this->lead->email)) {
            $mail->replyTo($this->lead->email, $this->lead->name);
        }

        return $mail;
    }
}
