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
        Route::get('leads/{lead}/file/{index}', [AdminLeadController::class, 'downloadFile'])->name('leads.file');
        Route::patch('leads/{lead}', [AdminLeadController::class, 'update'])->name('leads.update');
        Route::delete('leads/{lead}', [AdminLeadController::class, 'destroy'])->name('leads.destroy');
        Route::get('export/leads.csv', [AdminLeadController::class, 'export'])->name('leads.export');
    });
});
