<?php

namespace App\Services;

use App\Mail\LeadConfirmation;
use App\Mail\LeadReceived;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LeadService
{
    /**
     * Persist a lead and notify the agent (failures are logged, never block the user).
     */
    public function store(array $attributes, Request $request): Lead
    {
        $attributes['ip_address'] = $request->ip();
        $attributes['user_agent'] = substr((string) $request->userAgent(), 0, 500);
        $attributes['source']     = $attributes['source'] ?? url()->previous();

        $lead = Lead::create($attributes);

        // 1) Notify the agent of the new lead.
        $to = config('site.notify_email', config('site.email'));
        try {
            Mail::to($to)->send(new LeadReceived($lead));
            $this->logMail("OK    notification -> {$to}  (lead #{$lead->id} {$lead->name})");
        } catch (\Throwable $e) {
            $this->logMail("FAIL  notification -> {$to}  (lead #{$lead->id}): " . $e->getMessage());
            Log::warning('Lead notification failed: ' . $e->getMessage(), ['lead_id' => $lead->id]);
        }

        // 2) Send a confirmation to the lead (if they gave an email).
        if (!empty($lead->email)) {
            try {
                Mail::to($lead->email)->send(new LeadConfirmation($lead));
                $this->logMail("OK    confirmation -> {$lead->email}  (lead #{$lead->id})");
            } catch (\Throwable $e) {
                $this->logMail("FAIL  confirmation -> {$lead->email}  (lead #{$lead->id}): " . $e->getMessage());
                Log::warning('Lead confirmation failed: ' . $e->getMessage(), ['lead_id' => $lead->id]);
            }
        }

        return $lead;
    }

    /**
     * Append one line to storage/logs/mail.log so every send (success or the
     * exact failure reason) is visible at /mail-log — no repeated testing.
     */
    private function logMail(string $line): void
    {
        try {
            file_put_contents(
                storage_path('logs/mail.log'),
                '[' . date('Y-m-d H:i:s') . '] ' . $line . PHP_EOL,
                FILE_APPEND | LOCK_EX
            );
        } catch (\Throwable $e) {
            // Never let logging break the request.
        }
    }
}
