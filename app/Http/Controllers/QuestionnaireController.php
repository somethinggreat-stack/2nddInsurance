<?php

namespace App\Http\Controllers;

use App\Services\LeadService;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    public function __construct(private LeadService $leads)
    {
    }

    public function show()
    {
        return view('pages.questionnaire');
    }

    public function store(Request $request)
    {
        // Accept partial submissions — the only requirement is a way to reach
        // them (a phone OR an email). Everything else is optional.
        $validated = $request->validate([
            'full_name'         => 'nullable|string|max:160',
            'email'             => 'nullable|required_without:phone|email|max:160',
            'phone'             => 'nullable|required_without:email|string|max:40',
            'address'           => 'nullable|string|max:255',
            'dob'               => 'nullable|string|max:40',
            'home_status'       => 'nullable|string|max:40',
            'insurance_types'   => 'nullable|array',
            'insurance_types.*' => 'string|max:60',
            'drivers'           => 'nullable|string|max:2000',
            'vehicles'          => 'nullable|string|max:2000',
            'currently_insured' => 'nullable|string|max:40',
            'current_carrier'   => 'nullable|string|max:120',
            'best_time'         => 'nullable|string|max:60',
            'notes'             => 'nullable|string|max:5000',
            'declarations'      => 'nullable|array|max:10',
            'declarations.*'    => 'file|mimes:pdf,jpg,jpeg,png,heic,webp,doc,docx|max:10240',
            'website'           => 'nullable|max:0', // honeypot
        ], [
            'email.required_without'  => 'Please add a phone number or an email so we can reach you.',
            'phone.required_without'  => 'Please add a phone number or an email so we can reach you.',
            'declarations.*.mimes'    => 'Please upload PDF, image, or document files only.',
            'declarations.*.max'      => 'Each file must be 10 MB or smaller.',
        ]);

        // Human-readable payload for the agent (skip empties)
        $labels = [
            'dob'               => 'Date of Birth',
            'address'           => 'Full Address',
            'home_status'       => 'Own or Rent',
            'drivers'           => 'Drivers (name & DOB)',
            'vehicles'          => 'Vehicles (year/make/model)',
            'currently_insured' => 'Currently Insured',
            'current_carrier'   => 'Current Carrier',
            'best_time'         => 'Best Time to Contact',
        ];

        $payload = [];
        if (!empty($validated['insurance_types'])) {
            $payload['Quote Type'] = implode(', ', $validated['insurance_types']);
        }
        $payload['State'] = 'Michigan'; // service area is locked to Michigan
        foreach ($labels as $field => $label) {
            $val = $validated[$field] ?? null;
            if (!empty($val)) {
                $payload[$label] = $val;
            }
        }

        // Store any uploaded declaration pages and collect their paths for the
        // admin notification email.
        $attachments = [];
        $storedFiles = [];
        if ($request->hasFile('declarations')) {
            foreach ($request->file('declarations') as $file) {
                if ($file && $file->isValid()) {
                    $stored = $file->store('lead-uploads');
                    $attachments[] = [
                        'path' => storage_path('app/' . $stored),
                        'name' => $file->getClientOriginalName(),
                    ];
                    // Persist the stored (relative) path so the admin dashboard
                    // can view/download the exact file later.
                    $storedFiles[] = [
                        'path' => $stored,
                        'name' => $file->getClientOriginalName(),
                    ];
                }
            }
        }
        if ($attachments) {
            $payload['Attached Files'] = implode(', ', array_column($attachments, 'name'));
            $payload['_files'] = $storedFiles; // structured refs for the dashboard (hidden from text output)
        }

        $lead = $this->leads->store([
            'type'      => 'questionnaire',
            'name'      => ($validated['full_name'] ?? '') ?: 'Website Lead',
            'email'     => $validated['email'] ?? null,
            'phone'     => $validated['phone'] ?? null,
            'interests' => $validated['insurance_types'] ?? [],
            'message'   => $validated['notes'] ?? null,
            'data'      => $payload,
        ], $request, $attachments);

        return redirect()->route('thank-you')->with('lead', $lead->only('name', 'type'));
    }
}
