<?php

namespace App\Http\Controllers;

use App\Services\LeadService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(private LeadService $leads)
    {
    }

    public function show()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'required|email|max:160',
            'phone'   => 'nullable|string|max:40',
            'subject' => 'nullable|string|max:160',
            'message' => 'required|string|max:2000',
            'website' => 'nullable|max:0', // honeypot
        ]);

        $lead = $this->leads->store([
            'type'    => 'contact',
            'name'    => $data['name'],
            'email'   => $data['email'],
            'phone'   => $data['phone'] ?? null,
            'message' => $data['message'],
            'data'    => ['Subject' => $data['subject'] ?? null],
        ], $request);

        return redirect()->route('thank-you')->with('lead', $lead->only('name', 'type'));
    }
}
