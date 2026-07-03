<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminLeadController extends Controller
{
    public function index(Request $request)
    {
        $leads = Lead::query()
            ->type($request->input('type'))
            ->status($request->input('status'))
            ->when($request->input('q'), function ($q, $term) {
                $q->where(function ($w) use ($term) {
                    $w->where('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%")
                        ->orWhere('phone', 'like', "%{$term}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total'     => Lead::count(),
            'new'       => Lead::where('status', 'new')->count(),
            'today'     => Lead::whereDate('created_at', today())->count(),
            'this_week' => Lead::where('created_at', '>=', now()->subDays(7))->count(),
        ];

        return view('admin.leads.index', compact('leads', 'stats'));
    }

    public function show(Lead $lead)
    {
        return view('admin.leads.show', compact('lead'));
    }

    public function downloadFile(Lead $lead, int $index)
    {
        $files = is_array($lead->data) ? ($lead->data['_files'] ?? []) : [];
        abort_unless(isset($files[$index]), 404);

        $relative = $files[$index]['path'] ?? null;
        // Read from the same default disk that store() wrote to.
        abort_unless($relative && Storage::exists($relative), 404);

        // Show inline so images/PDFs open in the browser; other types download.
        $name = $files[$index]['name'] ?? basename($relative);

        return response()->file(Storage::path($relative), [
            'Content-Disposition' => 'inline; filename="' . addslashes($name) . '"',
        ]);
    }

    public function update(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'status' => 'required|in:' . implode(',', Lead::STATUSES),
        ]);

        $lead->status = $data['status'];
        if ($data['status'] !== 'new' && ! $lead->contacted_at) {
            $lead->contacted_at = now();
        }
        $lead->save();

        return back()->with('ok', 'Lead status updated.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('admin.leads')->with('ok', 'Lead deleted.');
    }

    public function export(): StreamedResponse
    {
        $filename = 'leads-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['ID', 'Type', 'Name', 'Email', 'Phone', 'City', 'ZIP', 'Interests', 'Message', 'Details', 'Status', 'Created']);
            Lead::latest()->chunk(200, function ($chunk) use ($out) {
                foreach ($chunk as $l) {
                    fputcsv($out, [
                        $l->id, $l->type_label, $l->name, $l->email, $l->phone, $l->city, $l->zip,
                        is_array($l->interests) ? implode('; ', $l->interests) : '',
                        $l->message,
                        is_array($l->data) ? collect($l->data)->map(fn ($v, $k) => "$k: $v")->implode(' | ') : '',
                        $l->status, $l->created_at,
                    ]);
                }
            });
            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}
