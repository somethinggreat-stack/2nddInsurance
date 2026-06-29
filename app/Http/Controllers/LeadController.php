<?php

namespace App\Http\Controllers;

use App\Services\LeadService;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function __construct(private LeadService $leads)
    {
    }

    public function consultationForm()
    {
        return view('pages.consultation');
    }

    public function storeConsultation(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:120',
            'email'     => 'required|email|max:160',
            'phone'     => 'required|string|max:40',
            'date'      => 'nullable|string|max:40',
            'time'      => 'nullable|string|max:40',
            'topic'     => 'nullable|string|max:120',
            'message'   => 'nullable|string|max:2000',
            'website'   => 'nullable|max:0',
        ]);

        $lead = $this->leads->store([
            'type'    => 'consultation',
            'name'    => $data['name'],
            'email'   => $data['email'],
            'phone'   => $data['phone'],
            'message' => $data['message'] ?? null,
            'data'    => [
                'Preferred date'  => $data['date'] ?? null,
                'Preferred time'  => $data['time'] ?? null,
                'Topic'           => $data['topic'] ?? null,
            ],
        ], $request);

        return redirect()->route('thank-you')->with('lead', $lead->only('name', 'type'));
    }
}
