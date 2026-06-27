@if (session('ok'))
    <div class="alert alert--ok"><x-icon name="check-circle" /> <span>{{ session('ok') }}</span></div>
@endif
@if ($errors->any())
    <div class="alert alert--err">
        <x-icon name="x" />
        <span>Please fix the highlighted fields and try again.</span>
    </div>
@endif
