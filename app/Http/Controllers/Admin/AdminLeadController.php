<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminLeadController extends Controller
{
    /**
     * Send a live test email to the admin and a submitter address, reporting
     * the exact result (or SMTP error) for each. Visit: /admin/mail-test
     * Optionally set the submitter target with ?to=someone@example.com
     */
    public function mailTest(Request $request)
    {
        $admin     = config('site.notify_email', config('site.email'));
        $submitter = $request->query('to', config('site.email'));

        $targets = ['Admin notification' => $admin, 'Submitter confirmation' => $submitter];
        $rows    = '';

        foreach ($targets as $label => $addr) {
            $ok = true;
            $error = null;
            try {
                Mail::raw(
                    "This is a test email from the {$label} pathway of " . config('site.brand') . ".\n\n"
                    . "If you received this, mail sending is working.",
                    function ($m) use ($addr, $label) {
                        $m->to($addr)->subject(config('site.brand') . ' — mail test (' . $label . ')');
                    }
                );
            } catch (\Throwable $e) {
                $ok = false;
                $error = $e->getMessage();
            }

            $status = $ok
                ? '<span style="color:#0a7d2c;font-weight:700">✓ SENT</span>'
                : '<span style="color:#c1121f;font-weight:700">✗ FAILED</span>';
            $rows .= '<tr><td style="padding:10px 14px;border-bottom:1px solid #eee">' . e($label) . '</td>'
                . '<td style="padding:10px 14px;border-bottom:1px solid #eee">' . e($addr) . '</td>'
                . '<td style="padding:10px 14px;border-bottom:1px solid #eee">' . $status . '</td>'
                . '<td style="padding:10px 14px;border-bottom:1px solid #eee;color:#c1121f;font-size:.85rem">' . e((string) $error) . '</td></tr>';
        }

        $mailer = config('mail.default');
        $host   = config('mail.mailers.smtp.host');
        $port   = config('mail.mailers.smtp.port');

        $html = '<!doctype html><meta charset="utf-8"><title>Mail test</title>'
            . '<div style="font-family:system-ui,Arial,sans-serif;max-width:820px;margin:40px auto;padding:0 16px;color:#1b2440">'
            . '<h1 style="font-size:1.4rem">Mail test</h1>'
            . '<p style="color:#555">Mailer: <b>' . e($mailer) . '</b> · Host: <b>' . e((string) $host) . '</b> · Port: <b>' . e((string) $port) . '</b></p>'
            . '<table style="border-collapse:collapse;width:100%;font-size:.95rem;border:1px solid #eee;border-radius:8px;overflow:hidden">'
            . '<tr style="background:#f5f7fb"><th style="text-align:left;padding:10px 14px">Pathway</th><th style="text-align:left;padding:10px 14px">To</th><th style="text-align:left;padding:10px 14px">Result</th><th style="text-align:left;padding:10px 14px">Error (if any)</th></tr>'
            . $rows . '</table>'
            . '<p style="color:#555;margin-top:18px"><b>✓ SENT</b> means the mail server accepted it (check the inbox/spam of each address to confirm delivery). '
            . '<b>✗ FAILED</b> shows the exact reason — usually a wrong host/port or bad mailbox password.</p>'
            . '<p style="margin-top:18px"><a href="' . route('admin.mail.log') . '">View mail log →</a> &nbsp;·&nbsp; <a href="' . route('admin.leads') . '">Back to dashboard</a></p>'
            . '</div>';

        return response($html);
    }

    /**
     * Show the running mail log (every send attempt with OK/FAIL + reason).
     * Visit: /admin/mail-log
     */
    public function mailLog()
    {
        $path    = storage_path('logs/mail.log');
        $content = is_file($path) ? trim(file_get_contents($path)) : '';

        // Keep it light — show the most recent ~300 lines, newest at the bottom.
        if ($content !== '') {
            $lines   = preg_split('/\r?\n/', $content);
            $content = implode("\n", array_slice($lines, -300));
        } else {
            $content = '(mail.log is empty — no email has been attempted yet, or logging could not write to storage/logs)';
        }

        $html = '<!doctype html><meta charset="utf-8"><title>Mail log</title>'
            . '<div style="font-family:system-ui,Arial,sans-serif;max-width:960px;margin:40px auto;padding:0 16px;color:#1b2440">'
            . '<h1 style="font-size:1.4rem">Mail log</h1>'
            . '<p style="color:#555">Each line records one send attempt: <b>OK</b> = accepted by the mail server, <b>FAIL</b> = rejected (reason shown).</p>'
            . '<pre style="background:#0f1524;color:#d7e0f2;padding:16px;border-radius:10px;overflow:auto;font-size:.82rem;line-height:1.5;white-space:pre-wrap;word-break:break-word">'
            . e($content) . '</pre>'
            . '<p style="margin-top:18px"><a href="' . route('admin.mail.test') . '">Send a test email →</a> &nbsp;·&nbsp; <a href="' . route('admin.leads') . '">Back to dashboard</a></p>'
            . '</div>';

        return response($html);
    }

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
