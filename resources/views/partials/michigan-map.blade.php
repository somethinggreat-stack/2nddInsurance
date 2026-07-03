{{-- Michigan map (client-provided image) --}}
<img src="{{ asset('images/michiganmap.png') }}?v={{ @filemtime(public_path('images/michiganmap.png')) ?: '1' }}"
     alt="Map of Michigan — statewide coverage" class="mi-map-img" width="380" height="440" loading="eager">
