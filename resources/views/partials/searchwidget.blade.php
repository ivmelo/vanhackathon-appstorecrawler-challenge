<form action="{{ action('AppController@index') }}" method="get">
    <div class="form-group">
        <input type="text" name="q" id="q" class="form-control search-input" placeholder="Search for an app, or paste a url from Google Play or the App Store...">
    </div>
</form>
