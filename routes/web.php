<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminLeadController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public funnel routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/insurance-products', [PageController::class, 'products'])->name('products');
Route::get('/why-choose-us', [PageController::class, 'whyUs'])->name('why-us');
Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');

// Lead capture
// "Get a Quote" now routes everyone into the questionnaire.
Route::get('/get-a-quote', fn () => redirect()->route('questionnaire'))->name('quote');
Route::get('/schedule-consultation', [LeadController::class, 'consultationForm'])->name('consultation');
Route::post('/schedule-consultation', [LeadController::class, 'storeConsultation'])->middleware('throttle:8,1')->name('consultation.store');

// Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:8,1')->name('contact.store');

// Multi-step questionnaire
Route::get('/questionnaire', [QuestionnaireController::class, 'show'])->name('questionnaire');
Route::post('/questionnaire', [QuestionnaireController::class, 'store'])->middleware('throttle:8,1')->name('questionnaire.store');

// Thank you + legal
Route::get('/thank-you', [PageController::class, 'thankYou'])->name('thank-you');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');

// SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| Mail log viewer — see exactly what each form submission did (success or the
| precise error), so there's no need to keep re-testing.
| Visit: /mail-log?key=yasso-diag-2026
|--------------------------------------------------------------------------
*/
Route::get('/mail-log', function () {
    if (request('key') !== 'yasso-diag-2026') {
        abort(404);
    }

    $file = storage_path('logs/mail.log');
    $writable = is_writable(dirname($file));
    $lines = is_file($file) ? array_slice(file($file, FILE_IGNORE_NEW_LINES), -150) : [];

    return response('<h2>Mail log (last 150 entries)</h2>'
        . '<p>logs folder writable: <b style="color:' . ($writable ? 'green">YES' : 'red">NO — set storage/ to 755') . '</b></p>'
        . '<pre style="background:#0b1020;color:#5dff8f;padding:14px;border-radius:8px;font-size:12px;white-space:pre-wrap">'
        . (count($lines) ? e(implode("\n", $lines)) : '(no entries yet — submit a form, then refresh this page)')
        . '</pre>');
});

/*
|--------------------------------------------------------------------------
| Deploy helper — clears Laravel caches after a `git pull` (no SSH needed).
| Visit once after each deploy: /deploy-clear?key=yasso-diag-2026
|--------------------------------------------------------------------------
*/
Route::get('/deploy-clear', function () {
    if (request('key') !== 'yasso-diag-2026') {
        abort(404);
    }

    $out = [];
    foreach (['config:clear', 'cache:clear', 'view:clear', 'route:clear'] as $cmd) {
        try {
            \Illuminate\Support\Facades\Artisan::call($cmd);
            $out[] = "✅ {$cmd}";
        } catch (\Throwable $e) {
            $out[] = "❌ {$cmd}: " . e($e->getMessage());
        }
    }

    return response('<h2>Caches cleared</h2><pre>' . implode("\n", $out)
        . '</pre><p>Your latest deploy is now live.</p>');
});

/*
|--------------------------------------------------------------------------
| TEMPORARY mail diagnostic — DELETE after email is confirmed working.
| Visit: /mail-test?key=yasso-diag-2026  (shows the real error in browser)
|--------------------------------------------------------------------------
*/
Route::get('/mail-test', function () {
    if (request('key') !== 'yasso-diag-2026') {
        abort(404);
    }

    $to = config('site.notify_email', config('site.email'));
    $out = [];

    // Build a realistic in-memory Lead exactly like the questionnaire creates.
    $lead = new \App\Models\Lead([
        'type'      => 'questionnaire',
        'name'      => 'Smoke Test',
        'email'     => $to,
        'phone'     => '(248) 504-8848',
        'interests' => ['Home', 'Auto'],
        'data'      => ['Quote Type' => 'Home, Auto', 'Full Address' => '305 N. Pontiac Trail, Walled Lake, MI'],
        'source'    => 'mail-test',
        'ip_address' => '127.0.0.1',
    ]);
    $lead->id = 0;
    $lead->created_at = now();
    $lead->updated_at = now();

    // 1) Agent notification (LeadReceived)
    try {
        \Illuminate\Support\Facades\Mail::to($to)->send(new \App\Mail\LeadReceived($lead));
        $out[] = '<p style="color:green">✅ LeadReceived (agent notification) SENT to ' . e($to) . '</p>';
    } catch (\Throwable $e) {
        $out[] = '<p style="color:red">❌ LeadReceived FAILED: <b>' . e($e->getMessage()) . '</b></p>'
            . '<pre style="font-size:11px">' . e($e->getTraceAsString()) . '</pre>';
    }

    // 2) Lead confirmation (LeadConfirmation — embeds the business card)
    try {
        \Illuminate\Support\Facades\Mail::to($to)->send(new \App\Mail\LeadConfirmation($lead));
        $out[] = '<p style="color:green">✅ LeadConfirmation (with business card) SENT to ' . e($to) . '</p>';
    } catch (\Throwable $e) {
        $out[] = '<p style="color:red">❌ LeadConfirmation FAILED: <b>' . e($e->getMessage()) . '</b></p>'
            . '<pre style="font-size:11px">' . e($e->getTraceAsString()) . '</pre>';
    }

    $config = [
        'mailer'     => config('mail.default'),
        'host'       => config('mail.mailers.smtp.host'),
        'port'       => config('mail.mailers.smtp.port'),
        'encryption' => config('mail.mailers.smtp.encryption'),
        'username'   => config('mail.mailers.smtp.username'),
        'from'       => config('mail.from.address'),
        'card_exists' => is_file(public_path('images/business-card.png')) ? 'YES' : 'NO — MISSING!',
    ];

    return response('<h2>Lead email test</h2>' . implode('', $out)
        . '<hr><pre>' . e(json_encode($config, JSON_PRETTY_PRINT)) . '</pre>'
        . '<p>Check ' . e($to) . ' inbox AND spam folder.</p>');
});

/*
|--------------------------------------------------------------------------
| Admin (simple password gate)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->middleware('throttle:5,1')->name('login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/', [AdminLeadController::class, 'index'])->name('leads');
        Route::get('leads/{lead}', [AdminLeadController::class, 'show'])->name('leads.show');
        Route::patch('leads/{lead}', [AdminLeadController::class, 'update'])->name('leads.update');
        Route::delete('leads/{lead}', [AdminLeadController::class, 'destroy'])->name('leads.destroy');
        Route::get('export/leads.csv', [AdminLeadController::class, 'export'])->name('leads.export');
    });
});
