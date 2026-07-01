<?php

/*
|--------------------------------------------------------------------------
| Site / Business Content (single source of truth)
|--------------------------------------------------------------------------
| Patrick Yasso — Farmers Insurance Agent.
| Edit business details, services, testimonials and FAQs here. Everything
| on the website reads from this file so the client can manage content
| without touching templates.
*/

return [

    'agent'    => 'Patrick Yasso',
    'role'     => 'Insurance Agent',
    'company'  => 'Farmers Insurance',
    'brand'    => 'Patrick Yasso Insurance',
    'license'  => 'MI License #16520971',
    'tagline'  => 'Protecting Michigan Families & Businesses',
    'subtag'   => "Let's protect what matters most.",

    'phone'         => env('AGENT_PHONE', '(248) 504-8848'),
    'phone_raw'     => '+12485048848',
    'email'         => env('AGENT_EMAIL', 'PYasso@FarmersAgent.com'),
    // Where "new lead" admin notifications are sent (hardcoded so a git pull
    // deploys it — no server .env edit needed).
    'notify_email'  => 'PYasso@FarmersAgent.com',
    'address'       => '305 N. Pontiac Trail, Suite E',
    'city'          => 'Walled Lake',
    'state'         => 'MI',
    'zip'           => '48390',
    'map_query'     => '305 N. Pontiac Trail, Suite E, Walled Lake, MI 48390',

    'hours' => [
        ['d' => 'Monday – Friday', 'h' => '9:00 AM – 6:00 PM'],
        ['d' => 'Saturday',        'h' => 'By Appointment'],
        ['d' => 'Sunday',          'h' => 'Closed'],
    ],

    'socials' => [
        'facebook'  => '#',
        'instagram' => '#',
        'linkedin'  => '#',
        'google'    => '#',
    ],

    // Headline credibility stats — UPDATE to the agent's real figures.
    'stats' => [
        ['n' => 20,   'suffix' => '+',  'label' => 'Years of Experience'],
        ['n' => 2500, 'suffix' => '+',  'label' => 'Families & Businesses Protected'],
        ['n' => 4.9,  'suffix' => '',   'label' => 'Average Client Rating'],
        ['n' => 100,  'suffix' => '%',  'label' => 'Statewide Michigan Service'],
    ],

    'trust_points' => [
        'Insuring All of Michigan',
        'Personalized Service You Can Trust',
        'Proudly Serving Michigan',
    ],

    // Core lines of business
    'services' => [
        [
            'key' => 'auto', 'icon' => 'car', 'tone' => 'ig-red',
            'title' => 'Auto Insurance',
            'short' => 'Protect every drive with coverage tailored to Michigan roads and rates.',
            'points' => ['Liability & full coverage', 'Accident forgiveness options', 'Bundling discounts', 'Roadside assistance'],
        ],
        [
            'key' => 'home', 'icon' => 'home', 'tone' => 'ig-navy',
            'title' => 'Home Insurance',
            'short' => 'Safeguard your home and everything inside it against the unexpected.',
            'points' => ['Dwelling & property', 'Personal liability', 'Replacement cost coverage', 'Renters & condo options'],
        ],
        [
            'key' => 'life', 'icon' => 'heart', 'tone' => 'ig-blue',
            'title' => 'Life Insurance',
            'short' => "Give your family lasting financial security and peace of mind.",
            'points' => ['Term & whole life', 'Income protection', 'Final expense', 'Living benefits'],
        ],
        [
            'key' => 'business', 'icon' => 'briefcase', 'tone' => 'ig-red',
            'title' => 'Business Insurance',
            'short' => 'Coverage that keeps your Michigan business moving forward.',
            'points' => ['General liability', 'Commercial property', 'Workers’ comp', 'Commercial auto'],
        ],
    ],

    /*
    | Quote categories — shown as selectable cards on the home grid, quote form
    | and questionnaire (mirrors the Farmers "Get a quote online" options).
    */
    'quote_options' => [
        ['key' => 'auto',          'icon' => 'car',    'tone' => 'ig-red',  'title' => 'Auto Insurance',          'short' => 'Protect every drive with coverage tailored to Michigan roads and rates.', 'points' => ['Liability & full coverage', 'Accident forgiveness', 'Bundling discounts', 'Roadside assistance']],
        ['key' => 'home',          'icon' => 'home',   'tone' => 'ig-navy', 'title' => 'Home Insurance',          'short' => 'Safeguard your home and everything inside it against the unexpected.',      'points' => ['Dwelling & property', 'Personal liability', 'Replacement cost', 'Loss of use']],
        ['key' => 'renters',       'icon' => 'sofa',   'tone' => 'ig-blue', 'title' => 'Renters Insurance',       'short' => 'Affordable protection for your belongings and liability in a rental.',      'points' => ['Personal property', 'Liability coverage', 'Loss of use', 'Low monthly cost']],
        ['key' => 'auto_home',     'icon' => 'layers', 'tone' => 'ig-red',  'title' => 'Auto + Home Bundle',      'short' => 'Bundle your auto and home to simplify your life and save more.',            'points' => ['One simple bill', 'Multi-policy discount', 'Coordinated coverage', 'One dedicated agent']],
        ['key' => 'auto_renters',  'icon' => 'layers', 'tone' => 'ig-navy', 'title' => 'Auto + Renters Bundle',   'short' => 'Pair auto and renters coverage for easy, automatic savings.',               'points' => ['Multi-policy discount', 'Renter-friendly', 'One point of contact', 'Quick setup']],
        ['key' => 'life',          'icon' => 'family', 'tone' => 'ig-blue', 'title' => 'Life Insurance',          'short' => 'Give your family lasting financial security and peace of mind.',             'points' => ['Term & whole life', 'Income protection', 'Final expense', 'Living benefits']],
        ['key' => 'business',      'icon' => 'store',  'tone' => 'ig-red',  'title' => 'Business Insurance',      'short' => 'Coverage that keeps your Michigan business moving forward.',                 'points' => ['General liability', 'Commercial property', 'Workers’ comp', 'Commercial auto']],
        ['key' => 'condo',         'icon' => 'building','tone' => 'ig-navy','title' => 'Condo Insurance',         'short' => 'HO-6 coverage tailored to condo and townhome owners.',                      'points' => ['Interior & property', 'Personal liability', 'Loss assessment', 'Upgrades & betterments']],
    ],

    // Why work with me
    'reasons' => [
        ['icon' => 'pin',     'title' => 'Statewide Michigan Coverage', 'text' => "I insure families and businesses across all of Michigan \u{2014} wherever you are in the state, I can help."],
        ['icon' => 'user',    'title' => "I'm Your Dedicated Agent",  'text' => 'You work directly with me — never a call center. Personal, responsive, and accountable.'],
        ['icon' => 'shield',  'title' => 'Trusted Farmers Coverage',  'text' => 'I bring you the strength and stability of Farmers Insurance, delivered with a personal touch.'],
        ['icon' => 'wallet',  'title' => 'Smart Bundling & Savings',  'text' => "I'll combine your auto, home, life and business policies to unlock meaningful discounts."],
        ['icon' => 'clock',   'title' => 'Fast, Easy Quotes',         'text' => 'I make it easy to get a tailored quote — by phone, online, or in person at my office.'],
        ['icon' => 'support', 'title' => 'Claims Support That Counts', 'text' => "I'm a real advocate in your corner, guiding you through the claims process."],
    ],

    // Process steps
    'steps' => [
        ['title' => 'Tell Me About You',  'text' => 'Share a few quick details about what you want to protect — it takes minutes.'],
        ['title' => 'I Build Your Plan',  'text' => 'I review your needs and build coverage options matched to your budget.'],
        ['title' => 'You Get Covered',    'text' => 'Choose your plan with confidence and enjoy lasting peace of mind.'],
    ],

    // Verified client reviews (from Patrick's Farmers agent profile).
    'reviews_rating'  => '4.9',
    'reviews_count'   => 31,
    'reviews_url'     => 'https://agents.farmers.com/mi/walled-lake/patrick-yasso/',
    'testimonials' => [
        ['name' => 'Colleen K.', 'date' => 'February 2025', 'rating' => 5, 'quote' => 'My husband and I were insured by Progressive and our car insurance renewal doubled on both vehicles and almost doubled on our homeowners, so I called Farmers and Patrick answered. He was very polite and willing to get me the best rate — and he surely did. We are very pleased and happy to now be insured by Farmers. Thank you, Patrick, for all your help! — Colleen and Jeff Kneale'],
        ['name' => 'Craig H.',   'date' => 'February 2025', 'rating' => 5, 'quote' => 'Even though I called just before 5:00, they spent a lot of time with me, getting a quote that reduced my car insurance by $600 per year and cut my homeowners insurance by almost half. I appreciate both the price and the personal attention I received.'],
        ['name' => 'Sahira T.',  'date' => 'January 2025',  'rating' => 5, 'quote' => 'Patrick is the man — he is very talented and knows what he is doing. Will refer him to multiple families.'],
        ['name' => 'Mary O.',    'date' => 'January 2024',  'rating' => 5, 'quote' => 'Patrick was very knowledgeable and helpful when I called him. Honest too — I would definitely give him a raise!'],
        ['name' => 'Bharat V.',  'date' => 'December 2023', 'rating' => 5, 'quote' => 'I recently switched all my insurance needs to Farmers and Patrick did a great job assisting and going over the details, even though it consumed a lot of his time.'],
        ['name' => 'Lauren E.',  'date' => 'December 2023', 'rating' => 5, 'quote' => 'He gave me the info I needed for auto and home insurance. He was very knowledgeable and agreed to speak with my son about the insurance too. He was thorough about everything.'],
        ['name' => 'Anthony J.', 'date' => 'November 2023', 'rating' => 5, 'quote' => 'Pat puts his clients first, is trustworthy, and very accessible. I recommend him to everyone.'],
        ['name' => 'Aleksander B.', 'date' => 'November 2023', 'rating' => 5, 'quote' => 'Quick and easy — the best kind of agent. Got me exactly what I needed with no stress. Much appreciated!'],
        ['name' => 'Sheryl S.',  'date' => 'October 2023',  'rating' => 5, 'quote' => 'So far all of my questions have been answered.'],
        ['name' => 'Melodi J.',  'date' => 'October 2023',  'rating' => 5, 'quote' => 'Patrick Yasso is a wonderful agent and understands what service is all about! He took care of my needs promptly, explained everything, and answered all of my questions. And I was happy to save some money!'],
        ['name' => 'Cory S.',    'date' => 'October 2023',  'rating' => 5, 'quote' => 'Very fast and polite. He reached out to my mortgage office and got everything he needed to write up a policy — and it came in $1,000 less per year than the others. Oh, and it was all done in about 5 minutes!'],
        ['name' => 'Curtis J.',  'date' => 'October 2023',  'rating' => 5, 'quote' => 'Looking out for my best interest!'],
        ['name' => 'Jacob Y.',   'date' => 'October 2023',  'rating' => 5, 'quote' => 'I wish I could give this more than 5 stars! I spent an entire week calling 10+ companies and speaking to dozens of reps before I thankfully met Patrick. What a relief. He looked out for my best interest and is EXACTLY what you want for home and auto insurance — knowledgeable, professional, and honest, unlike any rep I have ever dealt with. I cannot thank you enough, Patrick!'],
        ['name' => 'Richard B.', 'date' => 'September 2023', 'rating' => 5, 'quote' => 'He did his job and was very friendly.'],
        ['name' => 'Julia W.',   'date' => 'September 2023', 'rating' => 5, 'quote' => 'Patrick was very patient with me and answered all my questions (and I had a lot!) before getting my homeowners insurance. Would recommend him anytime.'],
        ['name' => 'Kevin B.',   'date' => 'September 2023', 'rating' => 5, 'quote' => 'Great experience — very responsive.'],
        ['name' => 'Alvin K.',   'date' => 'September 2023', 'rating' => 5, 'quote' => 'Excellent agent — very helpful and knowledgeable. Got my quote and everything switched over within a day.'],
        ['name' => 'Brennon P.', 'date' => 'September 2023', 'rating' => 5, 'quote' => 'Extremely friendly and very helpful in helping me make my decision with my coverage.'],
        ['name' => 'Daniel C.',  'date' => 'August 2023',   'rating' => 5, 'quote' => 'He had thorough knowledge of the products Farmers offers and effectively communicated the differences between Farmers and others. Patrick was easy to speak with and the enrollment was surprisingly efficient. Would definitely recommend. Thank you.'],
        ['name' => 'Lynn H.',    'date' => 'August 2023',   'rating' => 5, 'quote' => 'Patrick made reviewing my current plan easy and found savings for me, in addition to getting better coverage than I had, by switching to Farmers.'],
    ],

    'faqs' => [
        ['q' => 'What types of insurance do you offer?', 'a' => 'As a Farmers Insurance agent I help with Auto, Home, Life and Business insurance — plus renters, condo, and commercial coverage. If you’re not sure what you need, I’ll help you figure it out.'],
        ['q' => 'How do I get a quote?', 'a' => 'You can request a free quote online through our quote form or detailed questionnaire, call (248) 504-8848, or stop by the office in Walled Lake. Most quotes take just a few minutes.'],
        ['q' => 'Can I bundle policies to save money?', 'a' => 'Absolutely. Bundling auto, home, life and business policies is one of the easiest ways to lower your overall premium. I’ll show you exactly what you could save.'],
        ['q' => 'Do you only serve the Walled Lake area?', 'a' => 'I’m based in Walled Lake but proudly serve families and businesses throughout Michigan. Wherever you are in the state, I can help.'],
        ['q' => 'Will I work with you directly or a call center?', 'a' => 'You work directly with me, Patrick Yasso. You get one dedicated, accountable agent who knows you and your coverage.'],
        ['q' => 'What do I need to switch my insurance?', 'a' => 'Usually just your current policy details and a few basics about what you’re insuring. I’ll handle the heavy lifting and make the switch smooth.'],
        ['q' => 'How does the claims process work?', 'a' => 'If something happens, I’m your advocate. I’ll guide you through filing and follow up to help make sure you’re taken care of quickly.'],
    ],

    'coverage_areas' => ['Walled Lake', 'Novi', 'Commerce Township', 'Wixom', 'White Lake', 'Milford', 'West Bloomfield', 'Wolverine Lake', 'Farmington Hills', 'Northville'],
];
