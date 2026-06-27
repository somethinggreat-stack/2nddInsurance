<?php

namespace App\Http\Controllers;

class SitemapController extends Controller
{
    public function index()
    {
        $routes = [
            ['home', '1.0', 'weekly'],
            ['about', '0.8', 'monthly'],
            ['services', '0.9', 'monthly'],
            ['products', '0.9', 'monthly'],
            ['why-us', '0.7', 'monthly'],
            ['testimonials', '0.6', 'monthly'],
            ['faq', '0.6', 'monthly'],
            ['contact', '0.8', 'monthly'],
            ['quote', '0.9', 'weekly'],
            ['questionnaire', '0.9', 'weekly'],
            ['consultation', '0.7', 'monthly'],
            ['privacy', '0.3', 'yearly'],
            ['terms', '0.3', 'yearly'],
        ];

        $urls = [];
        foreach ($routes as [$name, $priority, $freq]) {
            $urls[] = [
                'loc'      => route($name),
                'priority' => $priority,
                'freq'     => $freq,
            ];
        }

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
