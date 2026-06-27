@php $site = config('site'); @endphp
<form id="quizForm" class="quiz" action="{{ route('questionnaire.store') }}" method="POST">
    @csrf
    <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

    {{-- Progress --}}
    <div class="quiz__progress">
        <div class="quiz__bar"><i></i></div>
        <div class="quiz__meta">
            <span>Step <span data-cur>1</span> of <span data-tot>1</span> · <span data-stepname></span></span>
            <span class="quiz__steps-dots">
                @for ($i = 0; $i < 11; $i++)<span class="quiz__dot"></span>@endfor
            </span>
        </div>
    </div>

    {{-- STEP 1: Insurance Needs --}}
    <div class="quiz-step" data-name="Insurance Needs">
        <div class="quiz-step__head">
            <span class="quiz-step__num">Step 1</span>
            <h2>What would you like to protect?</h2>
            <p>Select all that apply — you can choose more than one.</p>
        </div>
        <div class="choice-grid">
            @foreach ($site['quote_options'] as $s)
                <label class="choice">
                    <input type="checkbox" name="insurance_types[]" value="{{ $s['title'] }}">
                    <span class="choice__box"><x-icon :name="$s['icon']" /><span class="t">{{ $s['title'] }}</span></span>
                    <span class="choice__check"><x-icon name="check" style="width:.8em;height:.8em" /></span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- STEP 2: Personal Info --}}
    <div class="quiz-step" data-name="About You">
        <div class="quiz-step__head"><span class="quiz-step__num">Step 2</span><h2>Tell me about yourself</h2><p>The basics help me personalize your options.</p></div>
        <div class="form-grid-2">
            <div class="field"><label>First Name <span class="req">*</span></label><input type="text" name="first_name" value="{{ old('first_name') }}" required data-err="Please enter your first name"><span class="err"></span></div>
            <div class="field"><label>Last Name <span class="req">*</span></label><input type="text" name="last_name" value="{{ old('last_name') }}" required data-err="Please enter your last name"><span class="err"></span></div>
        </div>
        <div class="form-grid-2">
            <div class="field"><label>Date of Birth</label><input type="date" name="dob" value="{{ old('dob') }}"></div>
            <div class="field"><label>Marital Status</label>
                <select name="marital"><option value="">Select…</option><option>Single</option><option>Married</option><option>Domestic Partner</option><option>Divorced</option><option>Widowed</option></select>
            </div>
        </div>
    </div>

    {{-- STEP 3: Current Coverage --}}
    <div class="quiz-step" data-name="Current Coverage">
        <div class="quiz-step__head"><span class="quiz-step__num">Step 3</span><h2>Do you currently have insurance?</h2><p>This helps me spot gaps and savings.</p></div>
        <div class="choice-grid" style="grid-template-columns:repeat(auto-fit,minmax(140px,1fr))">
            @foreach (['Yes, I have coverage', 'No, I need new coverage', 'Some, looking to add'] as $opt)
                <label class="choice">
                    <input type="radio" name="currently_insured" value="{{ $opt }}">
                    <span class="choice__box"><x-icon name="shield" /><span class="t" style="font-size:.95rem">{{ $opt }}</span></span>
                    <span class="choice__check"><x-icon name="check" style="width:.8em;height:.8em" /></span>
                </label>
            @endforeach
        </div>
        <div class="field mt-3"><label>Current Insurance Carrier (if any)</label><input type="text" name="current_carrier" value="{{ old('current_carrier') }}" placeholder="e.g. State Farm, Progressive…"></div>
    </div>

    {{-- STEP 4: Household --}}
    <div class="quiz-step" data-name="Household">
        <div class="quiz-step__head"><span class="quiz-step__num">Step 4</span><h2>Your household</h2><p>Helps tailor life and family coverage.</p></div>
        <div class="form-grid-2">
            <div class="field"><label>Household Size</label>
                <select name="household_size"><option value="">Select…</option><option>Just me</option><option>2</option><option>3</option><option>4</option><option>5+</option></select>
            </div>
            <div class="field"><label>Dependents / Children</label>
                <select name="dependents"><option value="">Select…</option><option>None</option><option>1</option><option>2</option><option>3</option><option>4+</option></select>
            </div>
        </div>
    </div>

    {{-- STEP 5: Vehicles --}}
    <div class="quiz-step" data-name="Vehicles">
        <div class="quiz-step__head"><span class="quiz-step__num">Step 5</span><h2>Your vehicles</h2><p>For auto coverage — skip if not applicable.</p></div>
        <div class="form-grid-2">
            <div class="field"><label>How many vehicles?</label>
                <select name="vehicle_count"><option value="">Select…</option><option>None</option><option>1</option><option>2</option><option>3</option><option>4+</option></select>
            </div>
            <div class="field"><label>Primary Use</label>
                <select name="vehicle_use"><option value="">Select…</option><option>Commuting</option><option>Personal / Pleasure</option><option>Business</option><option>Rideshare</option></select>
            </div>
        </div>
        <div class="field"><label>Vehicle Year, Make &amp; Model</label><input type="text" name="vehicle_year" value="{{ old('vehicle_year') }}" placeholder="e.g. 2021 Toyota RAV4"></div>
    </div>

    {{-- STEP 6: Property --}}
    <div class="quiz-step" data-name="Property">
        <div class="quiz-step__head"><span class="quiz-step__num">Step 6</span><h2>Your home or property</h2><p>For home/renters coverage — skip if not applicable.</p></div>
        <div class="form-grid-2">
            <div class="field"><label>Property Type</label>
                <select name="property_type"><option value="">Select…</option><option>Single-Family Home</option><option>Condo</option><option>Townhouse</option><option>Rental / Renting</option><option>Multi-Family</option></select>
            </div>
            <div class="field"><label>Year Built</label><input type="text" name="year_built" value="{{ old('year_built') }}" placeholder="e.g. 2005"></div>
        </div>
        <div class="field"><label>Estimated Property Value</label>
            <select name="property_value"><option value="">Select…</option><option>Under $150k</option><option>$150k – $300k</option><option>$300k – $500k</option><option>$500k – $750k</option><option>$750k+</option></select>
        </div>
    </div>

    {{-- STEP 7: Business --}}
    <div class="quiz-step" data-name="Business">
        <div class="quiz-step__head"><span class="quiz-step__num">Step 7</span><h2>Your business</h2><p>For business coverage — skip if not applicable.</p></div>
        <div class="form-grid-2">
            <div class="field"><label>Type of Business</label><input type="text" name="business_type" value="{{ old('business_type') }}" placeholder="e.g. Restaurant, Contractor…"></div>
            <div class="field"><label>Number of Employees</label>
                <select name="employees"><option value="">Select…</option><option>Just me</option><option>2–5</option><option>6–10</option><option>11–25</option><option>25+</option></select>
            </div>
        </div>
    </div>

    {{-- STEP 8: Desired Coverage & Budget --}}
    <div class="quiz-step" data-name="Coverage & Budget">
        <div class="quiz-step__head"><span class="quiz-step__num">Step 8</span><h2>Your coverage goals</h2><p>So I can match you to the right level and price.</p></div>
        <div class="field"><label>Desired Coverage Level</label>
            <div class="choice-grid" style="grid-template-columns:repeat(auto-fit,minmax(140px,1fr))">
                @foreach (['Basic / Budget', 'Balanced', 'Maximum Protection'] as $lvl)
                    <label class="choice"><input type="radio" name="coverage_level" value="{{ $lvl }}"><span class="choice__box"><x-icon name="shield" /><span class="t" style="font-size:.95rem">{{ $lvl }}</span></span><span class="choice__check"><x-icon name="check" style="width:.8em;height:.8em" /></span></label>
                @endforeach
            </div>
        </div>
        <div class="form-grid-2 mt-3">
            <div class="field"><label>Monthly Budget</label>
                <select name="budget"><option value="">Select…</option><option>Under $100</option><option>$100 – $200</option><option>$200 – $350</option><option>$350+</option><option>Not sure yet</option></select>
            </div>
            <div class="field"><label>When do you need coverage?</label>
                <select name="start_date"><option value="">Select…</option><option>Right away</option><option>Within 2 weeks</option><option>Within a month</option><option>Just exploring</option></select>
            </div>
        </div>
    </div>

    {{-- STEP 9: Contact Preferences --}}
    <div class="quiz-step" data-name="Preferences">
        <div class="quiz-step__head"><span class="quiz-step__num">Step 9</span><h2>How should I reach you?</h2><p>I'll use this to follow up with your personalized options.</p></div>
        <div class="field"><label>Preferred Contact Method</label>
            <div class="choice-grid" style="grid-template-columns:repeat(auto-fit,minmax(120px,1fr))">
                @foreach (['Phone' => 'phone', 'Text' => 'chat', 'Email' => 'mail'] as $label => $ic)
                    <label class="choice"><input type="radio" name="contact_method" value="{{ $label }}"><span class="choice__box"><x-icon :name="$ic" /><span class="t">{{ $label }}</span></span><span class="choice__check"><x-icon name="check" style="width:.8em;height:.8em" /></span></label>
                @endforeach
            </div>
        </div>
        <div class="field mt-3"><label>Best Time to Reach You</label>
            <select name="best_time"><option value="">Select…</option><option>Morning</option><option>Afternoon</option><option>Evening</option><option>Anytime</option></select>
        </div>
    </div>

    {{-- STEP 10: Contact Details --}}
    <div class="quiz-step" data-name="Your Details">
        <div class="quiz-step__head"><span class="quiz-step__num">Step 10</span><h2>Where should I send your quote?</h2><p>Almost done! Your info stays private and is never sold.</p></div>
        <div class="form-grid-2">
            <div class="field"><label>Email <span class="req">*</span></label><input type="email" name="email" value="{{ old('email') }}" required data-err="Please enter a valid email"><span class="err"></span></div>
            <div class="field"><label>Phone <span class="req">*</span></label><input type="tel" name="phone" value="{{ old('phone') }}" placeholder="(248) 000-0000" required data-err="Please enter a valid phone"><span class="err"></span></div>
        </div>
        <div class="form-grid-2">
            <div class="field"><label>City</label><input type="text" name="city" value="{{ old('city') }}" placeholder="{{ $site['city'] }}"></div>
            <div class="field"><label>ZIP Code</label><input type="text" name="zip" value="{{ old('zip') }}" placeholder="{{ $site['zip'] }}"></div>
        </div>
        <div class="field"><label>Additional Notes</label><textarea name="notes" placeholder="Anything else that would help me prepare your quote…">{{ old('notes') }}</textarea></div>
    </div>

    {{-- STEP 11: Review --}}
    <div class="quiz-step" data-name="Review" data-review>
        <div class="quiz-step__head"><span class="quiz-step__num">Final Step</span><h2>Review &amp; submit</h2><p>Please confirm your details below, then submit to get your personalized quote.</p></div>
        <div data-review-body></div>
        <div class="alert alert--ok mt-3"><x-icon name="lock" /> <span>By submitting you agree to be contacted by {{ $site['agent'] }} about your quote. I never sell your information.</span></div>
    </div>

    {{-- Nav --}}
    <div class="quiz__nav">
        <button type="button" class="btn btn--ghost" data-back><x-icon name="chevron-right" style="transform:rotate(180deg)" /> Back</button>
        <div class="spacer"></div>
        <button type="button" class="btn btn--primary" data-next>Continue <x-icon name="arrow-right" /></button>
        <button type="submit" class="btn btn--primary btn--lg" data-submit style="display:none"><x-icon name="check" /> Get My Personalized Quote</button>
    </div>
</form>

@push('scripts')
<script src="{{ asset('js/questionnaire.js') }}" defer></script>
@endpush
