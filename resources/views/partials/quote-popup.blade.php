{{-- Attention-grabbing welcome popup → scrolls to the quote form (#quiz) --}}
<div class="qpop" id="qpop" aria-hidden="true">
    <div class="qpop__backdrop" data-qpop-close></div>
    <div class="qpop__card" role="dialog" aria-modal="true" aria-label="Get your free insurance quote">
        <button class="qpop__x" data-qpop-close aria-label="Close">&times;</button>
        <div class="qpop__badge">⚡ FREE QUOTE — 2 MINUTES</div>
        <h3 class="qpop__title">WANT TO <span>SAVE</span><br>ON INSURANCE?</h3>
        <p class="qpop__sub">Get your <strong>FREE</strong> personalized quote from Patrick today — no obligation, no pressure!</p>
        <a href="{{ route('home') }}#quiz" class="qpop__cta" data-qpop-go>👉 GET MY FREE QUOTE</a>
        <button class="qpop__dismiss" data-qpop-close>No thanks, maybe later</button>
    </div>
</div>

@push('scripts')
<script>
(function () {
    var pop = document.getElementById('qpop');
    if (!pop) return;
    function open()  { pop.classList.add('is-open');  pop.setAttribute('aria-hidden', 'false'); }
    function close() { pop.classList.remove('is-open'); pop.setAttribute('aria-hidden', 'true'); }

    // Show on every page load / refresh.
    setTimeout(open, 700);

    pop.querySelectorAll('[data-qpop-close]').forEach(function (el) { el.addEventListener('click', close); });

    var go = pop.querySelector('[data-qpop-go]');
    if (go) go.addEventListener('click', function (e) {
        // Scroll to the form if it's on this page; otherwise let the link
        // carry the visitor to the homepage form.
        var target = document.getElementById('quiz') || document.getElementById('quoteForm');
        if (target) {
            e.preventDefault();
            close();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            var first = target.querySelector('input, select, textarea');
            if (first) setTimeout(function () { first.focus({ preventScroll: true }); }, 600);
        }
    });

    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });
})();
</script>
@endpush
