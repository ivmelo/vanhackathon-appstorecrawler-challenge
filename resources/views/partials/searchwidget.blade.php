<form action="{{ action('AppController@index') }}" method="get">
    <div class="form-group form-group mb-2 mt-2">
        <input type="text" name="q" id="q" class="form-control search-input" placeholder="Search for an app, or paste a URL from the App Store or Google Play store.">
    </div>
</form>
