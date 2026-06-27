<?php

namespace App\Http\Controllers;

use App\Services\LeadService;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function __construct(private LeadService $leads)
    {
    }

    public function quoteForm()
    {
        return view('pages.quote');
    }

    public function storeQuote(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:120',
            'email'       => 'required|email|max:160',
            'phone'       => 'required|string|max:40',
            'zip'         => 'nullable|string|max:12',
            'interests'   => 'required|array|min:1',
            'interests.*' => 'string|max:40',
            'message'     => 'nullable|string|max:2000',
            'website'     => 'nullable|max:0', // honeypot
        ]);

        $lead = $this->leads->store([
            'type'      => 'quote',
            'name'      => $data['name'],
            'email'     => $data['email'],
            'phone'     => $data['phone'],
            'zip'       => $data['zip'] ?? null,
            'interests' => $data['interests'],
            'message'   => $data['message'] ?? null,
        ], $request);

        return redirect()->route('thank-you')->with('lead', $lead->only('name', 'type'));
    }

    public function storeCallback(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:120',
            'phone'   => 'required|string|max:40',
            'time'    => 'nullable|string|max:60',
            'website' => 'nullable|max:0',
        ]);

        $this->leads->store([
            'type'    => 'callback',
            'name'    => $data['name'],
            'phone'   => $data['phone'],
            'message' => isset($data['time']) ? 'Preferred time: ' . $data['time'] : null,
        ], $request);

        if ($request->wantsJson()) {
            return response()->json(['ok' => true]);
        }

        return redirect()->route('thank-you')->with('lead', ['name' => $data['name'], 'type' => 'callback']);
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
