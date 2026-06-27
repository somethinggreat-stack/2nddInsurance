<?php

namespace App\Services;

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

        try {
            $to = env('LEAD_NOTIFY_EMAIL', config('site.email'));
            Mail::to($to)->send(new LeadReceived($lead));
        } catch (\Throwable $e) {
            Log::warning('Lead notification failed: ' . $e->getMessage(), ['lead_id' => $lead->id]);
        }

        return $lead;
    }
}
