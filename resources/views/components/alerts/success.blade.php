@if (session($key ?? 'status'))
    <div class="alert {{ empty(session($alert ?? 'alert-success')) ? 'alert-success' : session($alert) }}" role="alert">
        {{ session($key ?? 'status') }}
    </div>
@endif
