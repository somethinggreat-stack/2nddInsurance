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
        $validated = $request->validate([
            // Contact (required)
            'first_name'        => 'required|string|max:80',
            'last_name'         => 'required|string|max:80',
            'email'             => 'required|email|max:160',
            'phone'             => 'required|string|max:40',
            // Step fields (optional — captured into data payload)
            'dob'               => 'nullable|string|max:40',
            'marital'           => 'nullable|string|max:40',
            'address'           => 'nullable|string|max:200',
            'city'              => 'nullable|string|max:80',
            'zip'               => 'nullable|string|max:12',
            'insurance_types'   => 'nullable|array',
            'insurance_types.*' => 'string|max:40',
            'currently_insured' => 'nullable|string|max:40',
            'current_carrier'   => 'nullable|string|max:80',
            'household_size'    => 'nullable|string|max:40',
            'dependents'        => 'nullable|string|max:40',
            'vehicle_count'     => 'nullable|string|max:40',
            'vehicle_year'      => 'nullable|string|max:200',
            'vehicle_use'       => 'nullable|string|max:40',
            'property_type'     => 'nullable|string|max:40',
            'property_value'    => 'nullable|string|max:40',
            'year_built'        => 'nullable|string|max:20',
            'business_type'     => 'nullable|string|max:120',
            'employees'         => 'nullable|string|max:40',
            'coverage_level'    => 'nullable|string|max:40',
            'budget'            => 'nullable|string|max:40',
            'start_date'        => 'nullable|string|max:40',
            'contact_method'    => 'nullable|string|max:40',
            'best_time'         => 'nullable|string|max:40',
            'notes'             => 'nullable|string|max:2000',
            'website'           => 'nullable|max:0', // honeypot
        ]);

        // Human-readable payload for the agent (skip empties + meta)
        $labels = [
            'dob' => 'Date of Birth', 'marital' => 'Marital Status', 'address' => 'Address',
            'city' => 'City', 'zip' => 'ZIP', 'currently_insured' => 'Currently Insured',
            'current_carrier' => 'Current Carrier', 'household_size' => 'Household Size',
            'dependents' => 'Dependents', 'vehicle_count' => 'Number of Vehicles',
            'vehicle_year' => 'Vehicle(s)', 'vehicle_use' => 'Primary Vehicle Use',
            'property_type' => 'Property Type', 'property_value' => 'Estimated Value',
            'year_built' => 'Year Built', 'business_type' => 'Business Type',
            'employees' => 'Employees', 'coverage_level' => 'Desired Coverage',
            'budget' => 'Monthly Budget', 'start_date' => 'Coverage Start',
            'contact_method' => 'Preferred Contact', 'best_time' => 'Best Time to Reach',
            'notes' => 'Additional Notes',
        ];

        $payload = [];
        foreach ($labels as $field => $label) {
            $val = $validated[$field] ?? null;
            if (!empty($val)) {
                $payload[$label] = is_array($val) ? implode(', ', $val) : $val;
            }
        }
        if (!empty($validated['insurance_types'])) {
            $payload['Insurance Needs'] = implode(', ', $validated['insurance_types']);
        }

        $lead = $this->leads->store([
            'type'      => 'questionnaire',
            'name'      => trim($validated['first_name'] . ' ' . $validated['last_name']),
            'email'     => $validated['email'],
            'phone'     => $validated['phone'],
            'city'      => $validated['city'] ?? null,
            'zip'       => $validated['zip'] ?? null,
            'interests' => $validated['insurance_types'] ?? [],
            'message'   => $validated['notes'] ?? null,
            'data'      => $payload,
        ], $request);

        return redirect()->route('thank-you')->with('lead', $lead->only('name', 'type'));
    }
}
