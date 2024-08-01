<div class="container-fluid d-flex justify-content-between">
    <div>Copyright by <a href="{{ url('/') }}" target="_blank" title="INTAKE Digital">INTAKE Digital</a></div>
    <div>Powered by <a href="https://intakedigital.net/neutrino-cms" target="_blank" title="Neutrino">{{ config('app.name') }}</a> | Version: {{ config('app.version') }}</div>
</div>
@php
    doAction('nt_footer_end')
@endphp