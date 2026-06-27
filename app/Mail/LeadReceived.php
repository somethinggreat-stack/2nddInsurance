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
        return $this->subject('New ' . $this->lead->type_label . ' — ' . $this->lead->name)
            ->view('emails.lead');
    }
}
