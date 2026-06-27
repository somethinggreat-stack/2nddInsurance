<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function products()
    {
        return view('pages.products');
    }

    public function whyUs()
    {
        return view('pages.why-us');
    }

    public function testimonials()
    {
        return view('pages.testimonials');
    }

    public function faq()
    {
        return view('pages.faq');
    }

    public function thankYou()
    {
        return view('pages.thank-you', [
            'lead' => session('lead'),
        ]);
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }
}
